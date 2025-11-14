<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use App\Models\User; // <-- TAMBAHAN: Kita butuh model User
use Illuminate\Http\Request;

class KonselingController extends Controller
{
    /**
     * READ: Menampilkan daftar semua data konseling.
     */
    public function index()
    {
        // Ambil data konseling, DAN data relasi 'user' dan 'psikolog'
        // Ini akan mencegah N+1 Query (lebih efisien)
        $konselings = Konseling::with(['user', 'psikolog'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.konseling.index', compact('konselings'));
    }

    /**
     * CREATE: Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get(); // Ambil daftar user
        //$psikologs = User::where('role', 'psikolog')->get(); // Ambil daftar psikolog

        return view('admin.konseling.create', compact('users', 'psikologs'));
    }

    /**
     * STORE: Menyimpan data baru dari form create ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'psikolog_id' => 'nullable|exists:users,id',
            'session_preference' => 'required|string|in:Video Call,Voice Call,Chat Saja',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'consultation_time' => 'required',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        // Cek jika jadwal sudah ada
        $existingBooking = Konseling::where('psikolog_id', $validated['psikolog_id'])
            ->where('consultation_date', $validated['consultation_date'])
            ->where('consultation_time', $validated['consultation_time'])
            ->exists();

        if ($validated['psikolog_id'] && $existingBooking) {
            return back()->withErrors(['consultation_date' => 'Jadwal pada tanggal dan jam ini dengan psikolog tersebut sudah terisi.'])->withInput();
        }

        Konseling::create($validated);

        return redirect()->route('admin.konseling.index')->with('success', 'Jadwal konseling baru berhasil ditambahkan.');
    }

    /**
     * EDIT: Menampilkan form untuk mengedit data.
     */
    public function edit(Konseling $konseling)
    {
        // Ambil daftar user & psikolog untuk dropdown
        $users = User::where('role', 'user')->get();
        $psikologs = User::where('role', 'psikolog')->get();

        return view('admin.konseling.edit', compact('konseling', 'users', 'psikologs'));
    }

    /**
     * UPDATE: Memperbarui data di database.
     */
    public function update(Request $request, Konseling $konseling)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'psikolog_id' => 'nullable|exists:users,id',
            'session_preference' => 'required|string|in:Video Call,Voice Call,Chat Saja',
            'client_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'consultation_time' => 'required',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        // Cek jadwal bentrok, kecuali untuk jadwal yang sedang diedit itu sendiri
        $existingBooking = Konseling::where('psikolog_id', $validated['psikolog_id'])
            ->where('consultation_date', $validated['consultation_date'])
            ->where('consultation_time', $validated['consultation_time'])
            ->where('id', '!=', $konseling->id) // Pengecualian
            ->exists();

        if ($validated['psikolog_id'] && $existingBooking) {
            return back()->withErrors(['consultation_date' => 'Jadwal pada tanggal dan jam ini dengan psikolog tersebut sudah terisi oleh booking lain.'])->withInput();
        }

        $konseling->update($validated);

        return redirect()->route('admin.konseling.index')->with('success', 'Data konseling berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data dari database.
     */
    public function destroy(Konseling $konseling)
    {
        $konseling->delete();
        return redirect()->route('admin.konseling.index')->with('success', 'Data konseling berhasil dihapus.');
    }
}
