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
        Schema::create('umkm_block_3', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->string('nama_pengusaha')->nullable(); // 301 [cite: 3]
            $table->integer('status_pengusaha')->nullable(); // 304 [cite: 3]
            $table->string('nik_pengusaha')->nullable(); // 305 [cite: 3]
            $table->string('provinsi_pengusaha')->nullable(); // 308a [cite: 3]
            $table->string('kabupaten_kota_pengusaha')->nullable(); // 308b [cite: 3]
            $table->string('kecamatan_pengusaha')->nullable(); // 308c [cite: 3]
            $table->string('kelurahan_pengusaha')->nullable(); // 308d [cite: 3]
            $table->string('wa_pengusaha')->nullable();  // 309b [cite: 3]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_3');
    }
};
