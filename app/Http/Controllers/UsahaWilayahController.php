<?php

namespace App\Http\Controllers;

use App\Models\IdentitasUsaha;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class UsahaWilayahController extends Controller
{
    public function index(Request $request){
    
    // ->search(request(['search']))->paginate(10)->withQueryString();
    $search = $request->input('search');

    //   $identitasUsaha = IdentitasUsaha::select(
    //         'kecamatan',
    //         DB::raw('COUNT(*) as total')
    //     )
    //         ->groupBy('kecamatan')
    //         ->orderByDesc('total')
    //         ->get();
    $query = IdentitasUsaha::select(
            'kecamatan',
            DB::raw('COUNT(*) as total')
        );
    $identitasUsaha = $query->groupBy('kecamatan')
        ->orderByDesc('total')
        ->get();
    // Tambahkan filter jika user sedang mencari sesuatu
    if ($search) {
        $query->where('kecamatan', 'LIKE', "%{$search}%");
    }
        $totalMicro = LaporanKeuangan::where('omzet_usaha', '<=', 2000000)->count();
        $totalUsahaKecil = LaporanKeuangan::whereBetween('omzet_usaha', [2000000, 15000000])->count();
        $totalUsahaMenengah = LaporanKeuangan::whereBetween('omzet_usaha', [15000000, 50000000])->count();

        return view('admin.informasi_data_umkm.partial.wilayah', compact('identitasUsaha', 'totalMicro', 'totalUsahaKecil', 'totalUsahaMenengah'));
    }

    public function wilayahDesa(){
         $identitasUsaha = IdentitasUsaha::select(
            'kelurahan',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('kelurahan')
            ->orderByDesc('total')
            ->get();

        $totalMicro = LaporanKeuangan::where('omzet_usaha', '<=', 2000000)->count();
        $totalUsahaKecil = LaporanKeuangan::whereBetween('omzet_usaha', [2000000, 15000000])->count();
        $totalUsahaMenengah = LaporanKeuangan::whereBetween('omzet_usaha', [15000000, 50000000])->count();

        return view('admin.informasi_data_umkm.partial.wilayah_desa', compact('identitasUsaha', 'totalMicro', 'totalUsahaKecil', 'totalUsahaMenengah'));
    }
}
