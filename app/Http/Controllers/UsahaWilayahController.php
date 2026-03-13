<?php

namespace App\Http\Controllers;

use App\Models\IdentitasUsaha;
use App\Models\LaporanKeuangan;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class UsahaWilayahController extends Controller
{
    public function index(){

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

        return view('admin.informasi_data_umkm.partial.wilayah', compact('identitasUsaha', 'totalMicro', 'totalUsahaKecil', 'totalUsahaMenengah'));
    }
}
