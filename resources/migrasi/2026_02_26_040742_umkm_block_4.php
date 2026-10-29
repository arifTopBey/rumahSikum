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
        Schema::create('umkm_block_4', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->integer('izin_pirt')->nullable();    // 401b [cite: 3]
            $table->integer('izin_bpom')->nullable();    // 401c [cite: 3]
            $table->integer('izin_tdp')->nullable();     // 401j [cite: 3]
            $table->integer('sertifikat_halal')->nullable(); // 402b [cite: 3]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_4');
    }
};
