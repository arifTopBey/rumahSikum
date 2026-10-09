<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUmkmRequest extends FormRequest
{
  

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             // indentitas usaha
            'provinsi' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:500',
            'kelurahan' => 'nullable|string|max:100',
            'nama_lengkap_usaha' => 'nullable|string|max:100',
            'tempat_usaha' => 'nullable|string|max:100',
            'alamat_lengkap' => 'nullable|string|max:500',
            'telpon' => 'nullable|string|max:20',

            // identitas pengusaha
            'nama_pengusaha' => 'nullable|string|max:100',
            'status_pengusaha' => 'nullable|in:1,2',
            'nik_pengusaha' => 'nullable|string|max:16',
            'provinsi_pengusaha' => 'nullable|string|max:255',
            'kabupaten_pengusaha' => 'nullable|string|max:255',
            'kecamatan_pengusaha' => 'nullable|string|max:255',
            'desa_pengusaha' => 'nullable|string|max:255',
            'nomor_whatsapp' => 'nullable|string|max:20',

            // laporan keuangan
            'status_pencatatan_keuangan' => 'nullable|in:1,2',
            'omzet_usaha' => 'nullable|numeric|min:0',
            'pendapatan_lainnya' => 'nullable|numeric|min:0',
            'subsidi_bantuan' => 'nullable|numeric|min:0',
            'pinjaman_diterima' => 'nullable|numeric|min:0',
            'sumber_lain' => 'nullable|numeric|min:0',
            'biaya_bahan_baku' => 'nullable|numeric|min:0',
            'biaya_tenaga_kerja' => 'nullable|numeric|min:0',

            // usaha produksi dan pemasaran
            'produksi_sendiri' => 'nullable|numeric|min:0',
            'produksi_maklon' => 'nullable|numeric|min:0',
            'produksi_subcontrak' => 'nullable|numeric|min:0',
            'produksi_lainnya' => 'nullable|numeric|min:0',
            'pemasaran_local' => 'nullable|numeric|min:0',
            'pemasaran_kabupaten' => 'nullable|numeric|min:0',
            'pemasaran_provinsi' => 'nullable|numeric|min:0',
            'pemasaran_nasional' => 'nullable|numeric|min:0',
            'pemasaran_ekspor' => 'nullable|numeric|min:0',
            'pemasaran_online' => 'nullable|numeric|min:0',
            'penjualan_tunai' => 'nullable|numeric|min:0',
            'penjualan_kredit' => 'nullable|numeric|min:0',
            'pemasaran_toko_sendiri' => 'nullable|in:1,2',
            'pemasaran_titip_jual' => 'nullable|in:1,2',
            'pemasaran_reseller' => 'nullable|in:1,2',
            'pemasaran_distributor' => 'nullable|in:1,2',
            'pemasaran_marketplace' => 'nullable|in:1,2',
            'pemasaran_media_sosial' => 'nullable|in:1,2',
            'pemasaran_lainnya' => 'nullable|in:1,2',

            // tenaga kerja
            'total_tenaga_kerja' => 'nullable|numeric|min:0',
            'total_pembayaran_upah' => 'nullable|numeric|min:0',

            // usaha karakteristik,
            'kegiatan_utama' => 'nullable|string|max:255',
            'produk_utama' => 'nullable|string|max:255',
            'kategori_kbli' => 'nullable|numeric|min:0',
            'kode_kbli' => 'nullable|string|max:10',
            'nomor_induk_berusaha' => 'nullable|string',
            'npwp_usaha' => 'nullable|string|max:20',
            'bilan_mulai_usaha' => 'nullable|numeric|min:1900|max:' . date('Y'),
            'tahun_mulai_operasi' => 'nullable|numeric|min:1900|max:' . date('Y'),

            // usaha perizinan
            'memiliki_pirt' => 'nullable|in:1,2',
            'memiliki_bpom' => 'nullable|in:1,2',
            'memiliki_tdp' => 'nullable|in:1,2',
            'memiliki_sertifikat_halal' => 'nullable|in:1,2',

            //usaha produk
            'nama_produk' => 'nullable|string|max:255',
            'satuan' => 'nullable|string|max:50',
            'kuantits_produk' => 'nullable|numeric|min:0',
            'nilai_total' => 'nullable|numeric|min:0',
        ];
    }
}
