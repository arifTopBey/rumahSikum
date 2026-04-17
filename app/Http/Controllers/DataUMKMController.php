<?php

namespace App\Http\Controllers;

use App\Interface\UmkmInterface;
use App\Models\IdentitasUsaha;
use App\Models\LaporanKeuangan;
use App\Models\ProduksiDanPemasaran;
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

        $totalMicro = LaporanKeuangan::where('omzet_usaha', '<=', 2000000)->count();
        $totalUsahaKecil = LaporanKeuangan::whereBetween('omzet_usaha', [2000000, 15000000])->count();
        $totalUsahaMenengah = LaporanKeuangan::whereBetween('omzet_usaha', [15000000, 50000000])->count();
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


    // ============== filter grafik =========================

    public function filterSkala(Request $request){
        $query = LaporanKeuangan::query();

        if ($request->skala == 'mikro') {
            $query->where('omzet_usaha', '<=', 2000000);
        }

        if ($request->skala == 'kecil') {
            $query->whereBetween('omzet_usaha', [2000001, 15000000]);
        }

        if ($request->skala == 'menengah') {
            $query->whereBetween('omzet_usaha', [15000001, 50000000]);
        }

        // $data = $query->paginate(10)->withQueryString();
        $data = $query->search(request(['search']))->paginate(10)->withQueryString();


        return view('admin.informasi_data_umkm.skala.index', compact('data'));
    }

    public function filterWilayah(Request $request)
    {

        
        $query = LaporanKeuangan::with('identitasUsaha');

        if ($request->kecamatan) {
            $query->whereHas('identitasUsaha', function ($q) use ($request) {
                $q->where('kecamatan', 'like', '%' . $request->kecamatan . '%');
            });
        }

        $data = $query->search(request(['search']))->paginate(10)->withQueryString();

        return view('admin.informasi_data_umkm.wilayah.index', compact('data'));
    }
    public function filterWilayahDesa(Request $request)
    {

        
        $query = LaporanKeuangan::with('identitasUsaha');

        if ($request->kelurahan) {
            $query->whereHas('identitasUsaha', function ($q) use ($request) {
                $q->where('kelurahan', 'like', '%' . $request->kelurahan . '%');
            });
        }

        $data = $query->search(request(['search']))->paginate(10)->withQueryString();

        return view('admin.informasi_data_umkm.wilayah.desa', compact('data'));
    }

    public function filterNIB(Request $request)
    {
        $query = LaporanKeuangan::with('usahaKarakteristik', 'identitasUsaha');

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

        $data = $query->search(request(['search']))->paginate(10)->withQueryString();

        return view('admin.informasi_data_umkm.lainnya.index', compact('data'));
    }

    public function filterGender(Request $request)
    {
        $query = LaporanKeuangan::with('identitasPengusaha', 'identitasUsaha');

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

        // $data = $query->paginate(10)->withQueryString();
        $data = $query->search(request(['search']))->paginate(10)->withQueryString();


        return view('admin.informasi_data_umkm.lainnya.gender', compact('data'));
    }

    public function filterTenagaKerja(Request $request)
    {
        $query = LaporanKeuangan::with('identitasUsaha', 'identitasPengusaha')
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

        $data = $query->select('usaha_laporan_keuangan.*')->search(request(['search']))
            ->paginate(10)
            ->withQueryString();

        return view('admin.informasi_data_umkm.lainnya.tenagaKerja', compact('data'));
    }

    public function filterLaporanKeuanagan(Request $request){

        $keuangan = $request->keuangan; // Berisi 'Memiliki' atau 'Tidak Memiliki'
        $status = ($keuangan == 'Memiliki') ? 1 : 2;

        $data = LaporanKeuangan::with(['identitasUsaha'])
            ->where('status_pencatatan_keuangan', $status)->search(request(['search']))
            ->paginate(10)
            ->withQueryString();

        // $data = $query->search(request(['search']))->paginate(10)->withQueryString();
        return view('admin.informasi_data_umkm.pemasaran.index', compact('data'));

    }

    public function filterDigital(Request $request){
        $statusLabel = $request->digital; // Berisi 'Memiliki' atau 'Tidak Memiliki'
        $statusValue = ($statusLabel == 'Memiliki') ? 1 : 2;

        // Mulai query dari model ProduksiDanPemasaran
        $query = ProduksiDanPemasaran::with(['identitasUsaha'])
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

        $data = $query->paginate(10)->withQueryString();
        return view('admin.informasi_data_umkm.pemasaran.index', compact('data'));

    }
    public function filterNonDigital(Request $request){
        $statusLabel = $request->nondigital; 
        $statusValue = ($statusLabel == 'Memiliki') ? 1 : 2;

        // Mulai query dari model ProduksiDanPemasaran
        $query = ProduksiDanPemasaran::with(['identitasUsaha'])
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

        $data = $query->paginate(10)->withQueryString();
        return view('admin.informasi_data_umkm.pemasaran.index', compact('data'));

    }

    // ===================== batas filter grafik =====================

    public function getClusterData(Request $request)
    {
        // $data = DB::table('usaha_karakteristik as uk')
        //     ->join('identitasusaha as iu', 'uk.id_badan_usaha', '=', 'iu.id_badan_usaha')
        //     ->join('usaha_laporan_keuangan as ulk', 'ulk.id_badan_usaha', '=', 'iu.id_badan_usaha')
        //     ->select(
        //         'iu.nama_lengkap_usaha',
        //         'uk.kode_kbli',
        //         'ulk.omzet_usaha',
        //         'iu.provinsi',
        //         'iu.kabupaten',
        //         'iu.kecamatan'
        //     )
        //     ->whereNotNull('uk.kode_kbli')
        //     ->where(function ($q) use ($kluster) {

        //         if ($kluster == 'Kuliner') {
        //             $q->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['10','56']);
        //         }

        //         if ($kluster == 'Perdagangan') {
        //             $q->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['46','47']);
        //         }

        //         if ($kluster == 'Industri') {
        //             $q->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['20','23','25']);
        //         }

        //         if ($kluster == 'Jasa') {
        //             $q->whereIn(DB::raw('LEFT(uk.kode_kbli,2)'), ['77','95']);
        //         }

        //         if ($kluster == 'Pertanian') {
        //             $q->where(DB::raw('LEFT(uk.kode_kbli,2)'), '01');
        //         }

        //         if ($kluster == 'Lainnya') {
        //             $q->whereNotIn(DB::raw('LEFT(uk.kode_kbli,2)'), [
        //                 '10','56','46','47','20','23','25','77','95','01'
        //             ]);
        //         }

        //     })
        //     ->paginate(10);

        $cluster = $request->cluster;
        $search = $request->search; // Ambil input search
        $query = DB::table('usaha_karakteristik as uk')
            ->join('identitasusaha as iu', 'uk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->join('usaha_laporan_keuangan as ulk', 'ulk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->select(
                'iu.nama_lengkap_usaha',
                'uk.id_badan_usaha',
                'uk.kode_kbli',
                'ulk.omzet_usaha',
                'iu.provinsi',
                'iu.kabupaten',
                'iu.kecamatan'
            )
            ->whereNotNull('uk.kode_kbli');

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

        // return view('admin.informasi_data_umkm.partial.perizinan', compact(
        //     'totalPirt', 
        //     'totalBpom', 
        //     'totalTdp', 
        //     'totalHalal'
        //  ));

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
}
