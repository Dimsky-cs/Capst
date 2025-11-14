<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('konselings', function (Blueprint $table) {
            // Tambahkan kolom 'psikolog_id'
            // Ini adalah Foreign Key yang merujuk ke tabel 'users'
            $table->foreignId('psikolog_id')
                  ->nullable() // Boleh null (jika admin yg assign nanti)
                  ->after('user_id') // Taruh setelah user_id (biar rapi)
                  ->constrained('users') // Merujuk ke tabel 'users'
                  ->onDelete('set null'); // Jika psikolog dihapus, booking tetap ada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konselings', function (Blueprint $table) {
            // Ini untuk rollback (hapus foreign key dulu, baru kolom)
            $table->dropForeign(['psikolog_id']);
            $table->dropColumn('psikolog_id');
        });
    }
};
