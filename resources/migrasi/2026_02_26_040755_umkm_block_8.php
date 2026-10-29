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
        Schema::create('umkm_block_8', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->integer('total_naker')->nullable();   // 8011 (di PDF) / 801i (di JSON) 
            $table->bigInteger('total_upah')->nullable(); // 803i 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_8');
    }
};
