<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsahaBerdasarkanPrioritasController extends Controller
{
    
    public function index(){

         // =============== point c karakteristik usaha berdasarkan cluster =======================
        $cluster = DB::table('usaha_karakteristik')
            ->selectRaw("
                CASE 
                    WHEN LEFT(kode_kbli,2) IN ('10','56') THEN 'Kuliner'
                    WHEN LEFT(kode_kbli,2) IN ('46','47') THEN 'Perdagangan'
                    WHEN LEFT(kode_kbli,2) IN ('20','23','25') THEN 'Industri'
                    WHEN LEFT(kode_kbli,2) IN ('77','95') THEN 'Jasa'
                    WHEN LEFT(kode_kbli,2) IN ('01') THEN 'Pertanian'
                    ELSE 'Lainnya'
                END as kluster,
                COUNT(*) as total
            ")
            ->whereNotNull('kode_kbli')
            ->groupBy('kluster')
            ->orderByDesc('total')
            ->get();
        // ============== batas point c karakteristik usaha berdasarkan cluster ==================
        
        return view('admin.informasi_data_umkm.partial.clusterPrioritas', compact('cluster'));
    }

}
