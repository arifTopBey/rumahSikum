<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class IndikatorUsahaLainnyaController extends Controller
{
    
    public function index(){

      // ========= data usaha lainnya ===========
        $punyaNIB = DB::table('usaha_karakteristik')
            ->whereNotNull('nomor_induk_berusaha')
            ->where('nomor_induk_berusaha', '!=', '')
            ->count();

        $tidakPunyaNIB = DB::table('usaha_karakteristik')
            ->where(function ($q) {
                $q->whereNull('nomor_induk_berusaha')
                    // ->orWhere('nomor_induk_berusaha', '')
                ;
            })->count();
        //============= jenis kelamin =========================
        $jenisKelamin = DB::table('identitas_pengusaha')
            ->selectRaw("
                SUM(CASE WHEN status_pengusaha = 1 THEN 1 ELSE 0 END) as laki_laki,
                SUM(CASE WHEN status_pengusaha = 2 THEN 1 ELSE 0 END) as perempuan,
                SUM(CASE 
                    WHEN status_pengusaha NOT IN (1,2) OR status_pengusaha IS NULL 
                    THEN 1 ELSE 0 END
                ) as tidak_diketahui")->first();
        $totalJenisKelamin =
            $jenisKelamin->laki_laki +
            $jenisKelamin->perempuan +
            $jenisKelamin->tidak_diketahui;

        $persenLaki = $totalJenisKelamin > 0
            ? round(($jenisKelamin->laki_laki / $totalJenisKelamin) * 100, 1)
            : 0;

        $persenPerempuan = $totalJenisKelamin > 0
            ? round(($jenisKelamin->perempuan / $totalJenisKelamin) * 100, 1)
            : 0;

        $persenTidak = $totalJenisKelamin > 0
            ? round(($jenisKelamin->tidak_diketahui / $totalJenisKelamin) * 100, 2)
            : 0;
        // ================= batas jenis kelamin =======================================
        // tenaga kerja
        $tenagaKerja = DB::table('tenagaKerja')
            ->selectRaw("
                SUM(
                    CASE 
                        WHEN total_pembayaran_upah > 0 
                        THEN total_tenaga_kerja 
                        ELSE 0 
                    END
                ) as dibayar,

                SUM(
                    CASE 
                        WHEN total_pembayaran_upah IS NULL 
                            OR total_pembayaran_upah = 0
                        THEN total_tenaga_kerja 
                        ELSE 0 
                    END
                ) as tidak_dibayar
            ")
            ->first();

        $totalTenagaKerja =
            ($tenagaKerja->dibayar ?? 0) +
            ($tenagaKerja->tidak_dibayar ?? 0);


        // pemasaran dan produksi
        $pemasaran = DB::table('usaha_produksi_pemasaran')
            ->selectRaw("
                SUM(pemasaran_toko_sendiri) as toko_sendiri,
                SUM(pemasaran_titip_jual) as titip_jual,
                SUM(pemasaran_reseller) as reseller,
                SUM(pemasaran_distributor) as distributor,
                SUM(pemasaran_marketplace) as marketplace,
                SUM(pemasaran_media_sosial) as media_sosial,
                SUM(pemasaran_lainnya) as lainnya
            ")
            ->first();
        // ========= batas data usaha lainnya ===========

        return view('admin.informasi_data_umkm.partial.lainnya', compact('pemasaran','punyaNIB','tidakPunyaNIB','jenisKelamin', 'totalJenisKelamin', 'persenLaki', 'persenPerempuan', 'persenTidak', 'totalTenagaKerja','tenagaKerja'));
    }
    
}
