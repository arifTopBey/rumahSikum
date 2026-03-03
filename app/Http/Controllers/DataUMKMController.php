<?php

namespace App\Http\Controllers;

use App\Interface\UmkmInterface;
use App\Models\IdentitasUsaha;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataUMKMController extends Controller
{

    protected $umkmRepo;

    public function __construct(UmkmInterface $umkmRepo)
    {
        $this->umkmRepo = $umkmRepo;
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

        // =============== point c karakteristik usaha berdasarkan kbli =======================
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
        // ============== batas point c karakteristik usaha berdasarkan kbli ==================

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
            ->where(function ($q) {
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
                'data', 'totalUmkm', 'identitasUsaha', 'totalMicro', 'cluster',
                'totalUsahaKecil', 'totalUsahaMenengah', 'kbliChartData', 'punyaNIB', 'tidakPunyaNIB', 
                'totalJenisKelamin', 'jenisKelamin', 'persenLaki', 'persenPerempuan', 'persenTidak',
                'tenagaKerja', 'totalTenagaKerja', 'pemasaran')
        );
    }

    public function list_umkm()
    {

        $data = $this->umkmRepo->getData(10, 1, 1);
        $data = $data['data'];
        return view('admin.umkm.index', compact('data'));
    }

    // public function show(int $id){

    //     $data = $this->umkmRepo->getFullDetail($id);

    //     // dd($data);

    //     return view('admin.umkm.show', compact('data'));
    // }


// ============== filter grafik =========================
   public function filterSkala(Request $request)
{
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

    $data = $query->paginate(10)->withQueryString();;

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

    $data = $query->paginate(10)->withQueryString();

    return view('admin.informasi_data_umkm.wilayah.index', compact('data'));
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

    $data = $query->paginate(10)->withQueryString();

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
            $q->whereNotIn('status_pengusaha', [1,2])
              ->orWhereNull('status_pengusaha');
        });
    }

    $data = $query->paginate(10)->withQueryString();

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

    $data = $query->select('usaha_laporan_keuangan.*')
                  ->paginate(10)
                  ->withQueryString();

    return view('admin.informasi_data_umkm.lainnya.tenagaKerja', compact('data'));
}
}
