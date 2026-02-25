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
        Schema::create('mitra_umkms', function (Blueprint $table) {
           $table->unsignedBigInteger('id_badan_usaha');
            $table->string('nama_mitra')->nullable();
            $table->string('alamat_mitra')->nullable();
            $table->string('hp_mitra')->nullable();
            $table->foreign('id_badan_usaha')->references('id_badan_usaha')->on('umkms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_umkms');
    }
};
