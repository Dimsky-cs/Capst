<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'provider_name',
        'provider_id',
        'provider_avatar',
        'dob', // <-- TAMBAHKAN BARIS INI
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- LOGIKA HAK AKSES (ROLE CHECKERS) ---

    /**
     * Cek apakah user memiliki peran Psikolog.
     */
    public function isPsikolog(): bool
    {
        return $this->role === 'psikolog';
    }

    /**
     * Cek apakah user memiliki peran Admin (sebagai Superadmin).
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // --- RELASI MODEL ---

    /**
     * Relasi ke sesi konseling yang di-assign ke Psikolog ini.
     * (Model Konseling harus sudah ada di App\Models)
     */
    public function assignedKonselings()
    {
        // Menggunakan foreign key 'psikolog_id' di tabel 'konselings'
        return $this->hasMany(Konseling::class, 'psikolog_id');
    }
}
