<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // --- TAMBAHKAN 2 BARIS INI ---
        // (Kita gunakan 'api/*' untuk mengizinkan SEMUA
        // rute yang dimulai dengan 'api/' di dalam web.php)

        'api/*',

        // --- ATAU JIKA KAMU MAU LEBIH SPESIFIK ---
        // 'api/psikologs-by-service',
        // 'api/available-times',
        // ---------------------------------
    ];
}
