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

    public function index3(){
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

public function index4() {
    // 1. Hitung total data
    $total = DB::table('usaha_laporan_keuangan')->whereNotNull('omzet_usaha')->count();
    
    // 2. Tentukan ukuran dasar per desil (data ideal dibagi 10)
    $perDesilBase = floor($total / 10);
    $sisaData = $total % 10; // Untuk membagikan sisa pembagian agar pas totalnya

    $labelsDesils = [];
    $valuesDesils = [];
    
    // Inisialisasi total untuk kartu informasi di atas
    $totalDesil14 = 0;
    $totalDesil510 = 0;
    $laki14 = 0; $perempuan14 = 0;
    $laki510 = 0; $perempuan510 = 0;

    $offset = 0;

    for ($i = 1; $i <= 10; $i++) {
        $labelsDesils[] = "Desil $i";
        
        // Tentukan limit data untuk desil saat ini (sisa pembagian ditambahkan ke desil-desil akhir)
        $limit = $perDesilBase + ($i <= $sisaData ? 1 : 0);
        $valuesDesils[] = $limit; // Nilai jumlah data desil tersebut

        // Query data pengusaha pada rentang desil ini (diurutkan berdasarkan omzet)
        $subQuery = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('usaha_laporan_keuangan.omzet_usaha')
            ->orderBy('usaha_laporan_keuangan.omzet_usaha', 'asc')
            ->offset($offset)
            ->limit($limit)
            ->select('identitas_pengusaha.status_pengusaha');

        // Jalankan hitungan gender untuk desil saat ini
        $hitungGender = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
            ->mergeBindings($subQuery)
            ->selectRaw("COUNT(CASE WHEN status_pengusaha = 1 THEN 1 END) as laki")
            ->selectRaw("COUNT(CASE WHEN status_pengusaha = 2 THEN 1 END) as perempuan")
            ->first();

        $currentLaki = $hitungGender->laki ?? 0;
        $currentPerempuan = $hitungGender->perempuan ?? 0;

        // Akumulasikan ke Kelompok Desil 1-4 atau Desil 5-10 untuk tampilan kartu boks
        if ($i <= 4) {
            $totalDesil14 += $limit;
            $laki14 += $currentLaki;
            $perempuan14 += $currentPerempuan;
        } else {
            $totalDesil510 += $limit;
            $laki510 += $currentLaki;
            $perempuan510 += $currentPerempuan;
        }

        // Tambahkan offset untuk perulangan desil berikutnya
        $offset += $limit;
    }

    dd($valuesDesils);

    return view('admin.informasi_data_umkm.partial.desil', compact(
        'labelsDesils', 'valuesDesils', 'perempuan14', 'laki14', 
        'perempuan510','laki510', 'totalDesil14', 'totalDesil510'
    ));
}

public function index5() {
    // 1. Hitung total data
    $total = DB::table('usaha_laporan_keuangan')->whereNotNull('omzet_usaha')->count();
    
    // 2. Tentukan ukuran dasar per desil
    $perDesilBase = floor($total / 10);
    $sisaData = $total % 10; 

    $labelsDesils = [];
    $valuesDesils = []; // Sekarang ini akan berisi Rata-rata Omzet per desil
    
    $totalDesil14 = 0;
    $totalDesil510 = 0;
    $laki14 = 0; $perempuan14 = 0;
    $laki510 = 0; $perempuan510 = 0;

    $offset = 0;

    for ($i = 1; $i <= 10; $i++) {
        $labelsDesils[] = "Desil $i";
        $limit = $perDesilBase + ($i <= $sisaData ? 1 : 0);

        // Query dasar kelompok desil ini (urut omzet terkecil ke terbesar)
        $subQuery = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('usaha_laporan_keuangan.omzet_usaha')
            ->orderBy('usaha_laporan_keuangan.omzet_usaha', 'asc')
            ->offset($offset)
            ->limit($limit);

        // --- 1. HITUNG RATA-RATA OMZET UNTUK GRAFIK ---
        // Menggunakan subquery untuk mengambil rata-rata omzet dari kelompok data saat ini
        $rataRataOmzet = DB::table(DB::raw("({$subQuery->select('usaha_laporan_keuangan.omzet_usaha')->toSql()}) as sub"))
            ->mergeBindings($subQuery)
            ->avg('omzet_usaha');
            
        // Masukkan nilai rata-rata omzet ke array grafik (dibulatkan)
        $valuesDesils[] = round($rataRataOmzet ?? 0); 

        // --- 2. HITUNG JENIS KELAMIN UNTUK KARTU INFORMASI ATAS ---
        $hitungGender = DB::table(DB::raw("({$subQuery->select('identitas_pengusaha.status_pengusaha')->toSql()}) as sub"))
            ->mergeBindings($subQuery)
            ->selectRaw("COUNT(CASE WHEN status_pengusaha = 1 THEN 1 END) as laki")
            ->selectRaw("COUNT(CASE WHEN status_pengusaha = 2 THEN 1 END) as perempuan")
            ->first();

        $currentLaki = $hitungGender->laki ?? 0;
        $currentPerempuan = $hitungGender->perempuan ?? 0;

        // Akumulasi data untuk Kartu Afirmatif (Desil 1-4) & Produktif (Desil 5-10)
        if ($i <= 4) {
            $totalDesil14 += $limit;
            $laki14 += $currentLaki;
            $perempuan14 += $currentPerempuan;
        } else {
            $totalDesil510 += $limit;
            $laki510 += $currentLaki;
            $perempuan510 += $currentPerempuan;
        }

        // Geser posisi data untuk desil berikutnya
        $offset += $limit;
    }

    // Hapus dd($valuesDesils) jika sudah ingin dicoba ke view
    // dd($valuesDesils); 

    return view('admin.informasi_data_umkm.partial.desil', compact(
        'labelsDesils', 'valuesDesils', 'perempuan14', 'laki14', 
        'perempuan510','laki510', 'totalDesil14', 'totalDesil510'
    ));
}


public function index() {
    
    $minMax = DB::table('usaha_laporan_keuangan')
        ->whereNotNull('omzet_usaha')
        ->selectRaw('MIN(omzet_usaha) as min_omzet, MAX(omzet_usaha) as max_omzet')
        ->first();

    $minOmzet = $minMax->min_omzet ?? 0;
    $maxOmzet = $minMax->max_omzet ?? 0;

    // 2. Hitung jarak interval omzet per desil
    $rentangTotal = $maxOmzet - $minOmzet;
    $intervalPerDesil = $rentangTotal / 10;

    $labelsDesils = [];
    $valuesDesils = []; // Ini akan berisi JUMLAH ORANG (Frekuensi)
    
    $totalDesil14 = 0; $totalDesil510 = 0;
    $laki14 = 0; $perempuan14 = 0;
    $laki510 = 0; $perempuan510 = 0;

    // 3. Loop untuk menghitung orang di setiap rentang omzet desil
    for ($i = 1; $i <= 10; $i++) {
        $labelsDesils[] = "Desil $i";

        // Tentukan batas bawah dan batas atas omzet untuk desil saat ini
        $batasBawah = $minOmzet + (($i - 1) * $intervalPerDesil);
        $batasAtas = $minOmzet + ($i * $intervalPerDesil);

        // Query dasar untuk mengambil data pengusaha di dalam rentang omzet desil ini
        $subQuery = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('usaha_laporan_keuangan.omzet_usaha')
            ->where('usaha_laporan_keuangan.omzet_usaha', '>=', $batasBawah);
            
        // Jika desil 10, pastikan nilai max yang pas masuk ke dalam query
        if ($i == 10) {
            $subQuery->where('usaha_laporan_keuangan.omzet_usaha', '<=', $batasAtas);
        } else {
            $subQuery->where('usaha_laporan_keuangan.omzet_usaha', '<', $batasAtas);
        }

        // Hitung total orang & jenis kelamin pada desil ini
        $hitungData = DB::table(DB::raw("({$subQuery->select('identitas_pengusaha.status_pengusaha')->toSql()}) as sub"))
            ->mergeBindings($subQuery)
            ->selectRaw("COUNT(*) as total_orang")
            ->selectRaw("COUNT(CASE WHEN status_pengusaha = 1 THEN 1 END) as laki")
            ->selectRaw("COUNT(CASE WHEN status_pengusaha = 2 THEN 1 END) as perempuan")
            ->first();

        $jumlahOrang = $hitungData->total_orang ?? 0;
        $currentLaki = $hitungData->laki ?? 0;
        $currentPerempuan = $hitungData->perempuan ?? 0;

        // Masukkan JUMLAH ORANG ke array grafik
        $valuesDesils[] = $jumlahOrang; 

        // Akumulasikan ke kartu informasi atas (Desil 1-4 vs Desil 5-10)
        if ($i <= 4) {
            $totalDesil14 += $jumlahOrang;
            $laki14 += $currentLaki;
            $perempuan14 += $currentPerempuan;
        } else {
            $totalDesil510 += $jumlahOrang;
            $laki510 += $currentLaki;
            $perempuan510 += $currentPerempuan;
        }
    }

    return view('admin.informasi_data_umkm.partial.desil', compact(
        'labelsDesils', 'valuesDesils', 'perempuan14', 'laki14', 
        'perempuan510','laki510', 'totalDesil14', 'totalDesil510'
    ));
}
}
