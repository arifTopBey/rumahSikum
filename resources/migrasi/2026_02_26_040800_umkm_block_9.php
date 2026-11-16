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
        Schema::create('umkm_block_9', function (Blueprint $table) {
            $table->unsignedBigInteger('id_badan_usaha')->primary();
            $table->integer('is_manual')->nullable();     // 901a 
            $table->integer('is_mekanik')->nullable();    // 901b 
            $table->integer('is_elektronik')->nullable();    // 901c
            $table->integer('is_digital')->nullable();    // 901d 
            $table->integer('is_ai')->nullable();         // 901e 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_9');
    }
};
