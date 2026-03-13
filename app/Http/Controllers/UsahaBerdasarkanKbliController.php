<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class UsahaBerdasarkanKbliController extends Controller
{
    

    public function index(){

         //=========== data kbli =================== 
        // $kbliChartData = DB::table('usaha_karakteristik')
        //     ->selectRaw('LEFT(kode_kbli,1) as kategori_kbli, COUNT(*) as total')
        //     ->whereNotNull('kode_kbli')
        //     ->groupBy(DB::raw('LEFT(kode_kbli,1)'))
        //     ->orderByDesc('total')
        //     ->get();

        $kbliChartData = DB::table('usaha_karakteristik')
            ->selectRaw("
        CASE
            WHEN LEFT(kode_kbli,1) IN ('0','1','2','3') THEN 'C'
            WHEN LEFT(kode_kbli,1) = '4' THEN 'G'
            WHEN LEFT(kode_kbli,1) = '5' THEN 'I'
            WHEN LEFT(kode_kbli,1) = '6' THEN 'H'
            WHEN LEFT(kode_kbli,1) = '7' THEN 'M'
            WHEN LEFT(kode_kbli,1) = '8' THEN 'S'
            WHEN LEFT(kode_kbli,1) = '9' THEN 'J'
        END as kategori_kbli,
        COUNT(*) as total")
            ->whereNotNull('kode_kbli')
            ->groupByRaw("
        CASE
            WHEN LEFT(kode_kbli,1) IN ('0','1','2','3') THEN 'C'
            WHEN LEFT(kode_kbli,1) = '4' THEN 'G'
            WHEN LEFT(kode_kbli,1) = '5' THEN 'I'
            WHEN LEFT(kode_kbli,1) = '6' THEN 'H'
            WHEN LEFT(kode_kbli,1) = '7' THEN 'M'
            WHEN LEFT(kode_kbli,1) = '8' THEN 'S'
            WHEN LEFT(kode_kbli,1) = '9' THEN 'J'
        END")->orderByDesc('total')->get();

        $kategoriKbli = DB::table('usaha_karakteristik') ->selectRaw("LEFT(kode_kbli,1) as kategori,COUNT(*) as total")->whereNotNull('kode_kbli')
        ->groupByRaw("LEFT(kode_kbli,1)")
        ->orderByDesc('total')
        ->get();
        
        $namaKategoriKbli = [
            '4' => 'PERDAGANGAN BESAR DAN ECERAN, REPARASI DAN PERAWATAN MOBIL DAN SEPEDA MOTOR',
            '5' => 'PENYEDIAAN AKOMODASI DAN PENYEDIAAN MAKAN DAN MINUM',
            '1' => 'PERTANIAN, KEHUTANAN DAN PERIKANAN',
            '2' => 'PERTAMBANGAN DAN PENGGALIAN',
            '3' => 'INDUSTRI PENGOLAHAN'
        ];
        $namaDeskripsiKbli = [
            '4' => 'Kategori ini mencakup kegiatan ekonomi lapangan usaha yang berkaitan
                dengan perdagangan besar dan eceran berbagai jenis barang, serta jasa reparasi dan
                perawatan kendaraan bermotor',
            '5' => 'Kegiatan ini mencakup kegiatan ekonomi lapangan usaha yang berkaitan
            dengan penyediaan layanan penginapan dan penyediaan makanan dan minuman untuk dikonsumsi
            langsung',
            '1' => 'Kategori ini mencakup kegiatan ekonomi lapangan usaha yang tidak
            termasuk dalam kategori lainnya, seperti jasa perorangan, jasa rumah tangga, dan jasa
            lainnya yang mendukung kegiatan ekonomi',
            '2' => 'Kategori ini meliputi kegiatan ekonomi/lapangan usaha dibidang
            perubahan secara kimia atau fisik dari bahan, unsur, atau komponen menjadi produk baru.
            Bahan baku industri pengolahan berasal dari produk pertanian, kehutanan, perikanan,
            pertambangan atau penggalian seperti produk dari kegiatan industri pengolahan lainnya.
            Perubahan, pembaharuan, atau rekontruksi yang pokok dari barang secara umum,
            diperlakukan sebagai industri pengolahan',
            '3' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit nihil quos dignissimos provident dolor quod itaque amet commodi placeat obcaecati?',
        ];


        $dataCardKbli = [];
        $lainnya = [
            'total' => 0,
            'mikro' => 0,
            'kecil' => 0,
            'menengah' => 0
        ];

        foreach ($kategoriKbli as $item) {

            if(!isset($namaKategoriKbli[$item->kategori])){
                    $lainnya['total'] += $item->total;
                    continue;
             }

            $mikroKbli = DB::table('usaha_laporan_keuangan')
                ->join('usaha_karakteristik','usaha_karakteristik.id_badan_usaha','=','usaha_laporan_keuangan.id_badan_usaha')
                ->whereRaw("LEFT(usaha_karakteristik.kode_kbli,1) = ?", [$item->kategori])
                ->where('omzet_usaha','<=',2000000)
                ->count();

            $kecilKbli = DB::table('usaha_laporan_keuangan')
                ->join('usaha_karakteristik','usaha_karakteristik.id_badan_usaha','=','usaha_laporan_keuangan.id_badan_usaha')
                ->whereRaw("LEFT(usaha_karakteristik.kode_kbli,1) = ?", [$item->kategori])
                ->whereBetween('omzet_usaha',[2000000,15000000])
                ->count();

            $menengahKbli = DB::table('usaha_laporan_keuangan')
                ->join('usaha_karakteristik','usaha_karakteristik.id_badan_usaha','=','usaha_laporan_keuangan.id_badan_usaha')
                ->whereRaw("LEFT(usaha_karakteristik.kode_kbli,1) = ?", [$item->kategori])
                ->whereBetween('omzet_usaha',[15000000,50000000])
                ->count();

            $dataCardKbli[] = [
                'kategori' => $namaKategoriKbli[$item->kategori] ?? 'Aktivitas Jasa Lainnya',
                'deskripsi' => $namaDeskripsiKbli[$item->kategori] ?? 'Lainnya',
                'total' => $item->total,
                'mikro' => $mikroKbli,
                'kecil' => $kecilKbli,
                'menengah' => $menengahKbli
            ];
        }

        // dd($dataCardKbli);

        // =========== batas data kbli =============

        return view('admin.informasi_data_umkm.partial.kbli', compact('dataCardKbli','kategoriKbli', 'kbliChartData'));
    }
}
