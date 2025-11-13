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
            // Mengubah tipe kolom 'service_type' menjadi string
            $table->string('service_type')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konselings', function (Blueprint $table) {
            // Hati-hati: Jika rollback, data string akan hilang.
            // Untuk amannya, kita bisa set ke integer lagi.
            $table->integer('service_type')->change();
        });
    }
};
