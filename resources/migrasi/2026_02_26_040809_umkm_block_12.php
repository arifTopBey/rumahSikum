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
        Schema::create('umkm_block_12', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->integer('teknis_produksi')->nullable();  // 1201a 
            $table->integer('pemasaran_jaringan')->nullable(); // 1201b 
            $table->integer('pembiayaan')->nullable();    // 1202c 
            $table->integer('ekspor')->nullable(); // 1202d 
            $table->integer('digitalisasi')->nullable(); // 1202e
            $table->integer('manajement')->nullable(); // 1202f
            $table->integer('standarisasi')->nullable(); // 1202g
            $table->integer('hak_kekayaan_intelektual')->nullable(); // 1202h
            $table->integer('mitigasi_kebencanaan')->nullable(); // 1202i
            $table->integer('usaha_sendiri')->nullable(); // 1202j

            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_12');
    }
};
