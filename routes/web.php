<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KonselingController as AdminKonselingController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\PsikologController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --------------------------------------------------------------------------
// RUTE PUBLIK (BISA DIAKSES SEMUA ORANG)
// --------------------------------------------------------------------------
Route::get('/', function () {
    return view('home');
});

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/tentang-kami', function () {
    return view('tentang');
})->name('tentang');


// --------------------------------------------------------------------------
// RUTE AUTENTIKASI DASAR
// --------------------------------------------------------------------------

// Rute /dashboard UTAMA
// Ini akan OTOMATIS mengarahkan user ke dashboard yang benar (admin/user)
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    // Asumsi default adalah user jika bukan admin
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); // <-- Nama 'dashboard' tetap di sini

// Rute Profil (Umum untuk semua user yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Social Login
Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleProviderCallback']); // <-- Rute spesifik google jika diperlukan

// Ini akan mengimpor rute login, register, dll. dari auth.php
require __DIR__.'/auth.php';


// --------------------------------------------------------------------------
// GROUP RUTE ADMIN
// --------------------------------------------------------------------------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin: /admin/dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Konseling (Admin)
    Route::get('/konseling', [AdminKonselingController::class, 'index'])->name('konseling.index');
    Route::get('/konseling/create', [AdminKonselingController::class, 'create'])->name('konseling.create');
    Route::post('/konseling', [AdminKonselingController::class, 'store'])->name('konseling.store');
    Route::get('/konseling/{konseling}/edit', [AdminKonselingController::class, 'edit'])->name('konseling.edit');
    Route::patch('/konseling/{konseling}', [AdminKonselingController::class, 'update'])->name('konseling.update');
    Route::delete('/konseling/{konseling}', [AdminKonselingController::class, 'destroy'])->name('konseling.destroy');

    // ... Tambahkan rute admin lainnya di sini ...

});


// --------------------------------------------------------------------------
// GROUP RUTE USER
// --------------------------------------------------------------------------
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {

    // Dashboard User: /user/dashboard
    Route::get('/dashboard', function () {
        return view('user.dashboard'); // Pastikan view ini ada: resources/views/user/dashboard.blade.php
    })->name('dashboard');

    // Konseling (User)
    Route::get('/konseling', [KonselingController::class, 'index'])->name('konseling.index');
    Route::get('/konseling/create', [KonselingController::class, 'create'])->name('konseling.create');
    Route::post('/konseling', [KonselingController::class, 'store'])->name('konseling.store');

    // ... Tambahkan rute user lainnya di sini ...

});



Route::prefix('api')->group(function () {

    // Rute 1 (SUDAH BENAR)
    Route::get('/psikologs-by-service', [\App\Http\Controllers\Api\BookingController::class, 'getPsikologsByService']);

    // Rute 2 (INI YANG HARUS DIPERBAIKI)
    Route::get('/available-times', [\App\Http\Controllers\Api\BookingController::class, 'getAvailableTimes']); // <-- PASTIKAN INI 'getAvailableTimes'

});
// --------------------------------------------------------------------------
// GROUP RUTE PSIKOLOG (Contoh dari kode kamu yang di-comment)
// --------------------------------------------------------------------------
// Route::middleware(['auth', 'role:psikolog'])->prefix('psikolog')->name('psikolog.')->group(function () {
//     Route::get('/dashboard', [PsikologController::class, 'dashboard'])->name('dashboard');
//     Route::get('/sessions', [PsikologController::class, 'mySessions'])->name('sessions');
// });
