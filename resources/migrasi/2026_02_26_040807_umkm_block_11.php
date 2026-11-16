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
        Schema::create('umkm_block_11', function (Blueprint $table) {

            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->integer('ada_laporan')->nullable();   // 1101 
            $table->bigInteger('omzet')->nullable();      // 1102a 
            $table->bigInteger('pendapatan_ops')->nullable();  // 1102b 
            $table->bigInteger('pendapatan_non_ops')->nullable();  // 1102c 
            $table->bigInteger('pendapatan_lainnya_subsidi_usaha')->nullable();  // 1102d
            $table->bigInteger('pendapatan_lainnya_subsidi_fiskal')->nullable();  // 1102e
            $table->bigInteger('pph_badan_pasal')->nullable();  // 1103a
            $table->bigInteger('pph_final_omzet')->nullable();  // 1103b
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_11');
    }
};
