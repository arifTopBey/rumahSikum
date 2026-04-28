<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PertumbuhanUsahaMikro;
use App\Exports\UmkmClusterExport;
use App\Exports\UmkmWilayahExport;
use App\Exports\UmkmWilayahKelurahanExport;
use App\Exports\UsahaBerdasarkanOmset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportPertumbuhan(Request $request){
        $tahun = $request->tahun;
        $search = $request->search;
        $skala = $request->skala;

        return Excel::download(
            new PertumbuhanUsahaMikro($tahun, $search, $skala),
            'pertumbuhan-usaha.xlsx'
        );
    }

    public function exportBerdasarkanOmset(Request $request){

        // return Excel::download(
        //     new UsahaBerdasarkanOmset(
        //         $request->skala,
        //         $request->search
        //     ),
        //     'usaha-berdasarkan-omset.xlsx'
        // );

        set_time_limit(300);
        ini_set('memory_limit', '512M');

        return Excel::download(
            new UsahaBerdasarkanOmset(
                $request->skala,
                $request->search
            ),
            'usaha-berdasarkan-omset.xlsx'
        );
    }


    public function exportWilayah(Request $request,$kecamatan){
        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            // new UmkmWilayahExport($kecamatan),
            new UmkmWilayahExport($kecamatan, $skala, $search),
            "UMKM_Wilayah_$kecamatan.xlsx",
            // \Maatwebsite\Excel\Excel::CSV
        );
    }
    public function exportWilayahKelurahan(Request $request,$kelurahan){

        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            new UmkmWilayahKelurahanExport($kelurahan, $skala, $search),
            "UMKM_Wilayah_$kelurahan.xlsx", 
        );
    }

    public function exportBerdasarkanCluster(Request $request, $cluster){
         $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            new UmkmClusterExport($cluster, $skala, $search),
            "UMKM_Cluster_$cluster.xlsx", 
        );
    }

    public function exportDesil(){

    }

    public function exportKbli(){

    }

    public function exportPenjualanPemasaran(){
        
    }
}
