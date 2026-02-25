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
        Schema::create('umkms', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id_badan_usaha')->primary();

            // Blok 1 & 2: Identitas & Karakteristik
            $table->string('nama_usaha')->nullable(); // 106
            $table->string('alamat')->nullable(); // 109a
            $table->string('no_hp')->nullable(); // 109e
            $table->string('komoditas')->nullable(); // 202a
            $table->string('nib')->nullable(); // 204
            $table->year('tahun_mulai')->nullable(); // 207b

            // Blok 3: Pemilik
            $table->string('nama_pemilik')->nullable(); // 301
            $table->string('nik_pemilik')->nullable(); // 305

            // Blok 4: Izin & Standardisasi (Mapping 401b, 401c, dll)
            $table->boolean('punya_iumk')->default(false); // 401b
            $table->boolean('punya_pirt')->default(false); // 401c
            $table->boolean('punya_halal')->default(false); // 401j

            // Blok 5: Tanggal Pendataan
            $table->date('tgl_pendataan')->nullable(); // 1405a

            // Blok 6: Bahan Baku
            $table->decimal('nilai_bahan_baku', 15, 2)->default(0); // 601d

            // Blok 7: Produksi & Pemasaran
            $table->decimal('total_produksi_setahun', 15, 2)->default(0); // 702a
            $table->decimal('total_penjualan_setahun', 15, 2)->default(0); // 702b
            $table->integer('persentase_online')->default(0); // 704a

            // Blok 12: Pembinaan (Data ini sangat banyak)
            // Saran: Simpan poin-poin penting saja untuk filter dashboard
            $table->boolean('butuh_pelatihan_pemasaran')->default(false); // 1201a
            $table->boolean('butuh_pelatihan_produksi')->default(false); // 1201b
            // Jika ingin menyimpan SEMUA blok 12 tanpa membuat ratusan kolom:
            $table->json('raw_data_pembinaan')->nullable();

            // Blok 11: Keuangan (Penting untuk Laporan)
            $table->decimal('modal_sendiri', 15, 2)->default(0); // 1102a
            $table->decimal('omzet_tahunan', 15, 2)->default(0); // 1103a
            $table->decimal('pengeluaran_tahunan', 15, 2)->default(0); // 1103b

            // Blok 8: Tenaga Kerja
            $table->integer('jumlah_tenaga_kerja')->default(0); // 801i
            $table->decimal('rata_gaji', 15, 2)->default(0); // 803i

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
