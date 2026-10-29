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
        Schema::create('umkm_block_7', function (Blueprint $table) {
            
           $table->unsignedBigInteger('id_badan_usaha')->primary();
    
            // Var 701a: Sekarang menggunakan JSON karena responnya Array [ {nama_produk, ...} ]
            $table->json('rincian_produk')->nullable(); 

            // Var 702: Keuangan
            $table->bigInteger('nilai_penjualan_setahun')->default(0); // 702a
            $table->bigInteger('nilai_pembelian_setahun')->default(0); // 702b
            
            // Var 704: Persentase Pemasaran (0-100)
            $table->integer('pasar_rumah_tangga')->default(0); // 704a
            $table->integer('pasar_pemerintah')->default(0);   // 704f
            
            // Var 707: Digitalisasi (1: Ya, 2: Tidak)
            $table->integer('is_medsos')->default(2);       // 707a
            $table->integer('is_marketplace')->default(2);  // 707b
            $table->integer('is_ojek_online')->default(2);  // 707d
            $table->integer('is_messaging_wa')->default(2); // 707f
            $table->integer('is_digital_lainnya')->default(2); // 707g
}       );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_block_7');
    }
};
