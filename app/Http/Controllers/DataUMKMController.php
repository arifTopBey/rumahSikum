<?php

namespace App\Http\Controllers;

use App\Interface\UmkmInterface;
use App\Models\IdentitasUsaha;
use App\Models\LaporanKeuangan;
use App\Models\ProduksiDanPemasaran;
use App\Models\SkalaUsaha;
use App\Models\UsahaKarakteristik;
use App\Models\UsahaPerizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataUMKMController extends Controller
{

    protected $umkmRepo;

    public function __construct(UmkmInterface $umkmRepo)
    {
        $this->umkmRepo = $umkmRepo;
    }

    public function indexCopy()
    {

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

        // ============== point d berdasarkan desil ============================
        $data = DB::table('usaha_laporan_keuangan')
            ->whereNotNull('omzet_usaha')
            ->orderBy('omzet_usaha')
            ->pluck('omzet_usaha');

        $total = $data->count();
        $perDesil = floor($total / 10);


        $desil = [];

        for ($i = 1; $i <= 10; $i++) {

            $start = ($i - 1) * $perDesil;

            if ($i == 10) {
                $slice = $data->slice($start);
            } else {
                $slice = $data->slice($start, $perDesil);
            }

            $desil[] = [
                'desil' => "Desil $i",
                'min' => $slice->min(),
                'max' => $slice->max(),
                'jumlah' => $slice->count()
            ];
        }

        $labelsDesils = collect($desil)->pluck('desil');
        $valuesDesils = collect($desil)->pluck('jumlah');

        $desil14 = collect($desil)->slice(0, 4);
        $desil510 = collect($desil)->slice(4, 6);

        $totalDesil14 = $desil14->sum('jumlah');
        $totalDesil510 = $desil510->sum('jumlah');

        $laki14 = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('omzet_usaha')
            ->where('identitas_pengusaha.status_pengusaha', 1)
            ->limit($totalDesil14)
            ->count();

        $perempuan14 = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('omzet_usaha')
            ->where('identitas_pengusaha.status_pengusaha', 2)
            ->limit($totalDesil14)
            ->count();

        $data510 = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('omzet_usaha')
            ->orderBy('omzet_usaha')
            ->offset($totalDesil14)
            ->limit($totalDesil510)
            ->get();

        $laki510 = $data510->where('status_pengusaha', 1)->count();
        $perempuan510 = $data510->where('status_pengusaha', 2)->count();
        // ============== batas menggunakan desil ==============================


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

        return view(
            'admin.informasi_data_umkm.index',
            compact(
                'data',
                'totalUmkm',
                'identitasUsaha',
                'totalMicro',
                'cluster',
                'totalUsahaKecil',
                'totalUsahaMenengah',
                'kbliChartData',
                'punyaNIB',
                'tidakPunyaNIB',
                'totalJenisKelamin',
                'jenisKelamin',
                'persenLaki',
                'persenPerempuan',
                'persenTidak',
                'tenagaKerja',
                'totalTenagaKerja',
                'pemasaran',
                'labelsDesils',
                'valuesDesils',
                'totalDesil14',
                'totalDesil510',
                'laki14',
                'perempuan14',
                'laki510',
                'perempuan510',
                'dataCardKbli'
            )
        );
    }
    public function index()
    {

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
        
        // $totalMicro = LaporanKeuangan::where('omzet_usaha', '<=', 2_000_000_000)->count();
        // $totalUsahaKecil = LaporanKeuangan::whereBetween('omzet_usaha', [2_000_000_000, 15_000_000_000])->count();
        // $totalUsahaMenengah = LaporanKeuangan::whereBetween('omzet_usaha', [15_000_000_000, 50_000_000_000])->count();
        $totalMicro = SkalaUsaha::where('skala_usaha', 'mikro')->count();
        $totalUsahaKecil = SkalaUsaha::where('skala_usaha', 'kecil')->count();
        $totalUsahaMenengah = SkalaUsaha::where('skala_usaha', 'menengah')->count();
        // ================= batas point b identisas berdasarkan wilayah =====================

       

        return view(
            'admin.informasi_data_umkm.index',
            compact(
                'data',
                'totalUmkm',
                'totalUsahaKecil',
                'totalMicro',
                'totalUsahaMenengah'
            )
        );
    }

    public function list_umkm()
    {

        $data = $this->umkmRepo->getData(10, 1, 1);
        $data = $data['data'];
        return view('admin.umkm.index', compact('data'));
    }


    /**
      ============== filter grafik =========================

      ============== di klick ==============================
      */

    // done di ubah
public function filterSkala(Request $request)
{

        // $query = LaporanKeuangan::query();
        $query = SkalaUsaha::query();

        if ($request->skala == 'mikro') {
            // $query->where('omzet_usaha', '<=', 2_000_000_000);
           $query->where('skala_usaha', 'mikro');
        }

        if ($request->skala == 'kecil') {
            // $query->whereBetween('omzet_usaha', [2_000_000_000, 15_000_000_000]);
            $query->where('skala_usaha', 'kecil');

        }

        if ($request->skala == 'menengah') {
            // $query->whereBetween('omzet_usaha', [15_000_000_000, 50_000_000_000]);
           $query->where('skala_usaha', 'menengah');
        }

        // $data = $query->paginate(10)->withQueryString();
        $data = $query->search(request(['search']))->paginate(10)->withQueryString();


        return view('admin.informasi_data_umkm.skala.index', compact('data'));
    }

    // done diubah
    public function filterWilayah(Request $request)
    {

        
        $query = SkalaUsaha::with('identitasUsaha');

        if ($request->kecamatan) {
            $query->whereHas('identitasUsaha', function ($q) use ($request) {
                $q->where('kecamatan', 'like', '%' . $request->kecamatan . '%');
            });
        }

        // Filter Skala Usaha (dari Dropdown)
            if ($request->skala) {
                if ($request->skala == 'mikro') {
                    $query->where('skala_usaha', 'mikro');
                } elseif ($request->skala == 'kecil') {
                    $query->where('skala_usaha', 'kecil');
                } elseif ($request->skala == 'menengah') {
                    $query->where('skala_usaha', 'menengah');
                }
            }

        $data = $query->search(request(['search']))->paginate(10)->withQueryString();

        return view('admin.informasi_data_umkm.wilayah.index', compact('data'));
    }

    // done diubah
    public function filterWilayahDesa(Request $request)
    {

        
        $query = SkalaUsaha::with('identitasUsaha');

        if ($request->kelurahan) {
            $query->whereHas('identitasUsaha', function ($q) use ($request) {
                $q->where('kelurahan', 'like', '%' . $request->kelurahan . '%');
            });
        }

         // Filter Skala Usaha (dari Dropdown)
            if ($request->skala) {
                if ($request->skala == 'mikro') {
                    $query->where('skala_usaha', 'mikro');
                } elseif ($request->skala == 'kecil') {
                    $query->where('skala_usaha', 'kecil');
                } elseif ($request->skala == 'menengah') {
                    $query->where('skala_usaha', 'menengah');
                }
            }

        $data = $query->search(request(['search']))->paginate(10)->withQueryString();

        return view('admin.informasi_data_umkm.wilayah.desa', compact('data'));
    }

    // done diubah
    public function filterNIB(Request $request)
    {
        $query = SkalaUsaha::with('usahaKarakteristik', 'identitasUsaha');

        if ($request->status == 'Punya') {
            $query->whereHas('usahaKarakteristik', function ($q) {
                $q->whereNotNull('nomor_induk_berusaha')
                    ->where('nomor_induk_berusaha', '!=', '');
            });
        }

        if ($request->status == 'Tidak') {
            $query->whereHas('usahaKarakteristik', function ($q) {
                $q->whereNull('nomor_induk_berusaha');
            });
        }

        if ($request->skala) {
            if ($request->skala == 'mikro') {
                $query->where('skala_usaha', 'mikro');
            } elseif ($request->skala == 'kecil') {
                $query->where('skala_usaha', 'kecil');
            } elseif ($request->skala == 'menengah') {
                $query->where('skala_usaha', 'menengah');
            }
        }

        $data = $query->search(request(['search']))->paginate(10)->withQueryString();

        return view('admin.informasi_data_umkm.lainnya.index', compact('data'));
    }

    // done diubah
    public function filterGender(Request $request)
    {
        $query = SkalaUsaha::with('identitasPengusaha', 'identitasUsaha');

        if ($request->gender == 'Laki-Laki') {
            $query->whereHas('identitasPengusaha', function ($q) {
                $q->where('status_pengusaha', 1);
            });
        }

        if ($request->gender == 'Perempuan') {
            $query->whereHas('identitasPengusaha', function ($q) {
                $q->where('status_pengusaha', 2);
            });
        }

        if ($request->gender == 'Tidak Diketahui') {
            $query->whereHas('identitasPengusaha', function ($q) {
                $q->whereNotIn('status_pengusaha', [1, 2])
                    ->orWhereNull('status_pengusaha');
            });
        }

         if ($request->skala) {
             if ($request->skala == 'mikro') {
                $query->where('skala_usaha', 'mikro');
            } elseif ($request->skala == 'kecil') {
                $query->where('skala_usaha', 'kecil');
            } elseif ($request->skala == 'menengah') {
                $query->where('skala_usaha', 'menengah');
            }
        }

        // dd($query);

        // $data = $query->paginate(10)->withQueryString();
        $data = $query->search(request(['search']))->paginate(10)->withQueryString();


        return view('admin.informasi_data_umkm.lainnya.gender', compact('data'));
    }

    // done diubah
    public function filterTenagaKerja(Request $request)
    {
        $query = LaporanKeuangan::with('identitasUsaha', 'identitasPengusaha' , 'skalaUsaha')
            ->join('tenagaKerja', 'usaha_laporan_keuangan.id_badan_usaha', '=', 'tenagaKerja.id_data_badan_usaha');

        if ($request->status == 'Dibayar') {
            $query->where('tenagaKerja.total_pembayaran_upah', '>', 0);
        }

        if ($request->status == 'Tidak Dibayar') {
            $query->where(function ($q) {
                $q->whereNull('tenagaKerja.total_pembayaran_upah')
                    ->orWhere('tenagaKerja.total_pembayaran_upah', 0);
            });
        }
         if ($request->skala) {
            if ($request->skala == 'mikro') {
                // $query->where('omzet_usaha', '<=', 2000000);
                $query->whereHas('skalaUsaha', function($q){
                    $q->where('skala_usaha', 'mikro');
                });
            } elseif ($request->skala == 'kecil') {
                // $query->whereBetween('omzet_usaha', [2000001, 15000000]);
                 $query->whereHas('skalaUsaha', function($q){
                    $q->where('skala_usaha', 'kecil');
                });
            } elseif ($request->skala == 'menengah') {
                // $query->whereBetween('omzet_usaha', [15000001, 50000000]);
                 $query->whereHas('skalaUsaha', function($q){
                    $q->where('skala_usaha', 'menengah');
                });
            }
        }

        $data = $query->select('usaha_laporan_keuangan.*')->search(request(['search']))
            ->paginate(10)
            ->withQueryString();


        return view('admin.informasi_data_umkm.lainnya.tenagaKerja', compact('data'));
    }

    public function filterMetodeUsahaPemasaran(Request $request){
        // $kolom = $request->status; // Isinya: 'Toko Sendiri', 'Marketplace', dll
        $search = $request->search;
        $skala = $request->skala;

        // dd($request->metode);
        $query = ProduksiDanPemasaran::with('skalaUsaha', 'identitasUsaha');

        if($request->metode){
            if($request->metode === 'Digital'){
                $query->where('pemasaran_toko_sendiri', 1);
            }
            if($request->metode === 'NonDigital'){
                $query->where('pemasaran_titip_jual', 1);
            }
            if($request->metode === 'Perantara'){
                $query->where('pemasaran_reseller', 1);
            }
            if($request->metode === 'Pemerintah Pusat'){
                $query->where('pemasaran_distributor', 1);
            }
            if($request->metode === 'Provinsi'){
                $query->where('pemasaran_marketplace', 1);
            }
            if($request->metode === 'Kabupaten'){
                $query->where('pemasaran_media_sosial', 1);
            }
            if($request->metode === 'Lainnya'){
                $query->where('pemasaran_lainnya', 1);
            }
        }

         if ($request->skala) {
            if ($request->skala == 'mikro') {
                // $query->where('omzet_usaha', '<=', 2000000);
                $query->whereHas('skalaUsaha', function($q){
                    $q->where('skala_usaha', 'mikro');
                });
            } elseif ($request->skala == 'kecil') {
                // $query->whereBetween('omzet_usaha', [2000001, 15000000]);
                 $query->whereHas('skalaUsaha', function($q){
                    $q->where('skala_usaha', 'kecil');
                });
            } elseif ($request->skala == 'menengah') {
                // $query->whereBetween('omzet_usaha', [15000001, 50000000]);
                 $query->whereHas('skalaUsaha', function($q){
                    $q->where('skala_usaha', 'menengah');
                });
            }
        }

        $data = $query->select('usaha_produksi_pemasaran.*')->search(request(['search']))
            ->paginate(10)
            ->withQueryString();

     return view('admin.informasi_data_umkm.lainnya.metodePemasaran', compact('data'));
    }

    // done diubah
    public function filterLaporanKeuanagan(Request $request){

        $keuangan = $request->keuangan; // Berisi 'Memiliki' atau 'Tidak Memiliki'
        $status = ($keuangan == 'Memiliki') ? 1 : 2;

        

        $query = LaporanKeuangan::with(['identitasUsaha', 'skalaUsaha'])
            ->where('status_pencatatan_keuangan', $status)->search(request(['search']));
        if ($request->skala) {
                if ($request->skala == 'mikro') {
                    // $data->where('omzet_usaha', '<=', 2_000_000_000);
                    $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'mikro');
                    });
                } elseif ($request->skala == 'kecil') {
                    // $query->whereBetween('omzet_usaha', [2_000_000_000, 15_000_000]);
                     $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'kecil');
                    });
                } elseif ($request->skala == 'menengah') {
                    // $query->whereBetween('omzet_usaha', [15000001, 50000000]);
                      $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'menengah');
                    });
                }
        }
       
        // baru paginate di akhir
        $data = $query->paginate(10)->withQueryString();
        return view('admin.informasi_data_umkm.pemasaran.index', compact('data'));

    }

    // done di ubah skala
    public function filterDigital(Request $request){
        $statusLabel = $request->digital; // Berisi 'Memiliki' atau 'Tidak Memiliki'
        $statusValue = ($statusLabel == 'Memiliki') ? 1 : 2;

        // Mulai query dari model ProduksiDanPemasaran
        $query = ProduksiDanPemasaran::with(['identitasUsaha', 'skalaUsaha'])
            ->where('pemasaran_toko_sendiri', $statusValue);

        // Tambahkan filter search jika user mengetik di form pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('identitasUsaha', function($q) use ($search) {
                $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
                ->orWhere('kecamatan', 'like', "%{$search}%")
                ->orWhere('desa', 'like', "%{$search}%");
            });
        }
         if ($request->skala) {
                if ($request->skala == 'mikro') {
                    // $data->where('omzet_usaha', '<=', 2_000_000_000);
                    $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'mikro');
                    });
                } elseif ($request->skala == 'kecil') {
                    // $query->whereBetween('omzet_usaha', [2_000_000_000, 15_000_000]);
                     $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'kecil');
                    });
                } elseif ($request->skala == 'menengah') {
                    // $query->whereBetween('omzet_usaha', [15000001, 50000000]);
                      $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'menengah');
                    });
                }
        }

        $data = $query->paginate(10)->withQueryString();
        return view('admin.informasi_data_umkm.pemasaran.index', compact('data'));

    }
    public function filterNonDigital(Request $request){
        $statusLabel = $request->nondigital; 
        $statusValue = ($statusLabel == 'Memiliki') ? 1 : 2;

        // Mulai query dari model ProduksiDanPemasaran
        $query = ProduksiDanPemasaran::with(['identitasUsaha', 'skalaUsaha'])
            ->where('pemasaran_titip_jual', $statusValue);

        // Tambahkan filter search jika user mengetik di form pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('identitasUsaha', function($q) use ($search) {
                $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
                ->orWhere('kecamatan', 'like', "%{$search}%")
                ->orWhere('desa', 'like', "%{$search}%");
            });
        }
         if ($request->skala) {
                if ($request->skala == 'mikro') {
                    // $data->where('omzet_usaha', '<=', 2_000_000_000);
                    $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'mikro');
                    });
                } elseif ($request->skala == 'kecil') {
                    // $query->whereBetween('omzet_usaha', [2_000_000_000, 15_000_000]);
                     $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'kecil');
                    });
                } elseif ($request->skala == 'menengah') {
                    // $query->whereBetween('omzet_usaha', [15000001, 50000000]);
                      $query->whereHas('skalaUsaha', function($q){
                        $q->where('skala_usaha', 'menengah');
                    });
                }
        }

        $data = $query->paginate(10)->withQueryString();
        return view('admin.informasi_data_umkm.pemasaran.index', compact('data'));

    }

    public function filterStatusUsaha2(Request $request){

        //  $query = UsahaKarakteristik::query();
        $query = UsahaKarakteristik::query()
        ->join('usaha_laporan_keuangan as ulk', 'usaha_karakteristik.id_badan_usaha', '=', 'ulk.id_badan_usaha')
        ->join('identitasusaha as iu', 'usaha_karakteristik.id_badan_usaha', '=', 'iu.id_badan_usaha')
        // ->join('skala_usaha as su', 'su.id_badan_usaha', '=', 'iu.id_badan_usaha')
        ->select('usaha_karakteristik.*', 'iu.nama_lengkap_usaha', 'iu.kecamatan', 'ulk.omzet_usaha');
      

        $statusMap = [
        'pt' => 1, 'yayasan' => 2, 'cv' => 3, 'firma' => 4,
        'nv' => 5, 'danaPensiun' => 6, 'perorangan' => 7, 'lainnya' => 8
        ];

        if (isset($statusMap[$request->status])) {
            $query->where('usaha_karakteristik.status_badan_usaha', $statusMap[$request->status]);
        } elseif ($request->status == 'none') {
            $query->whereNull('usaha_karakteristik.status_badan_usaha');
        }
        // 2. Filter Tambahan: Skala Usaha (Berdasarkan Omzet)
        if ($request->skala) {
            if ($request->skala == 'mikro') {
                $query->where('ulk.omzet_usaha', '<=', 2000000);
                // $query->whereHas('skalaUsaha', function($q){
                //     $q->where('skala_usaha', 'mikro');
                // });

            } elseif ($request->skala == 'kecil') {
                $query->whereBetween('ulk.omzet_usaha', [2000001, 15000000]);
                //  $query->whereHas('skalaUsaha', function($q){
                //     $q->where('skala_usaha', 'kecil');
                // });

            } elseif ($request->skala == 'menengah') {
                $query->whereBetween('ulk.omzet_usaha', [15000001, 50000000]);
                //  $query->whereHas('skalaUsaha', function($q){
                //     $q->where('skala_usaha', 'menengah');
                // });

            }
        }

        $data = $query->search(request(['search']))->paginate(10)->withQueryString();
        return view('admin.informasi_data_umkm.statusUsaha.index', compact('data'));
    }

    public function filterStatusUsaha(Request $request)
{
    $status = $request->status;
    $skala = $request->skala;
    $search = $request->search;

    // Mulai query dari Model Utama dengan Eager Loading relasi
    $query = UsahaKarakteristik::query()->with(['identitasUsaha', 'keuangan', 'skalaUsaha']);

    // 1. Filter Status Badan Usaha
    $statusMap = [
        'pt' => 1, 'yayasan' => 2, 'cv' => 3, 'firma' => 4,
        'nv' => 5, 'danaPensiun' => 6, 'perorangan' => 7, 'lainnya' => 8
    ];

    if (isset($statusMap[$status])) {
        $query->where('status_badan_usaha', $statusMap[$status]);
    } elseif ($status == 'none') {
        $query->whereNull('status_badan_usaha');
    }

    // 2. Filter Skala Usaha (Menggunakan relasi ke tabel skala_usaha agar lebih akurat)
    if ($skala) {
        $query->whereHas('skalaUsaha', function($q) use ($skala) {
            $q->where('skala_usaha', $skala);
        });
    }

    // 3. Filter Search (Menggunakan pencarian pada tabel identitasusaha)
    if ($search) {
        $query->whereHas('identitasUsaha', function($q) use ($search) {
            $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
              ->orWhere('kecamatan', 'like', "%{$search}%");
        });
    }

    $data = $query->paginate(10)->withQueryString();

    return view('admin.informasi_data_umkm.statusUsaha.index', compact('data'));
}
    
    public function filterClusterData2(Request $request)
    {
        
        $cluster = $request->cluster;
        $search = $request->search; // Ambil input search
        $skala = $request->skala; // Tangkap input skala

        $query = DB::table('usaha_karakteristik as uk')
            ->join('identitasusaha as iu', 'uk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->join('usaha_laporan_keuangan as ulk', 'ulk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->select(
                'iu.nama_lengkap_usaha',
                'iu.alamat_lengkap', // Tambahkan ini agar search alamat tidak error
                'iu.telpon',
                'uk.id_badan_usaha',
                'uk.kode_kbli',
                'ulk.omzet_usaha',
                'iu.provinsi',
                'iu.kabupaten',
                'iu.kecamatan'
            )
            ->whereNotNull('uk.kode_kbli');

       

            // --- Filter Skala Usaha (Berdasarkan Omzet) ---
            if ($skala) {
                if ($skala == 'mikro') {
                    $query->where('ulk.omzet_usaha', '<=', 2_000_000_000);
                    } elseif ($skala == 'kecil') {
                    $query->whereBetween('ulk.omzet_usaha', [2_000_000_000,5000000]);
                    } elseif ($skala == 'menengah') {
                    $query->whereBetween('ulk.omzet_usaha',  [15_000_000_000, 50_000_000_000]);
                }
            }
        if ($cluster == 'Kuliner') {
            $query->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['10', '56']);
        }

        if ($cluster == 'Perdagangan') {
            $query->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['46', '47']);
        }

        if ($cluster == 'Industri') {
            $query->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['20', '23', '25']);
        }

        if ($cluster == 'Jasa') {
            $query->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['77', '95']);
        }

        if ($cluster == 'Pertanian') {
            $query->where(DB::raw('LEFT(uk.kode_kbli,2)'), '01');
        }

        if ($cluster == 'Lainnya') {
            $query->whereNotIn(DB::raw('LEFT(uk.kode_kbli,2)'), [
                '10',
                '56',
                '46',
                '47',
                '20',
                '23',
                '25',
                '77',
                '95',
                '01'
            ]);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('iu.nama_lengkap_usaha', 'like', "%{$search}%")
                ->orWhere('iu.alamat_lengkap', 'like', "%{$search}%")
                ->orWhere('iu.kecamatan', 'like', "%{$search}%")
                ->orWhere('iu.telpon', 'like', "%{$search}%");
            });
         }


        $data = $query->paginate(10)->withQueryString();
        // $data = $query->search(request(['search']))->paginate(10)->withQueryString();

        return view('admin.informasi_data_umkm.cluster.index', compact('data'));
    }
    public function filterClusterData(Request $request)
{
    $cluster = $request->cluster;
    $search = $request->search;
    $skala = $request->skala;

    // Mulai query dari Model Utama dengan Eager Loading
    $query = UsahaKarakteristik::query()
        ->with(['identitasUsaha', 'keuangan', 'skalaUsaha'])
        ->whereNotNull('kode_kbli');

    // 1. Filter Skala Usaha (Menggunakan tabel skala_usaha yang sudah kita buat)
    if ($skala) {
        $query->whereHas('skalaUsaha', function($q) use ($skala) {
            $q->where('skala_usaha', $skala);
        });
    }

    // 2. Filter Cluster (Menggunakan kode_kbli di tabel usaha_karakteristik)
    if ($cluster) {
        $query->where(function($q) use ($cluster) {
            if ($cluster == 'Kuliner') {
                $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['10', '56']);
            } elseif ($cluster == 'Perdagangan') {
                $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['46', '47']);
            } elseif ($cluster == 'Industri') {
                $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['20', '23', '25']);
            } elseif ($cluster == 'Jasa') {
                $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['77', '95']);
            } elseif ($cluster == 'Pertanian') {
                $q->where(DB::raw('LEFT(kode_kbli, 2)'), '01');
            } elseif ($cluster == 'Lainnya') {
                $q->whereNotIn(DB::raw('LEFT(kode_kbli, 2)'), ['10', '56', '46', '47', '20', '23', '25', '77', '95', '01']);
            }
        });
    }

    // 3. Filter Search (Menggunakan tabel identitasusaha)
    if ($search) {
        $query->whereHas('identitasUsaha', function($q) use ($search) {
            $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
              ->orWhere('alamat_lengkap', 'like', "%{$search}%")
              ->orWhere('kecamatan', 'like', "%{$search}%")
              ->orWhere('telpon', 'like', "%{$search}%");
        });
    }

    $data = $query->paginate(10)->withQueryString();

    return view('admin.informasi_data_umkm.cluster.index', compact('data'));
}

    public function filterPertumbuhanUsaha2(Request $request){

        $tahun = $request->tahun;
        $search = $request->search;
        $skala = $request->skala;

        $query = DB::table('usaha_karakteristik as uk')
            ->join('identitasusaha as iu', 'uk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->join('usaha_laporan_keuangan as ulk', 'ulk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->select(
                'iu.nama_lengkap_usaha',
                'iu.id_badan_usaha',
                'iu.nama_lengkap_usaha',
                'iu.kabupaten',
                'iu.kecamatan',
                'iu.provinsi',
                'uk.tahun_mulai_operasi',
                'ulk.omzet_usaha'
            )
            // Filter Utama berdasarkan tahun yang diklik di grafik
            ->where('uk.tahun_mulai_operasi', $tahun);

        // Filter Tambahan: Skala Usaha
        if ($skala) {
            if ($skala == 'mikro') {
                $query->where('ulk.omzet_usaha', '<=', 2000000);
            } elseif ($skala == 'kecil') {
                $query->whereBetween('ulk.omzet_usaha', [2000001, 15000000]);
            } elseif ($skala == 'menengah') {
                $query->whereBetween('ulk.omzet_usaha', [15000001, 50000000]);
            }
        }

        // Filter Search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('iu.nama_lengkap_usaha', 'like', "%{$search}%")
                ->orWhere('iu.kecamatan', 'like', "%{$search}%")
                ->orWhere('iu.kelurahan', 'like', "%{$search}%");
            });
        }

        $data = $query->paginate(10)->withQueryString();
        // dd($data);

        return view('admin.informasi_data_umkm.pertumbuhan.index', compact('data'));
    }

    public function filterPertumbuhanUsaha(Request $request) {
    $tahun = $request->tahun;
    $search = $request->search;
    $skala = $request->skala;

    // Mulai query dari Model utama
    $query = UsahaKarakteristik::query()
        ->with(['identitasUsaha', 'skalaUsaha']) // Eager Load relasi
        ->where('tahun_mulai_operasi', $tahun);

    // Filter Berdasarkan Skala Usaha (Berada di tabel usaha_laporan_keuangan)
    if ($skala) {
        $query->whereHas('skalaUsaha', function($q) use ($skala) {
            if ($skala == 'mikro') {
                // $q->where('omzet_usaha', '<=', 2000000);
                $q->where('skala_usaha', 'mikro');
            } elseif ($skala == 'kecil') {
                $q->where('skala_usaha', 'kecil');
            } elseif ($skala == 'menengah') {
                $q->where('skala_usaha', 'menengah');
            }
        });
    }

    // Filter Search (Berada di tabel identitasusaha)
    if ($search) {
        $query->whereHas('identitasUsaha', function($q) use ($search) {
            $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
              ->orWhere('kecamatan', 'like', "%{$search}%")
              ->orWhere('desa', 'like', "%{$search}%"); // Sesuaikan kelurahan/desa
        });
    }

    $data = $query->paginate(10)->withQueryString();

    return view('admin.informasi_data_umkm.pertumbuhan.index', compact('data'));
    }
    // done diubah
    public function filterPerizinan(Request $request){

        $izin = $request->izin; // Berisi: 'PIRT', 'BPOM', 'TDP', atau 'Halal'
        $search = $request->search;
        $skala = $request->skala;

        $query = UsahaPerizinan::with(['identitasUsaha', 'laporanKeuangan', 'skalaUsaha']);

        // 1. Mapping Label Grafik ke Kolom Database
        if ($izin == 'pirt') {
            $query->where('memiliki_pirt', 1);
        } elseif ($izin == 'bpom') {
            $query->where('memiliki_bpom', 1);
        } elseif ($izin == 'tdp') {
            $query->where('memiliki_tdp', 1);
        } elseif ($izin == 'halal') {
            $query->where('memiliki_sertifikat_halal', 1);
        }

        // 2. Filter Skala (Jika join ke laporan keuangan tersedia)
        if ($skala) {
            $query->whereHas('skalaUsaha', function ($q) use ($skala) {
                // if ($skala == 'mikro') $q->where('omzet_usaha', '<=', 2000000);
                // elseif ($skala == 'kecil') $q->whereBetween('omzet_usaha', [2000001, 15000000]);
                // elseif ($skala == 'menengah') $q->whereBetween('omzet_usaha', [15000001, 50000000]);
                if ($skala == 'mikro') $q->where('skala_usaha', 'mikro');
                elseif ($skala == 'kecil') $q->where('skala_usaha', 'kecil');
                elseif ($skala == 'menengah') $q->where('skala_usaha', 'menengah');
            });
        }

        // 3. Filter Search
        if ($search){
            $query->whereHas('identitasUsaha', function ($q) use ($search) {
                $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
                ->orWhere('kecamatan', 'like', "%{$search}%");
            });
        }

        $data = $query->paginate(10)->withQueryString();

        // dd($data);

        return view('admin.informasi_data_umkm.perizinan.index', compact('data'));

    }

    // done di ubah
    public function filterOmzet(Request $request)
{
    $skala = $request->skala;
    $query = SkalaUsaha::with('identitasUsaha');
    if ($skala == 'Di Bawah 2 Miliar') {
        $query->where('skala_usaha', 'mikro');
    } elseif ($skala == '2 Miliar - 15 Miliar') {
        $query->where('skala_usaha', 'kecil');
    } elseif ($skala == '15 Miliar - 50 Miliar') {
        $query->where('skala_usaha', 'menengah');
    }

    $data = $query->search(request(['search']))->paginate(10)->withQueryString();

    return view('admin.informasi_data_umkm.omzet.index', compact('data'));
}
    /**
      ============== batas filter grafik =========================

      ============== di klick ====================================
      **/

    // ===================== batas filter grafik =====================


    public function dataKbriKategori($kategori){
        
    }


    public function dataPerizinanUMKM(){

        // $totalPirt = UsahaPerizinan::where('memiliki_pirt', 1)->count();
        // $totalBpom = UsahaPerizinan::where('memiliki_bpom', 1)->count();
        // $totalTdp = UsahaPerizinan::where('memiliki_tdp', 1)->count();
        // $totalHalal = UsahaPerizinan::where('memiliki_sertifikat_halal', 1)->count();

        $perizinan = [
            'PIRT' => UsahaPerizinan::where('memiliki_pirt', 1)->count(),
            'BPOM' => UsahaPerizinan::where('memiliki_bpom', 1)->count(),
            'TDP' => UsahaPerizinan::where('memiliki_tdp', 1)->count(),
            'Halal' => UsahaPerizinan::where('memiliki_sertifikat_halal', 1)->count(),
        ];

        return view('admin.informasi_data_umkm.partial.perizinan', [
            'perizinan' => $perizinan,
            'totalPirt' => $perizinan['PIRT'],
            'totalBpom' => $perizinan['BPOM'],
            'totalTdp' => $perizinan['TDP'],
            'totalHalal' => $perizinan['Halal'],
        ]);
    }

    public function dataPemasaranUMKM(){

        $punyaLaporan = LaporanKeuangan::where('status_pencatatan_keuangan', 1)->count();
        $tidakPunyaLaporan = LaporanKeuangan::where('status_pencatatan_keuangan', 2)->count();

        // Data dikirim dalam bentuk array agar mudah dibaca Chart.js
        $dataKeuangan = [
            'Memiliki' => $punyaLaporan,
            'Tidak Memiliki' => $tidakPunyaLaporan
        ];

        $punyaDigital = ProduksiDanPemasaran::where('pemasaran_toko_sendiri', 1)->count();
        $tidakPunyaDigital = ProduksiDanPemasaran::where('pemasaran_toko_sendiri', 2)->count();
        $dataPemasaran = [
            'Memiliki' => $punyaDigital,
            'Tidak Memiliki' => $tidakPunyaDigital
        ];

        $punyaNonDigital = ProduksiDanPemasaran::where('pemasaran_titip_jual', 1)->count();
        $tidakPunyaNonDigital = ProduksiDanPemasaran::where('pemasaran_titip_jual', 2)->count();
        $dataNonDigital = [
            'Memiliki' => $punyaNonDigital,
            'Tidak Memiliki' => $tidakPunyaNonDigital
        ];

        return view('admin.informasi_data_umkm.partial.pemasaran', compact('dataKeuangan', 'tidakPunyaLaporan', 'punyaLaporan', 'dataPemasaran', 'dataNonDigital'));
    }

    public function dataStatusBadanUsaha(){

        // Definisi Map Label
        $labelsMap = [
            1 => 'PT',
            2 => 'Yayasan',
            3 => 'CV',
            4 => 'Firma',
            5 => 'NV',
            6 => 'Dana Pensiun',
            7 => 'Perorangan',
            8 => 'Lainnya',
            null => 'Tidak Ada'
        ];

        // Ambil data jumlah per status_badan_usaha
        $dataRaw = UsahaKarakteristik::select('status_badan_usaha', DB::raw('count(*) as total'))
                    ->groupBy('status_badan_usaha')
                    ->get();
        foreach ($labelsMap as $key => $label) {
        $chartLabels[] = $label;

        // Cari data yang sesuai, jika tidak ada set 0
        $row = $dataRaw->where('status_badan_usaha', $key)->first();
        $chartData[] = $row ? $row->total : 0;
    }
        $pt = UsahaKarakteristik::where('status_badan_usaha', 1)->count();
        $yayasan = UsahaKarakteristik::where('status_badan_usaha', 2)->count();
        $cv = UsahaKarakteristik::where('status_badan_usaha', 3)->count();
        $firma = UsahaKarakteristik::where('status_badan_usaha', 4)->count();
        $nv = UsahaKarakteristik::where('status_badan_usaha', 5)->count();
        $danaPensiun = UsahaKarakteristik::where('status_badan_usaha', 6)->count();
        $perorangan = UsahaKarakteristik::where('status_badan_usaha', 7)->count();
        $lainnya = UsahaKarakteristik::where('status_badan_usaha', 8)->count();
        $belumMemilikiStatus = UsahaKarakteristik::where('status_badan_usaha', null)->count();

        return view('admin.informasi_data_umkm.partial.usahaStatusBadanUsaha', compact('chartLabels', 'chartData','pt','yayasan','cv','firma','nv','danaPensiun','perorangan','lainnya', 'belumMemilikiStatus'));
    }

     public function dataPertumbuhanUmkm(){

        $dataTahun = UsahaKarakteristik::select('tahun_mulai_operasi', DB::raw('count(*) as total'))
            ->whereNotNull('tahun_mulai_operasi')
            ->where('tahun_mulai_operasi', '!=', '')
            ->groupBy('tahun_mulai_operasi')
            ->orderBy('tahun_mulai_operasi', 'asc') // Urutkan dari tahun terkecil
            ->get();

        // Siapkan label dan nilai untuk Chart.js
        $labels = $dataTahun->pluck('tahun_mulai_operasi');
        $values = $dataTahun->pluck('total');

        // $dataTahun = UsahaKarakteristik::select('tahun_mulai_operasi', DB::raw('count(*) as total'))
        // ->whereNotNull('tahun_mulai_operasi')
        // ->groupBy('tahun_mulai_operasi')
        // ->orderBy('tahun_mulai_operasi', 'asc')
        // ->get();

        // $finalData = [];
        // $sebelum2015 = 0;

        // foreach ($dataTahun as $item) {
        //     if ($item->tahun_mulai_operasi < 2015) {
        //         $sebelum2015 += $item->total;
        //     } else {
        //         $finalData[$item->tahun_mulai_operasi] = $item->total;
        //     }
        // }

        //     // Gabungkan: Data "Sebelum 2015" diletakkan di awal
        // $labels = array_merge(['< 2015'], array_keys($finalData));
        // $values = array_merge([$sebelum2015], array_values($finalData));

     return view('admin.informasi_data_umkm.partial.pertumbuhan_umkm', compact('labels', 'values'));
    }


    public function dataOmzetUsaha(){
        // Range Omzet sesuai instruksi
        $mikro = LaporanKeuangan::where('omzet_usaha', '<', 2000000000)->count(); // < 2 Miliar
        $kecil = LaporanKeuangan::whereBetween('omzet_usaha', [2000000000, 15000000000])->count(); // 2M - 15M
        $menengah = LaporanKeuangan::whereBetween('omzet_usaha', [15000000001, 50000000000])->count(); // > 15M - 50M

        $dataOmzet = [
            'labels' => ['Di Bawah 2 Miliar', '2 Miliar - 15 Miliar', '15 Miliar - 50 Miliar'],
            'values' => [$mikro, $kecil, $menengah]
        ];


         return view('admin.informasi_data_umkm.partial.omzet', compact('dataOmzet'));

    }
}
