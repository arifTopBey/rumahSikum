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
        Schema::create('umkm_block_6', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->bigInteger('nilai_bahan_baku')->nullable(); // 601d [cite: 7]
            $table->integer('usaha_mikro')->nullable();  // 602a [cite: 4]
            $table->integer('usaha_kecil')->nullable();  // 602b [cite: 4]
            $table->integer('usaha_menengah')->nullable(); // 602c [cite: 4]
            $table->integer('usaha_besar')->nullable();  // 602d [cite: 4]
            $table->integer('koperasi')->nullable();  // 602e [cite: 4]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_6');
    }
};
