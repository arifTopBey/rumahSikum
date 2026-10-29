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
        Schema::create('umkm_block_2', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->text('kegiatan_utama')->nullable();  // 201 [cite: 2]
            $table->string('produk_utama')->nullable();  // 202a [cite: 2]
            $table->string('kategori_kbli')->nullable(); // 202b [cite: 2]
            $table->string('kode_kbli', 5)->nullable();  // 202c [cite: 2]
            $table->integer('status_badan_usaha')->nullable(); // 203 [cite: 3]
            $table->string('nib')->nullable();           // 204 [cite: 3]
            $table->string('npwp')->nullable();          // 206 [cite: 3]
            $table->integer('bulan_mulai')->nullable();  // 207a [cite: 3]
            $table->integer('tahun_mulai')->nullable();  // 207b [cite: 3]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_2');
    }
};
