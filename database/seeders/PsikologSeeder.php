<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- Pastikan ini ada
use Illuminate\Support\Facades\Hash; // <-- Pastikan ini ada

class PsikologSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus psikolog lama jika ada (opsional, tapi bersih)
        // User::where('role', 'psikolog')->delete();

        // Buat 4 Psikolog Baru
        User::create([
            'name' => 'Dr. Budi Santoso, M.Psi.',
            'email' => 'budi.santoso@genz.com',
            'password' => Hash::make('password123'),
            'role' => 'psikolog',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Dr. Ana Melia, S.Psi.',
            'email' => 'ana.melia@genz.com',
            'password' => Hash::make('password123'),
            'role' => 'psikolog',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Chandra Wijaya, M.Psi.',
            'email' => 'chandra.wijaya@genz.com',
            'password' => Hash::make('password123'),
            'role' => 'psikolog',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Rina Permata, S.Psi.',
            'email' => 'rina.permata@genz.com',
            'password' => Hash::make('password123'),
            'role' => 'psikolog',
            'email_verified_at' => now(),
        ]);
    }
}
