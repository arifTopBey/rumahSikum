<?php

namespace App\Http\Controllers;

use App\Interface\UmkmInterface;
use App\Models\IdentitasUsaha;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataUMKMController extends Controller
{

    Protected $umkmRepo;

    public function __construct(UmkmInterface $umkmRepo)
    {
        $this->umkmRepo = $umkmRepo;
    }
    public function index(){

        // $data = $this->umkmRepo->getKeuangan();

        $data = $this->umkmRepo->getData(10, 1, 1);
        $totalUmkm = $data['meta']['total_data'] ?? 0; 

        //=============== point b indentisas berdasarkan wilayah =======================
        $identitasUsaha = IdentitasUsaha::select(
            'kecamatan',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('kecamatan')
        ->orderByDesc('total')
        ->get();
        
        $totalMicro = LaporanKeuangan::where('omzet_usaha', '<=', 2000000)->count();
        $totalUsahaKecil = LaporanKeuangan::whereBetween('omzet_usaha', [2000000, 15000000])->count();
        $totalUsahaMenengah = LaporanKeuangan::whereBetween('omzet_usaha', [15000000, 50000000])->count();
        // ================= batas point b identisas berdasarkan wilayah =====================


        //=========== data kbli ================ 
        $kbliChartData = DB::table('usaha_karakteristik')
        ->selectRaw('LEFT(kode_kbli,1) as kategori_kbli, COUNT(*) as total')
        ->whereNotNull('kode_kbli')
        ->groupBy(DB::raw('LEFT(kode_kbli,1)'))
        ->orderByDesc('total')
        ->get();
        // =========== batas data kbli =============

        // ========= data usaha lainnya ===========
        $punyaNIB = DB::table('usaha_karakteristik')
            ->whereNotNull('nomor_induk_berusaha')
            ->where('nomor_induk_berusaha', '!=', '')
            ->count();

        $tidakPunyaNIB = DB::table('usaha_karakteristik')
            ->where(function($q){
                $q->whereNull('nomor_induk_berusaha')
                // ->orWhere('nomor_induk_berusaha', '')
                ;
            })->count();

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
        // ========= batas data usaha lainnya ===========

        return view('admin.informasi_data_umkm.index',
         compact('data', 'totalUmkm', 'identitasUsaha', 'totalMicro', 'totalUsahaKecil', 'totalUsahaMenengah', 'kbliChartData', 'punyaNIB', 'tidakPunyaNIB','totalJenisKelamin', 'jenisKelamin','persenLaki', 'persenPerempuan', 'persenTidak'));
    }

    public function list_umkm(){

        $data = $this->umkmRepo->getData(10, 1, 1);
        $data = $data['data'];


        return view('admin.umkm.index', compact('data'));
    }

    // public function show(int $id){

    //     $data = $this->umkmRepo->getFullDetail($id);

    //     // dd($data);

    //     return view('admin.umkm.show', compact('data'));
    // }
}
