<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon; // Library untuk manipulasi tanggal/waktu

class BookingController extends Controller
{
    /**
     * API 1: Mengambil daftar psikolog berdasarkan layanan yang dipilih.
     */
    public function getPsikologsByService(Request $request)
    {
        // Validasi input
        $request->validate(['service' => 'required|string']);
        $service = $request->query('service');

        // Cari user yang role-nya 'psikolog' DAN punya spesialisasi layanan tersebut
        $psikologs = User::where('role', 'psikolog')
                         ->whereJsonContains('specialties', $service)
                         ->get(['id', 'name']); // Ambil ID dan Nama saja (biar ringan)

        return response()->json($psikologs);
    }

    /**
     * API 2: Mengambil jam yang MASIH TERSEDIA (belum dibooking).
     */
    public function getAvailableTimes(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'psikolog_id' => 'required|exists:users,id',
            'date' => 'required|date_format:Y-m-d',
        ]);

        // 1. Tentukan Master Slot Waktu (Harus sama persis dengan opsi di form)
        $allTimeSlots = [
            '09:00',
            '10:00',
            '11:00',
            '13:00',
            '14:00',
        ];

        // 2. Cek Tanggal yang Dipilih
        try {
            $selectedDate = Carbon::parse($data['date']);
            $now = Carbon::now('Asia/Jakarta'); // Sesuaikan zona waktu jika perlu

            // JIKA MEMILIH TANGGAL KEMARIN, langsung kembalikan array kosong
            if ($selectedDate->isPast() && !$selectedDate->isToday()) {
                return response()->json([]); // Kembalikan array kosong
            }

            // JIKA MEMILIH TANGGAL HARI INI, filter jam yang sudah lewat
            if ($selectedDate->isToday()) {
                $currentTime = $now->format('H:i');
                // Filter array: hanya ambil jam yang lebih besar dari jam sekarang
                $allTimeSlots = array_filter($allTimeSlots, function($slot) use ($currentTime) {
                    $slotTime = Carbon::parse($slot);
                    $nowTime = Carbon::parse($currentTime);
                    // Cek jika slot masih lebih besar dari jam sekarang
                    return $slotTime->isAfter($nowTime);
                });
            }
        } catch (\Exception $e) {
            // Jika error parsing tanggal, kembalikan array kosong
             return response()->json(['error' => 'Format tanggal salah'], 400);
        }

        // 3. Cari slot yang SUDAH DIBOOKING di database
        $bookedTimes = Konseling::where('psikolog_id', $data['psikolog_id'])
            ->where('consultation_date', $data['date'])
            ->whereIn('status', ['pending', 'confirmed']) // Abaikan yang cancelled/completed
            ->pluck('consultation_time') // -> Hasilnya [ "09:00:00", "13:00:00" ]
            ->map(function ($timeFromDb) {
                // Ubah "09:00:00" menjadi "09:00" agar bisa dibandingnkan
                return Carbon::parse($timeFromDb)->format('H:i');
            })
            ->toArray(); // -> Hasilnya [ "09:00", "13:00" ]

        // 4. Bandingkan: (Semua Slot) - (Slot Terbooking) = Slot Tersedia
        $availableTimes = array_diff($allTimeSlots, $bookedTimes);

        // 5. Kembalikan hasil sebagai JSON (array_values untuk mereset index array)
        return response()->json(array_values($availableTimes));
    }
}
