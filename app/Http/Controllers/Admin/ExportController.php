<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GenderExport;
use App\Exports\LaporanKeuanganExport;
use App\Exports\MetodePemasaranExport;
use App\Exports\NibExport;
use App\Exports\PemasaranDigitalExport;
use App\Exports\PerizinanExport;
use App\Exports\PertumbuhanUsahaExport;
use App\Exports\PertumbuhanUsahaMikro;
use App\Exports\StatusUsahaExport;
use App\Exports\TenagaKerjaExport;
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
    public function exportPertumbuhan2(Request $request)
    {
        $tahun = $request->tahun;
        $search = $request->search;
        $skala = $request->skala;

        return Excel::download(
            new PertumbuhanUsahaExport($tahun, $search, $skala),
            'pertumbuhan-usaha.xlsx'
        );
    }

    public function exportPertumbuhan(Request $request)
{
    $tahun  = $request->tahun;
    $skala  = $request->skala;
    $search = $request->search;

    return Excel::download(
        new PertumbuhanUsahaExport($tahun, $skala, $search),
        'Pertumbuhan_Usaha_' . ($tahun ?? 'Semua') . '.xlsx'
    );
}

    public function exportBerdasarkanOmset(Request $request)
    {

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


    public function exportWilayah(Request $request, $kecamatan)
    {
        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            // new UmkmWilayahExport($kecamatan),
            new UmkmWilayahExport($kecamatan, $skala, $search),
            "UMKM_Wilayah_$kecamatan.xlsx",
            // \Maatwebsite\Excel\Excel::CSV
        );
    }
    public function exportWilayahKelurahan(Request $request, $kelurahan)
    {

        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            new UmkmWilayahKelurahanExport($kelurahan, $skala, $search),
            "UMKM_Wilayah_$kelurahan.xlsx",
        );
    }

    public function exportBerdasarkanCluster(Request $request, $cluster)
    {
        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            new UmkmClusterExport($cluster, $skala, $search),
            "UMKM_Cluster_$cluster.xlsx",
        );
    }

    public function exportDesil()
    {

    }

    public function exportKbli()
    {

    }

    public function exportLaporanKeuangan(Request $request)
    {

        $keuangan = $request->keuangan;
        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            new LaporanKeuanganExport($keuangan, $skala, $search),
            "Laporan Keuangan_$keuangan.xlsx",
        );
    }

    public function exportPemasaranDigital(Request $request)
    {
        $digital = $request->digital;
        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            new PemasaranDigitalExport($digital, $skala, $search),
            'Pemasaran_Digital_' . ($digital ?? 'Semua') . '.xlsx'
        );
    }
    public function exportPemasaranNonDigital(Request $request)
    {
        $Nondigital = $request->nondigital;
        $skala = $request->skala;
        $search = $request->search;

        return Excel::download(
            new PemasaranDigitalExport($Nondigital, $skala, $search),
            'Pemasaran_Non_Digital_' . ($Nondigital ?? 'Semua') . '.xlsx'
        );
    }

    public function exportStatusUsaha(Request $request)
    {
        $status = $request->status;
        $skala = $request->skala;
        $search = $request->search;

        $labelMap = [
            'pt' => 'PT',
            'yayasan' => 'Yayasan',
            'cv' => 'CV',
            'firma' => 'Firma',
            'nv' => 'NV',
            'danaPensiun' => 'Dana_Pensiun',
            'perorangan' => 'Perorangan',
            'lainnya' => 'Lainnya',
            'none' => 'None',
        ];

        $filename = 'Status_Usaha_' . ($labelMap[$status] ?? 'Semua') . '.xlsx';

        return Excel::download(
            new StatusUsahaExport($status, $skala, $search),
            $filename
        );
    }

    public function exportPerizinan(Request $request)
    {
        $izin = $request->izin;
        $skala = $request->skala;
        $search = $request->search;

        $filename = 'Perizinan_' . strtoupper($izin ?? 'Semua') . '.xlsx';

        return Excel::download(
            new PerizinanExport($izin, $skala, $search),
            $filename
        );
    }

    public function exportNIB(Request $request){
        $status = $request->status;
        $skala  = $request->skala;
        $search = $request->search;

        return Excel::download(
            new NibExport($status, $skala, $search),
            'NIB_' . ($status ?? 'Semua') . '.xlsx'
        );
    }

    public function exportGender(Request $request){
    $gender = $request->gender;
    $skala  = $request->skala;
    $search = $request->search;

    return Excel::download(
        new GenderExport($gender, $skala, $search),
        'Gender_' . ($gender ?? 'Semua') . '.xlsx'
    );
    }

    public function exportTenagaKerja(Request $request)
{
    $status = $request->status;
    $skala  = $request->skala;
    $search = $request->search;

    return Excel::download(
        new TenagaKerjaExport($status, $skala, $search),
        'Tenaga_Kerja_' . ($status ?? 'Semua') . '.xlsx'
    );
    }

    public function exportMetodePemasaran(Request $request)
{
    $metode = $request->metode;
    $skala  = $request->skala;
    $search = $request->search;

    return Excel::download(
        new MetodePemasaranExport($metode, $skala, $search),
        'Metode_Pemasaran_' . ($metode ?? 'Semua') . '.xlsx'
    );
}
}
