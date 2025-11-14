<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\User; // Pastikan ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Pastikan ini ada

class KonselingController extends Controller
{
    /**
     * Menampilkan riwayat konseling milik user yang sedang login.
     */
    public function index()
    {
        // Ambil riwayat, DAN data psikolog-nya
        $konselings = Konseling::with('psikolog')
            ->where('user_id', Auth::id())
            ->orderBy('consultation_date', 'desc')
            ->paginate(10);

        // Kirim ke view 'user.konseling-index' (pastikan file ini ada)
        return view('user.konseling-index', compact('konselings'));
    }

    /**
     * Menampilkan form untuk membuat jadwal konseling baru.
     */
    public function create()
    {
        // KITA HAPUS DATA $psikologs DARI SINI.
        // Data psikolog akan diambil secara dinamis oleh JavaScript (AJAX).
        return view('user.konseling-create');
    }

    /**
     * Menyimpan data booking baru dari form.
     */
    /**
     * Menyimpan data booking baru dari form.
     */
    public function store(Request $request)
    {
        // --- INI ADALAH LOGIKA BARU ---

        // 1. Validasi Regex untuk nomor HP Indonesia (+62 atau 08)
        // Regex: diawali +628 atau 08, lalu diikuti 8-11 digit angka.
        $request->validate([
            'client_phone' => [
                'required',
                'string',
                'regex:/^(\+62|0)8[1-9][0-9]{7,11}$/'
            ],
            // Validasi sisa form
            'service_type' => 'required|string|max:255',
            'psikolog_id' => 'required|exists:users,id',
            'session_preference' => 'required|string|in:Video Call,Voice Call,Chat Saja', // (Fitur 4)
            'consultation_date' => 'required|date|after_or_equal:today',
            'consultation_time' => 'required',
            'description' => 'nullable|string', // (Fitur 3, akan diisi oleh tag)
        ], [
            // Pesan error kustom untuk HP
            'client_phone.regex' => 'Format nomor telepon tidak valid. Gunakan format 08... atau +628...'
        ]);

        // 2. Cek Jadwal Bentrok (Sama seperti sebelumnya)
        $existingBooking = Konseling::where('psikolog_id', $request->psikolog_id)
            ->where('consultation_date', $request->consultation_date)
            ->where('consultation_time', $request->consultation_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['consultation_time' => 'Jadwal pada tanggal dan jam tersebut dengan psikolog ini sudah terisi.'])->withInput();
        }

        // 3. Gabungkan data (Fitur 1: Ambil data dari Auth)
        $dataToCreate = [
            'user_id' => Auth::id(),
            'client_name' => Auth::user()->name, // <-- AMBIL OTOMATIS
            'client_email' => Auth::user()->email, // <-- AMBIL OTOMATIS
            'client_phone' => $request->client_phone,
            'service_type' => $request->service_type,
            'psikolog_id' => $request->psikolog_id,
            'session_preference' => $request->session_preference, // (Fitur 4)
            'consultation_date' => $request->consultation_date,
            'consultation_time' => $request->consultation_time,
            'description' => $request->description, // (Fitur 3)
            'status' => 'pending',
        ];

        // 4. Simpan ke database
        Konseling::create($dataToCreate);

        // 5. Arahkan ke halaman riwayat
        return redirect()->route('user.konseling.index')->with('success', 'Jadwal konseling Anda berhasil dibuat dan sedang menunggu konfirmasi.');
    }
}
