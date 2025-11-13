<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Kita butuh ini jika ada user lama
use Laravel\Socialite\Facades\Socialite;


class SocialLoginController extends Controller
{
    /**
     * Arahkan user ke halaman autentikasi provider (Google).
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Tangkap data user dari provider (Google) setelah mereka login.
     */
   /**
     * Tangkap data user dari provider (Google) setelah mereka login.
     */


// ... (pastikan ini ada di atas file)

public function handleProviderCallback($provider = 'google')
{
    $request = request();

    try {
        // Ambil data user dari Google
        $socialUser = Socialite::driver($provider)->user();

        // 1. Coba cari user BERDASARKAN EMAIL (Untuk menangani user lama/manual)
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Jika user ditemukan (via email), update data providernya
            $user->provider_id = $socialUser->getId();
            $user->provider_name = $provider;
            $user->provider_avatar = $socialUser->getAvatar();
            $user->save();
        } else {
            // 2. Jika user TIDAK ditemukan, buat akun baru
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_avatar' => $socialUser->getAvatar(),
                'password' => null, // Password tetap null untuk akun Socialite
            ]);
        }

        // Login-kan user dan redirect
        Auth::login($user);
        return redirect('/dashboard');

    } catch (\Exception $e) {
        // Jika terjadi kesalahan (misalnya Socialite error), kembalikan ke halaman login
        // Tampilkan error untuk debugging:
        // dd($e);
        return redirect('/login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
    }
}
}
