<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// BUKAN "return new class..." TAPI "class AddSocialLoginToUsersTable..."
class AddSocialLoginToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Buat kolom password jadi nullable
            // PENTING: Perintah ->change() ini butuh package 'doctrine/dbal'
            $table->string('password')->nullable()->change();

            // 2. Tambah kolom untuk provider (misal: 'google', 'facebook')
            $table->string('provider_name')->nullable()->after('email');

            // 3. Tambah kolom untuk ID unik dari provider
            $table->string('provider_id')->nullable()->after('provider_name');

            // 4. (Opsional) Tambah kolom untuk avatar
            $table->string('provider_avatar')->nullable()->after('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom yang kita tambahkan
            $table->dropColumn(['provider_name', 'provider_id', 'provider_avatar']);

            // Kembalikan password jadi not-nullable
            // PENTING: Perintah ->change() ini juga butuh 'doctrine/dbal'
            $table->string('password')->nullable(false)->change();
        });
    }
}
