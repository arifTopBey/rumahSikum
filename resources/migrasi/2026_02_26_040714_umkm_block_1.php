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
        Schema::create('umkm_block_1', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary(); // ID Variabel 101 [cite: 2]
            $table->string('provinsi')->nullable();      // 102 [cite: 2]
            $table->string('kabupaten')->nullable();     // 103 [cite: 2]
            $table->string('kecamatan')->nullable();     // 104 [cite: 2]
            $table->string('kelurahan')->nullable();     // 105 [cite: 2]
            $table->string('nama_usaha')->nullable();    // 106 [cite: 2]
            $table->integer('tempat_usaha')->nullable(); // 108 [cite: 2]
            $table->string('alamat')->nullable();        // 109a [cite: 7]
            $table->string('telepon')->nullable();       // 109e [cite: 2]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_1');
    }
};
