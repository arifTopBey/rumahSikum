<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUmkmRequest;
use App\Models\Helpers\GeografiUsaha_Dev;
use App\Models\Helpers\IdentitasPengusaha_Dev;
use App\Models\Helpers\IdentitasUsaha_Dev;
use App\Models\Helpers\Kemitraan_Dev;
use App\Models\Helpers\LaporanKeuangan_Dev;
use App\Models\Helpers\Pembinaan_Dev;
use App\Models\Helpers\ProduksiDanPemasaran_Dev;
use App\Models\Helpers\TenagaKerja_Dev;
use App\Models\Helpers\Usaha_Penghargaan_Dev;
use App\Models\Helpers\UsahaBahanBaku_Dev;
use App\Models\Helpers\UsahaKarakteristik_Dev;
use App\Models\Helpers\UsahaPerizinan_Dev;
use App\Models\Helpers\UsahaProsesProduksi_Dev;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VendorUmkmController extends Controller
{
    public function showProfile($nik = null)
    {


        $umkm = null;

       
        // if ($nik) {
        //     $umkm = IdentitasUsaha_Dev::with('identitasPengusaha')->where('nik_pengusaha', $nik)->firstOrFail();
        // }
            if ($nik) {
            $umkm = IdentitasUsaha_Dev::with('identitasPengusaha')
                ->whereHas('identitasPengusaha', function ($query) use ($nik) {
                    $query->where('nik_pengusaha', $nik);
                })
                ->firstOrFail();
        }


        return view('admin.mirroring.umkm.vendor.index', compact('umkm', 'nik'));

    }

     public function editUmkm($nik)
    {
        // $data = IdentitasUsaha::with(['usahaKarakteristik', 'laporanKeuangan', 'tenagaKerja', 'tanggalPendataan'])->findOrFail($id_badan_usaha);
        // $data = IdentitasUsaha_Dev::where('id_badan_usaha', $id_badan_usaha)->with(['laporanKeuangan','usahaProduksiPemasaran'])->first();
        $data = IdentitasUsaha_Dev::with(['laporanKeuangan','usahaProduksiPemasaran', 'identitasPengusaha'])
                ->whereHas('identitasPengusaha', function ($query) use ($nik) {
                    $query->where('nik_pengusaha', $nik);
                })
                ->firstOrFail();

        return view('admin.mirroring.umkm.vendor.edit', compact('data'));
    }

     public function updateUmkm(UpdateUmkmRequest $request, $id_badan_usaha)
    {
        $data = $request->validated();
       
        // $data = IdentitasUsaha_Dev::where('id_badan_usaha', $id_badan_usaha)->with(['laporanKeuangan','usahaProduksiPemasaran'])->first();

        $identitasUsaha = IdentitasUsaha_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $laporanKeuangan = LaporanKeuangan_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $identitasPengusaha = IdentitasPengusaha_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $tenagaKerja = TenagaKerja_Dev::where('id_data_badan_usaha', $id_badan_usaha)->first();
        $perizinan = UsahaPerizinan_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $karakteristikUsaha = UsahaKarakteristik_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $bahanBaku = UsahaBahanBaku_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $pembinaan = Pembinaan_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $kemitraan = Kemitraan_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $prosesProduksi = UsahaProsesProduksi_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $produksiPemasaran = ProduksiDanPemasaran_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $geografiUsaha = GeografiUsaha_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        $penghargaan = Usaha_Penghargaan_Dev::where('id_badan_usaha', $id_badan_usaha)->first();
        // dd($kemitraan);

        DB::beginTransaction(); // Mulai transaksi database
        try{

            $identitasUsaha->update([
                'provinsi' => $data['provinsi'],
                'kecamatan' => $data['kecamatan'],
                'kelurahan' => $data['kelurahan'],
                'nama_lengkap_usaha' => $data['nama_lengkap_usaha'],
                // 'tempat_usaha' => $data['tempat_usaha'],
                'alamat_lengkap' => $data['alamat_lengkap'],
                'telpon' => $data['telpon'],
            ]);

            $perizinan->update([
                'memiliki_pirt' => $data['memiliki_pirt'],
                'memiliki_bpom' => $data['memiliki_bpom'],
                'memiliki_tdp' => $data['memiliki_tdp'],
                'memiliki_sertifikat_halal' => $data['memiliki_sertifikat_halal'],
            ]);

            $karakteristikUsaha->update([
                'kode_kbli' => $data['kode_kbli'],
                'tahun_mulai_operasi' => $data['tahun_mulai_operasi'],
                'npwp_usaha' => $data['npwp_usaha'],
                'bulan_mulai_operasi' => $data['bulan_mulai_operasi'],
                // 'status_badan_usaha' => $data['status_badan_usaha'],
                'nomor_induk_berusaha' => $data['nomor_induk_berusaha'],
                'kegiatan_utama' => $data['kegiatan_utama'],
                'produk_utama' => $data['produk_utama']
            ]);

            $bahanBaku->update([
                'persen_dari_usaha_mikro' => $data['persen_dari_usaha_mikro'],
                'persen_dari_usaha_kecil' => $data['persen_dari_usaha_kecil'],
                'persen_dari_usaha_menengah' => $data['persen_dari_usaha_menengah'],
                'persen_dari_usaha_besar' => $data['persen_dari_usaha_besar'],
                'persen_dari_koperasi' => $data['persen_dari_koperasi'],
                'total_nilai_bahan_baku' => $data['total_nilai_bahan_baku']
            ]);

            $laporanKeuangan->update([
                'omzet_usaha' => $data['omzet_usaha'],
                'pendapatan_lain' => $data['pendapatan_lain'],
                'subsidi_bantuan' => $data['subsidi_bantuan'],
                'pinjaman_diterima' => $data['pinjaman_diterima'],
                'sumber_lain' => $data['sumber_lain'],
                'biaya_bahan_baku' => $data['biaya_bahan_baku'],
                'biaya_tenaga_kerja' => $data['biaya_tenaga_kerja'],
                'status_pencatatan_keuangan' => $data['status_pencatatan_keuangan'],
            ]);

            $identitasPengusaha->update([
                'nama_pengusaha' => $data['nama_pengusaha'],
                // 'status_pengusaha' => $data['status_pengusaha'],
                'nik_pengusaha' => $data['nik_pengusaha'],
                'provinsi_pengusaha' => $data['provinsi_pengusaha'],
                'kabupaten_pengusaha' => $data['kabupaten_pengusaha'],
                'kecamatan_pengusaha' => $data['kecamatan_pengusaha'],
                'desa_pengusaha' => $data['desa_pengusaha'],
                'nomor_whatsapp' => $data['nomor_whatsapp'],
            ]);

            $tenagaKerja->update([
                'total_tenaga_kerja' => $data['total_tenaga_kerja'],
                'total_pembayaran_upah' => $data['total_pembayaran_upah'],
            ]);

            $pembinaan->update([
                'teknis_produksi' => $data['teknis_produksi'],
                'pemasaran_jaringan' => $data['pemasaran_jaringan'],
                'pembiayaan' => $data['pembiayaan'],
                'ekspor' => $data['ekspor'],
                'digitalisasi' => $data['digitalisasi'],
                'manajemen' => $data['manajemen'],
                'standarisasi' => $data['standarisasi'],
                'hak_kekayaan_intelektual' => $data['hak_kekayaan_intelektual'],
                'mitigasi_kebencanaan' => $data['mitigasi_kebencanaan'],
                'penyelenggara_sendiri' => $data['penyelenggara_sendiri'],
                'penyelenggara_pemerintah' => $data['penyelenggara_pemerintah'],
                'penyelenggara_swasta' => $data['penyelenggara_swasta'],
                'penyelenggara_lsm' => $data['penyelenggara_lsm'],
                'penyelenggara_lainnya' => $data['penyelenggara_lainnya'],
                'modal_produksi' => $data['modal_produksi'],
                'modal_pemasaran' => $data['modal_pemasaran'],
                'modal_ekspor' => $data['modal_ekspor'],
                'modal_digitalisasi' => $data['modal_digitalisasi'],
                'modal_standarisasi' => $data['modal_standarisasi'],
                'modal_hki' => $data['modal_hki'],
                'pemberi_sendiri' => $data['pemberi_sendiri'],
                'pemberi_pemerintah' => $data['pemberi_pemerintah'],
                'pemberi_swasta' => $data['pemberi_swasta'],
                'pemberi_lsm' => $data['pemberi_lsm'],
                'pemberi_lainnya' => $data['pemberi_lainnya'],
            ]);

            if(!$kemitraan){
               Kemitraan_Dev::create([
                    'id_badan_usaha' => $id_badan_usaha,
                    'nama_mitra' => $data['nama_mitra'],
                    'alamat' => $data['alamat'],
                    'hp' => $data['hp'],
                    'keterangan' => $data['keterangan'],
                ]);
            }else{
                $kemitraan->update([
                    'nama_mitra' => $data['nama_mitra'],
                    'alamat' => $data['alamat'],
                    'hp' => $data['hp'],
                    'keterangan' => $data['keterangan'],
                ]);
            }

            if(!$geografiUsaha){
                $path = null;

                // $path = $data['foto_umkm']->store('foto_umkm', 'local');
                 if (isset($data['foto_umkm'])) {
                         $path = $data['foto_umkm']->store('foto_umkm', 'local');
                 }

                GeografiUsaha_Dev::create([
                    'id_badan_usaha' => $id_badan_usaha,
                    'foto_umkm' => $path,
                    'longitude' => $data['longitude'],
                    'latitude' => $data['latitude'],
                ]);

            }else{

                $path = $geografiUsaha->foto_umkm;

                 if (isset($data['foto_umkm'])) {

                    // Hapus foto lama jika tersedia
                    if ($geografiUsaha->foto_umkm) {
                        Storage::disk('local')->delete($geografiUsaha->foto_umkm);
                    }

                    // Simpan foto baru
                    $path = $data['foto_umkm']->store('foto_umkm', 'local');
                }
                $geografiUsaha->update([
                    'id_badan_usaha' => $id_badan_usaha,
                    'foto_umkm' => $path,
                    'longitude' => $data['longitude'],
                    'latitude' => $data['latitude'],
                ]);
            }

    

            if(!$penghargaan){
                Usaha_Penghargaan_Dev::create([
                    'id_badan_usaha' => $id_badan_usaha,
                    'nama_penghargaan' => $data['nama_penghargaan'],
                    'catatan' => $data['catatan'],
                ]);
            }else{
               $penghargaan->update([
                    'id_badan_usaha' => $id_badan_usaha,
                    'nama_penghargaan' => $data['nama_penghargaan'],
                    'catatan' => $data['catatan'],
               ]); 
            }

            $prosesProduksi->update([
                'bahan_baku_utama' => $data['bahan_baku_utama'],
                'proses_produksi' => $data['proses_produksi'],
                'penggunaan_teknologi' => $data['penggunaan_teknologi'],
                'sistem_produksi' => $data['sistem_produksi'],
                'pengendalian_mutu' => $data['pengendalian_mutu'],
            ]);

            $produksiPemasaran->update([
                 'produksi_sendiri' => $data['produksi_sendiri'],
                 'produksi_maklon' => $data['produksi_maklon'],
                 'produksi_subkontrak' => $data['produksi_subkontrak'],
                 'produksi_lainnya' => $data['produksi_lainnya'],
                 'pemasaran_lokal' => $data['pemasaran_lokal'],
                 'pemasaran_kabupaten' => $data['pemasaran_kabupaten'],
                 'pemasaran_provinsi' => $data['pemasaran_provinsi'],
                 'pemasaran_nasional' => $data['pemasaran_nasional'],
                 'pemasaran_ekspor' => $data['pemasaran_ekspor'],
                 'pemasaran_online' => $data['pemasaran_online'],
                 'penjualan_tunai' => $data['penjualan_tunai'],
                 'penjualan_kredit' => $data['penjualan_kredit'],
                 'pemasaran_toko_sendiri' => $data['pemasaran_toko_sendiri'],
                 'pemasaran_titip_jual' => $data['pemasaran_titip_jual'],
                 'pemasaran_reseller' => $data['pemasaran_reseller'],
                 'pemasaran_distributor' => $data['pemasaran_distributor'],
                 'pemasaran_marketplace' => $data['pemasaran_marketplace'],
                 'pemasaran_media_sosial' => $data['pemasaran_media_sosial'],
                 'pemasaran_lainnya' => $data['pemasaran_lainnya'],
            ]);


            DB::commit(); 
            return redirect()->route('vendor.umkm.profile', auth()->user()->nik)->with('success', 'Data UMKM berhasil diperbarui.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
}
