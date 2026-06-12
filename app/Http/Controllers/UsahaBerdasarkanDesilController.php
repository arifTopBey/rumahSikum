<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsahaBerdasarkanDesilController extends Controller
{
    public function index2(){

    $total = DB::table('usaha_laporan_keuangan')->whereNotNull('omzet_usaha')->count();
    $perDesil = floor($total / 10);

    // Label & Values untuk Chart
    $labelsDesils = [];
    $valuesDesils = [];
    for ($i = 1; $i <= 10; $i++) {
        $labelsDesils[] = "Desil $i";
        $valuesDesils[] = ($i == 10) ? ($total - ($perDesil * 9)) : $perDesil;
    }

    $totalDesil14 = $perDesil * 4;
    $totalDesil510 = $total - $totalDesil14;

    // --- BAGIAN HITUNG JENIS KELAMIN ---
    
    // Ambil hanya kolom status_pengusaha untuk Desil 1-4
    // $data14 = DB::table('usaha_laporan_keuangan')
    //     ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
    //     ->whereNotNull('omzet_usaha')
    //     ->orderBy('omzet_usaha', 'asc')
    //     ->limit($totalDesil14)
    //     ->select('identitas_pengusaha.status_pengusaha') // Hanya ambil 1 kolom kecil
    //     ->get();
    // Untuk Desil 1-4
    $data14 = DB::table('usaha_laporan_keuangan')
    ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
    ->whereNotNull('omzet_usaha')
    ->orderBy('usaha_laporan_keuangan.omzet_usaha', 'asc') // Berikan nama tabel yang jelas
    ->limit($totalDesil14)
    ->select('identitas_pengusaha.status_pengusaha', 'usaha_laporan_keuangan.omzet_usaha') // Ambil juga kolom ini
    ->get();

    $data510 = DB::table('usaha_laporan_keuangan')
    ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
    ->whereNotNull('omzet_usaha')
    ->orderBy('usaha_laporan_keuangan.omzet_usaha', 'asc') // Berikan nama tabel yang jelas
    ->offset($totalDesil14)
    ->limit($totalDesil510)
    ->select('identitas_pengusaha.status_pengusaha', 'usaha_laporan_keuangan.omzet_usaha') // Ambil juga kolom ini
    ->get();

    $laki14 = $data14->where('status_pengusaha', 1)->count();
    $perempuan14 = $data14->where('status_pengusaha', 2)->count();

    // Ambil hanya kolom status_pengusaha untuk Desil 5-10
    $data510 = DB::table('usaha_laporan_keuangan')
        ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
        ->whereNotNull('omzet_usaha')
        ->orderBy('omzet_usaha', 'asc')
        ->offset($totalDesil14)
        ->limit($totalDesil510)
        ->select('identitas_pengusaha.status_pengusaha') // Hanya ambil 1 kolom kecil
        ->get();

    $laki510 = $data510->where('status_pengusaha', 1)->count();
    $perempuan510 = $data510->where('status_pengusaha', 2)->count();

    return view('admin.informasi_data_umkm.partial.desil', compact(
        'labelsDesils', 'valuesDesils', 'perempuan14', 'laki14', 
        'perempuan510','laki510', 'totalDesil14', 'totalDesil510'
    ));
    }

    public function index(){
    $total = DB::table('usaha_laporan_keuangan')->whereNotNull('omzet_usaha')->count();
    $perDesil = floor($total / 10);

    $labelsDesils = [];
    $valuesDesils = [];
    for ($i = 1; $i <= 10; $i++) {
        $labelsDesils[] = "Desil $i";
        $valuesDesils[] = ($i == 10) ? ($total - ($perDesil * 9)) : $perDesil;
    }

    $totalDesil14 = $perDesil * 4;
    $totalDesil510 = $total - $totalDesil14;

    // --- OPTIMASI HITUNG JENIS KELAMIN DESIL 1-4 ---
    // Menggunakan subquery agar database yang bekerja berat, PHP hanya menerima hasil akhir berupa angka
    $subQuery14 = DB::table('usaha_laporan_keuangan')
        ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
        ->whereNotNull('usaha_laporan_keuangan.omzet_usaha')
        ->orderBy('usaha_laporan_keuangan.omzet_usaha', 'asc')
        ->limit($totalDesil14)
        ->select('identitas_pengusaha.status_pengusaha');

    $hitung14 = DB::table(DB::raw("({$subQuery14->toSql()}) as sub"))
        ->mergeBindings($subQuery14)
        ->selectRaw("COUNT(CASE WHEN status_pengusaha = 1 THEN 1 END) as laki")
        ->selectRaw("COUNT(CASE WHEN status_pengusaha = 2 THEN 1 END) as perempuan")
        ->first();

    $laki14 = $hitung14->laki ?? 0;
    $perempuan14 = $hitung14->perempuan ?? 0;


    // --- OPTIMASI HITUNG JENIS KELAMIN DESIL 5-10 ---
    $subQuery510 = DB::table('usaha_laporan_keuangan')
        ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
        ->whereNotNull('usaha_laporan_keuangan.omzet_usaha')
        ->orderBy('usaha_laporan_keuangan.omzet_usaha', 'asc')
        ->offset($totalDesil14)
        ->limit($totalDesil510)
        ->select('identitas_pengusaha.status_pengusaha');

    $hitung510 = DB::table(DB::raw("({$subQuery510->toSql()}) as sub"))
        ->mergeBindings($subQuery510)
        ->selectRaw("COUNT(CASE WHEN status_pengusaha = 1 THEN 1 END) as laki")
        ->selectRaw("COUNT(CASE WHEN status_pengusaha = 2 THEN 1 END) as perempuan")
        ->first();

    $laki510 = $hitung510->laki ?? 0;
    $perempuan510 = $hitung510->perempuan ?? 0;

    return view('admin.informasi_data_umkm.partial.desil', compact(
        'labelsDesils', 'valuesDesils', 'perempuan14', 'laki14', 
        'perempuan510','laki510', 'totalDesil14', 'totalDesil510'
    ));
}
}
