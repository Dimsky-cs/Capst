<?php

namespace App\Http\Controllers; // <-- PERBAIKAN NAMESPACE DI SINI

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- PENTING: Untuk mengambil data user yang login

class KonselingController extends Controller
{
    /**
     * Menampilkan riwayat konseling milik user yang sedang login.
     */
    public function index()
    {
        // Ambil hanya konseling milik user yang login
        $konselings = Konseling::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.konseling-index', compact('konselings'));
    }

    /**
     * Menampilkan form untuk user membuat jadwal konseling baru.
     */
    public function create()
    {
        // Ini adalah view dari resources/views/user/konseling-create.blade.php
        return view('user.konseling-create');
    }

    /**
     * Menyimpan data baru dari form 'create' ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data dari form
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'consultation_time' => 'required',
            'description' => 'nullable|string',
        ]);

        // 2. Cek jika jadwal sudah ada (bentrok)
        $existingBooking = Konseling::where('consultation_date', $validated['consultation_date'])
            ->where('consultation_time', $validated['consultation_time'])
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['consultation_date' => 'Maaf, jadwal pada tanggal dan jam ini sudah terisi. Silakan pilih jadwal lain.'])->withInput();
        }

        // 3. Tambahkan data yang tidak ada di form
        $validated['user_id'] = Auth::id(); // Ambil ID user yang login
        $validated['status'] = 'pending';  // Status default saat user booking

        // 4. Simpan ke database
        Konseling::create($validated);

        // 5. Arahkan ke halaman riwayat
        return redirect()->route('user.konseling.index')->with('success', 'Jadwal konseling Anda berhasil dibuat dan sedang menunggu konfirmasi.');
    }

    // Kamu bisa tambahkan method show, edit, update, destroy untuk USER di sini jika diperlukan
}
