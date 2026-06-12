<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KoperasiController extends Controller
{

    private function getAccessToken()
    {
        try {
            $username = 'tangerang';
            $password = 'tangerang@621';

            $response = Http::withBasicAuth($username, $password)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post('https://nik.kop.go.id/odsapi/odslogin');

            if ($response->successful()) {
                $data = $response->json();
                return $data['token'] ?? null;
            }

            Log::error('ODS Token Request Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('ODS Token Exception: ' . $e->getMessage());
            return null;
        }
    }

    public function getDashboardData()
    {
        $token = $this->getAccessToken();

        if (!$token) {
            return back()->with('error', 'Gagal mendapatkan token akses.');
        }

        $result = Cache::store('file')->remember('ods_full_data_dashboard', 1800, function () use ($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->post('https://nik.kop.go.id/odsapi/odsprofile');

            return $response->successful() ? $response->json() : null;
        });

        if (!$result || !isset($result['data'])) {
            return back()->with('error', 'Data API Kosong atau Tidak Valid.');
        }

        // Bungkus array data ke dalam Laravel Collection agar mudah diolah
        $collection = collect($result['data']);
        // 1. KOTAK STATISTIK UTAMA (ATAS)
        $totalKoperasi = $collection->count();
        // Berdasarkan struktur respons rekap profile.pdf:
        $koperasiAktif = $collection->where('StatusKoperasi', 'Aktif')->count();

        $sertifikatAktif = $collection->where('Status_Sertifikat', 'Sertifikat Aktif')->count();
        $sertifikatExp = $collection->where('Status_Sertifikat', 'Sertifikat Expired')->count();
        // Jika di data bertuliskan 'Expired', sesuaikan: 
        // $sertifikatExp = $collection->where('Status_Sertifikat', 'Expired')->count();

        $sudahSertifikat = $sertifikatAktif + $sertifikatExp;
        $belumSertifikat = $totalKoperasi - $sudahSertifikat;


        $totalAnggota = $collection->sum('Jumlah_Anggota') ?? 423330;
        $anggotaPria = $collection->sum('Anggota_Pria') ?? 64998;
        $anggotaWanita = $totalAnggota - $anggotaPria;

        $totalKaryawan = $collection->sum('Jumlah_Karyawan') ?? 1947;
        $karyawanPria = $collection->sum('Karyawan_Pria') ?? 1337;
        $karyawanWanita = $totalKaryawan - $karyawanPria;

        $totalManajer = $collection->sum('Jumlah_Manajer') ?? 205;
        $manajerPria = $collection->sum('Manajer_Pria') ?? 164;
        $manajerWanita = $totalManajer - $manajerPria;

        // Keuangan (Dalam Miliar)
        $totalAset = $collection->sum('Total_Aset') ?? 2965;
        $totalVolume = $collection->sum('Volume_Usaha') ?? 1273;
        $totalSHU = $collection->sum('SHU') ?? 69;

        // 3. GRAFIK GRADE (PENGELOMPOKAN) [cite: 91]
        // Menghitung jumlah masing-masing Grade secara otomatis
        $gradeCounts = $collection->groupBy('Grade')->map->count();
        $gradeData = [
            'A' => $gradeCounts->get('A', 0),
            'B' => $gradeCounts->get('B', 0),
            'C' => $gradeCounts->get('C', 0) + $gradeCounts->get('C1', 0) + $gradeCounts->get('C2', 0),
            'Non_Grade' => $gradeCounts->get('', 0) + $gradeCounts->get('-', 0)
        ];

        // 4. GRAFIK RAT (SUDAH / BELUM) [cite: 71]
        // Cek apakah data Tanggal_RAT_Terakhir terisi atau mengandung tahun saat ini
        $sudahRAT = $collection->filter(function ($item) {
            return !empty($item['Tanggal_RAT_Terakhir']) && $item['Tanggal_RAT_Terakhir'] != '-';
        })->count();
        $belumRAT = $totalKoperasi - $sudahRAT;

        return view('admin.koperasi.dashboardKoperasi', compact(
            'result',
            'koperasiAktif',
            'belumSertifikat',
            'sudahSertifikat',
            'sertifikatAktif',
            'sertifikatExp',
            'totalAnggota',
            'anggotaPria',
            'anggotaWanita',
            'totalKaryawan',
            'karyawanPria',
            'karyawanWanita',
            'totalManajer',
            'manajerPria',
            'manajerWanita',
            'totalAset',
            'totalVolume',
            'totalSHU',
            'gradeData',
            'sudahRAT',
            'belumRAT'
        ));
    }


    public function index()
    {

        // 1. Ambil token terlebih dahulu
        $token = $this->getAccessToken();

        if (!$token) {
            return abort(500, 'Gagal mendapatkan akses token dari API ODS');
        }

        // 2. Request data profile menggunakan token yang aktif
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->post('https://nik.kop.go.id/odsapi/odsprofile');

            if ($response->successful()) {
                $result = $response->json();


                // Misal kita ambil 100 data pertama saja untuk ditamilkan dulu 
                // (opsional: hapus baris array_slice ini jika nanti ingin memakai DataTables penuh)
                $allData = $result['data'] ?? [];
                $result['data'] = array_slice($allData, 0, 100);
                return view('admin.koperasi.index', compact('result'));
            }

            return abort($response->status(), 'Gagal mengambil data profile koperasi');
        } catch (\Exception $e) {
            Log::error('ODS Profile Error: ' . $e->getMessage());
            return abort(500, 'Terjadi kesalahan sistem.');
        }
    }

    /**
     * Fungsi untuk mengambil dan menampilkan detail satu koperasi berdasarkan NIK
     */
    public function showDetail($nik)
    {
        $token = $this->getAccessToken();

        if (!$token) {
            return back()->with('error', 'Gagal mendapatkan akses token untuk memuat detail.');
        }

        try {
            // Tembak endpoint detail dengan membawa token dan body 'nik'
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ])->post('https://nik.kop.go.id/odsapi/odsdetail', [
                        'nik' => $nik
                    ]);


            if ($response->successful()) {
                $result = $response->json();

                // Mengambil object koperasi pertama dari array 'data'
                $koperasi = $result['data'][0] ?? null;

                if (!$koperasi) {
                    dd($result);
                    return back()->with('error', 'Detail data koperasi tidak ditemukan.');
                }

                // Kirim data ke view detail
                return view('admin.koperasi.detail', compact('koperasi'));
            }

            return back()->with('error', 'Gagal berkomunikasi dengan API Detail Pusat.');
        } catch (\Exception $e) {
            Log::error('ODS Detail Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem saat memuat detail.');
        }
    }

    public function show()
    {
        return view('admin.koperasi.detail');
    }

    public function indexKuk()
    {
        $token = $this->getAccessToken();

        // Ambil data profile dari Cache/API seperti biasa
        $result = Cache::store('file')->remember('ods_full_data_dashboard', 1800, function () use ($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->post('https://nik.kop.go.id/odsapi/odsprofile');

            return $response->successful() ? $response->json() : null;
        });

        if (!$result || !isset($result['data'])) {
            return back()->with('error', 'Data API tidak valid.');
        }

        // Bungkus ke dalam koleksi Laravel
        $collection = collect($result['data']);
        $totalKoperasi = $collection->count();

        // Hitung jumlah masing-masing kategori KUK (antisipasi string kosong atau null)
        $kuk1 = $collection->where('KUK', '1')->count();
        $kuk2 = $collection->where('KUK', '2')->count();
        $kuk3 = $collection->where('KUK', '3')->count();
        $kuk4 = $collection->where('KUK', '4')->count();

        // Hitung Persentase (jika total koperasi > 0 untuk menghindari pembagian dengan angka 0)
        $pctKuk1 = $totalKoperasi > 0 ? round(($kuk1 / $totalKoperasi) * 100, 2) : 0;
        $pctKuk2 = $totalKoperasi > 0 ? round(($kuk2 / $totalKoperasi) * 100, 2) : 0;
        $pctKuk3 = $totalKoperasi > 0 ? round(($kuk3 / $totalKoperasi) * 100, 2) : 0;
        $pctKuk4 = $totalKoperasi > 0 ? round(($kuk4 / $totalKoperasi) * 100, 2) : 0;

        return view('admin.kuk', compact(
            'kuk1',
            'kuk2',
            'kuk3',
            'kuk4',
            'pctKuk1',
            'pctKuk2',
            'pctKuk3',
            'pctKuk4'
        ));
    }

    public function statistikKoperasi()
    {

        return view('admin.koperasi.statistikKoperasi');
    }
    public function pendirianKoperasi()
    {

        return view('admin.koperasi.pendirian');
    }

    public function jenisKoperasi()
    {

        return view('admin.koperasi.jenisKoperasi');
    }

    public function kukKoperasi()
    {

        return view('admin.koperasi.kukKoperasi');
    }

    public function grafikKoperasi()
    {

        return view('admin.koperasi.grafikKoperasi');
    }

    public function gradeKoperasi()
    {
        return view('admin.koperasi.gradeKoperasi');
    }

    public function dashboardKoperasi()
    {

        return view('admin.koperasi.dashboardKoperasi');
    }
}
