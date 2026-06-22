<?php

namespace App\Http\Controllers\Filter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KoperasiFilterController extends Controller
{
    public function getListByChart(Request $request)
    {
        $type = $request->input('type');       // Contoh: 'Sektor_Usaha', 'Jenis_Koperasi', 'Bentuk_Koperasi', 'Pola_Pengelolaan'
        $value = $request->input('value');     // Contoh: 'Konsumen', 'JASA LAINNYA', dll.
        $datasetLabel = $request->input('datasetLabel'); 

        $token = $this->getAccessToken();
        $result = Cache::store('file')->get('ods_full_data_dashboard');

        if (!$result || !isset($result['data'])) {
            return response()->json(['html' => '<tr><td colspan="5" class="text-center text-danger">Gagal memuat cache data.</td></tr>']);
        }

        $collection = collect($result['data']);

        // Proses Penyaringan Data secara Dinamis
        $filtered = $collection->filter(function ($item) use ($type, $value, $datasetLabel) {
            if ($type === 'Bentuk_Koperasi') {
                $textBentuk = $item['Bentuk_Koperasi'] ?? '';
                $isPrimer = str_contains(strtoupper($textBentuk), 'PRIMER');

                // Cek kecocokan Primer/Sekunder sesuai bar dataset yang diklik
                if (strtoupper($datasetLabel) === 'PRIMER' && !$isPrimer)
                    return false;
                if (strtoupper($datasetLabel) === 'SEKUNDER' && $isPrimer)
                    return false;

                if ($value === 'Primer Provinsi')
                    return str_contains(strtoupper($textBentuk), 'PROVINSI');
                if ($value === 'Sekunder Nasional')
                    return str_contains(strtoupper($textBentuk), 'NASIONAL');
                if ($value === 'Sekunder Kabupaten/Kota')
                    return (str_contains(strtoupper($textBentuk), 'KABUPATEN') || str_contains(strtoupper($textBentuk), 'KOTA'));
                return false;
            }

            if ($type === 'Pola_Pengelolaan') {
                $pola = strtoupper($item['Pola_Pengelolaan'] ?? '');
                if ($value === 'Syariah')
                    return str_contains($pola, 'SYARIAH');
                // Jika konvensional, saring yang bernilai KONVENSIONAL atau kosong (default)
                return ($pola === 'KONVENSIONAL' || empty($pola)) && $value === 'Konvensional';
            }

            // Default untuk Sektor Usaha dan Jenis Koperasi
            return strtoupper(trim($item[$type] ?? '')) === strtoupper(trim($value));
        });

        // Render HTML Baris Tabel secara manual untuk dikirim kembali ke JavaScript
        $html = '';
        if ($filtered->isEmpty()) {
            $html .= '<tr><td colspan="5" class="text-center text-muted">Tidak ada data yang cocok.</td></tr>';
        } else {
            $no = 1;
            foreach ($filtered as $kop) {
                $html .= '<tr>
                <td class="text-center">' . $no++ . '</td>
                <td>' . e($kop['NIK'] ?? '-') . '</td>
                <td><strong>' . e($kop['Nama_Koperasi'] ?? '-') . '</strong></td>
                <td>' . e($kop['Desa'] ?? '-') . ', ' . e($kop['Kecamatan'] ?? '-') . '</td>
                <td class="text-center"><span class="badge bg-success">' . e($kop['StatusKoperasi'] ?? 'Aktif') . '</span></td>
                <td><a href="'. route('admin.koperasi.detail', Crypt::encryptString($kop['NIK'])) . ' ">Detail</a></td>

            </tr>';
            }
        }

        return response()->json([
            'title' => $value . ($datasetLabel ? ' (' . $datasetLabel . ')' : ''),
            'html' => $html
        ]);
    }

    public function getPendirianDetail(Request $request)
    {
        $type = $request->input('type');   // 'Pendirian', 'Perubahan', 'Pengesahan', 'Pertumbuhan'
        $year = $request->input('year');   // Contoh: '2024', '2025'
        $value = $request->input('value'); // Khusus Pengesahan: 'Pengesahan AHU' atau 'Pengesahan Lainnya'

        $result = Cache::store('file')->get('ods_full_data_dashboard');

        if (!$result || !isset($result['data'])) {
            return response()->json(['html' => '<tr><td colspan="5" class="text-center text-danger">Gagal memuat cache data.</td></tr>']);
        }

        $collection = collect($result['data']);
        $title = '';

        // Proses filtering berdasarkan tipe chart yang diklik
        if ($type === 'Pendirian') {
            $title = "Koperasi yang Berdiri pada Tahun $year";
            $filtered = $collection->filter(function ($item) use ($year) {
                return !empty($item['Tanggal_Badan_Hukum_Pendirian']) &&
                    \Carbon\Carbon::parse($item['Tanggal_Badan_Hukum_Pendirian'])->format('Y') === $year;
            });
        } elseif ($type === 'Perubahan') {
            $title = "Koperasi yang Melakukan Perubahan Anggaran Dasar pada Tahun $year";
            $filtered = $collection->filter(function ($item) use ($year) {
                return !empty($item['Tanggal_Perubahan_Anggaran_Dasar']) &&
                    \Carbon\Carbon::parse($item['Tanggal_Perubahan_Anggaran_Dasar'])->format('Y') === $year;
            });
        } elseif ($type === 'Pengesahan') {
            $title = "Koperasi dengan Lembaga $value";
            $filtered = $collection->filter(function ($item) use ($value) {
                $noBH = $item['Nomor_Badan_Hukum_Pendirian'] ?? '';
                $isAHU = str_contains(strtoupper($noBH), 'AHU');
                return $value === 'Pengesahan AHU' ? $isAHU : !$isAHU;
            });
        } elseif ($type === 'Pertumbuhan') {
            $title = "Akumulasi Koperasi Aktif Didirikan Hingga Tahun $year";
            $filtered = $collection->filter(function ($item) {
                $status = $item['StatusKoperasi'] ?? $item['Status Koperasi'] ?? '';
                return strtoupper(trim($status)) === 'AKTIF';
            })->filter(function ($item) use ($year) {
                return !empty($item['Tanggal_Badan_Hukum_Pendirian']) &&
                    \Carbon\Carbon::parse($item['Tanggal_Badan_Hukum_Pendirian'])->format('Y') <= $year;
            });
        } else {
            $filtered = collect();
        }

        // Render HTML row tabel
        $html = '';
        if ($filtered->isEmpty()) {
            $html .= '<tr><td colspan="5" class="text-center text-muted">Tidak ada data koperasi ditemukan.</td></tr>';
        } else {
            $no = 1;
            foreach ($filtered as $kop) {
                $html .= '<tr>
                <td class="text-center">' . $no++ . '</td>
                <td>' . e($kop['NIK'] ?? '-') . '</td>
                <td><strong>' . e($kop['Nama_Koperasi'] ?? '-') . '</strong></td>
                <td>' . e($kop['Desa'] ?? '-') . ', ' . e($kop['Kecamatan'] ?? '-') . '</td>
                <td class="text-center"><span class="badge bg-success">' . e($kop['StatusKoperasi'] ?? 'Aktif') . '</span></td>
                <td><a href="'. route('admin.koperasi.detail', Crypt::encryptString($kop['NIK'])) . ' ">Detail</a></td>

            </tr>';
            }
        }

        return response()->json([
            'title' => $title,
            'html' => $html
        ]);
    }

    public function getDemografiDetail(Request $request)
    {
        $type = $request->input('type');   // 'Anggota', 'Karyawan', 'Manajer'
        $gender = $request->input('gender'); // 'Pria' atau 'Wanita'

        $result = Cache::store('file')->get('ods_full_data_dashboard');

        if (!$result || !isset($result['data'])) {
            return response()->json(['html' => '<tr><td colspan="6" class="text-center text-danger">Gagal memuat cache data.</td></tr>']);
        }

        $collection = collect($result['data']);
        dd($collection->first());

        // PERBAIKAN: Sesuaikan dengan key asli data profile ODS API (case-insensitive & space-insensitive fallback)
        $apiKeyMap = [
            'Anggota'  => ['Pria' => 'Anggota_Pria', 'Wanita' => 'Anggota_Wanita'],
            'Karyawan' => ['Pria' => 'Karyawan_Pria', 'Wanita' => 'Karyawan_Wanita'],
            'Manajer'  => ['Pria' => 'Manajer_Pria', 'Wanita' => 'Manajer_Wanita'],
        ];

        $targetKey = $apiKeyMap[$type][$gender] ?? null;

        // Filter koperasi yang memiliki entitas terpilih > 0
        $filtered = $collection->filter(function ($item) use ($targetKey) {
            if (!$targetKey) return false;

            // Antisipasi variasi penulisan key: 'Anggota_Pria', 'Anggota Pria', atau 'anggotapria'
            $keyWithSpace = str_replace('_', ' ', $targetKey);
            $keyLowerNoUnder = str_replace('_', '', strtolower($targetKey));

            // Cari tahu key mana yang benar-benar ada di data API Anda
            $count = 0;
            if (isset($item[$targetKey])) {
                $count = $item[$targetKey];
            } elseif (isset($item[$keyWithSpace])) {
                $count = $item[$keyWithSpace];
            } else {
                // Fallback cari manual jika huruf besar/kecilnya berbeda dari API
                foreach ($item as $k => $v) {
                    if (str_replace(' ', '', strtolower($k)) === $keyLowerNoUnder) {
                        $count = $v;
                        break;
                    }
                }
            }

            return (int)$count > 0;
        });

        $title = "Daftar Koperasi yang Memiliki " . $type . " " . $gender;

        // Render baris tabel HTML
        $html = '';
        if ($filtered->isEmpty()) {
            $html .= '<tr><td colspan="6" class="text-center text-muted">Tidak ada data koperasi ditemukan dengan kriteria tersebut.</td></tr>';
        } else {
            $no = 1;
            foreach ($filtered as $kop) {
                // Ambil kembali nilai display dengan pencarian dinamis yang sama seperti di atas
                $keyWithSpace = str_replace('_', ' ', $targetKey);
                $keyLowerNoUnder = str_replace('_', '', strtolower($targetKey));

                $jumlahEntitas = 0;
                if (isset($kop[$targetKey])) {
                    $jumlahEntitas = $kop[$targetKey];
                } elseif (isset($kop[$keyWithSpace])) {
                    $jumlahEntitas = $kop[$keyWithSpace];
                } else {
                    foreach ($kop as $k => $v) {
                        if (str_replace(' ', '', strtolower($k)) === $keyLowerNoUnder) {
                            $jumlahEntitas = $v;
                            break;
                        }
                    }
                }

                $html .= '<tr>
                <td class="text-center">' . $no++ . '</td>
                <td>' . e($kop['NIK'] ?? '-') . '</td>
                <td><strong>' . e($kop['Nama_Koperasi'] ?? '-') . '</strong></td>
                <td>' . e($kop['Kabupaten'] ?? $kop['Kota'] ?? '-') . ', ' . e($kop['Kecamatan'] ?? '-') . '</td>
                <td class="text-center fw-bold text-primary">' . number_format((int)$jumlahEntitas) . ' orang</td>
                <td class="text-center"><span class="badge bg-success">' . e($kop['StatusKoperasi'] ?? $kop['Status Koperasi'] ?? 'Aktif') . '</span></td>
                <td><a href="'. route('admin.koperasi.detail', Crypt::encryptString($kop['NIK'])) . ' ">Detail</a></td>

            </tr>';
            }
        }

        return response()->json([
            'title' => $title,
            'html' => $html
        ]);
    }
    // public function getDemografiDetail(Request $request)
    // {
    //     $type = $request->input('type');   // 'Anggota', 'Karyawan', 'Manajer'
    //     $gender = $request->input('gender'); // 'Pria' atau 'Wanita'

    //     $result = Cache::store('file')->get('ods_full_data_dashboard');

    //     if (!$result || !isset($result['data'])) {
    //         return response()->json(['html' => '<tr><td colspan="6" class="text-center text-danger">Gagal memuat cache data. </td></tr>']);
    //     }

    //     $collection = collect($result['data']);
    //     // dd($collection);

    //     // Tentukan padanan nama properti/key pada API ODS Anda
    //     // Menggunakan fallback jika terdapat perbedaan spasi atau format camelCase
    //     $apiKeyMap = [
    //         'Anggota'  => ['Pria' => 'jumlahAnggotaPria', 'Wanita' => 'jumlahAnggotaWanita'],
    //         'Karyawan' => ['Pria' => 'jumlahKaryawanPria', 'Wanita' => 'jumlahKaryawanWanita'],
    //         'Manajer'  => ['Pria' => 'jumlahManajerPria', 'Wanita' => 'jumlahManajerWanita'],
    //     ];

    //     $targetKey = $apiKeyMap[$type][$gender] ?? null;

    //     // Filter koperasi yang memiliki entitas terpilih > 0
    //     $filtered = $collection->filter(function ($item) use ($targetKey) {
    //         if (!$targetKey) return false;

    //         // Cek variasi key (bisa dengan spasi seperti hasil rekap sebelumnya atau tanpa spasi)
    //         $valSpace = str_replace('jumlah', 'jumlah ', $targetKey);
    //         $count = $item[$targetKey] ?? $item[$valSpace] ?? 0;

    //         return (int)$count > 0;
    //     });

    //     // dd($filtered);

    //     $title = "Daftar Koperasi yang Memiliki " . $type . " " . $gender;

    //     // Render baris tabel HTML
    //     $html = '';
    //     if ($filtered->isEmpty()) {
    //         $html .= '<tr><td colspan="6" class="text-center text-muted">Tidak ada data koperasi ditemukan dengan kriteria tersebut.</td></tr>';
    //     } else {
    //         $no = 1;
    //         foreach ($filtered as $kop) {
    //             // Ambil nilai display jumlah entitas yang relevan
    //             $displayKey = $apiKeyMap[$type][$gender];
    //             $displayKeySpace = str_replace('jumlah', 'jumlah ', $displayKey);
    //             $jumlahEntitas = (int)($kop[$displayKey] ?? $kop[$displayKeySpace] ?? 0);

    //             $html .= '<tr>
    //             <td class="text-center">' . $no++ . '</td>
    //             <td>' . e($kop['NIK'] ?? '-') . '</td>
    //             <td><strong>' . e($kop['Nama_Koperasi'] ?? '-') . '</strong></td>
    //             <td>' . e($kop['Desa'] ?? '-') . ', ' . e($kop['Kecamatan'] ?? '-') . '</td>
    //             <td class="text-center fw-bold text-primary">' . number_format($jumlahEntitas) . ' orang</td>
    //             <td class="text-center"><span class="badge bg-success">' . e($kop['StatusKoperasi'] ?? 'Aktif') . '</span></td>
    //         </tr>';
    //         }
    //     }

    //     return response()->json([
    //         'title' => $title,
    //         'html' => $html
    //     ]);
    // }



    public function getKarakteristikDetail(Request $request)
    {
        $type = $request->input('type');   // 'Jenis' atau 'Bentuk'
        $value = $request->input('value'); // Contoh: 'Simpan Pinjam' atau 'Kabupaten/Kota'
        $datasetLabel = $request->input('datasetLabel'); // Khusus bentuk: 'Primer' atau 'Sekunder'

        $result = Cache::store('file')->get('ods_full_data_dashboard');

        if (!$result || !isset($result['data'])) {
            return response()->json(['html' => '<tr><td colspan="5" class="text-center text-danger">Gagal memuat cache data.</td></tr>']);
        }

        $collection = collect($result['data']);
        $title = '';

        if ($type === 'Jenis') {
            $title = "Daftar Koperasi dengan Jenis: $value";
            $filtered = $collection->filter(function ($item) use ($value) {
                return trim($item['Jenis_Koperasi'] ?? 'Lainnya') === $value;
            });
        } elseif ($type === 'Bentuk') {
            // Gabungkan dataset label (Primer/Sekunder) dengan label sumbu X (Kabupaten/Kota, Provinsi, Nasional)
            // Menyesuaikan dengan isian asli API: "Primer Kabupaten/Kota", "Sekunder Provinsi", dll.
            $targetBentuk = $datasetLabel . ' ' . $value;
            $title = "Daftar Koperasi dengan Bentuk: $targetBentuk";

            $filtered = $collection->filter(function ($item) use ($targetBentuk) {
                return trim($item['Bentuk_Koperasi'] ?? 'Lainnya') === $targetBentuk;
            });
        } else {
            $filtered = collect();
        }

        // Render baris tabel HTML
        $html = '';
        if ($filtered->isEmpty()) {
            $html .= '<tr><td colspan="5" class="text-center text-muted">Tidak ada data koperasi ditemukan.</td></tr>';
        } else {
            $no = 1;
            foreach ($filtered as $kop) {
                $html .= '<tr>
                <td class="text-center">' . $no++ . '</td>
                <td>' . e($kop['NIK'] ?? '-') . '</td>
                <td><strong>' . e($kop['Nama_Koperasi'] ?? '-') . '</strong></td>
                <td>' . e($kop['Desa'] ?? '-') . ', ' . e($kop['Kecamatan'] ?? '-') . '</td>
                <td class="text-center"><span class="badge bg-success">' . e($kop['StatusKoperasi'] ?? $kop['Status Koperasi'] ?? 'Aktif') . '</span></td>
                <td><a href="'. route('admin.koperasi.detail', Crypt::encryptString($kop['NIK'])) . ' ">Detail</a></td>

            </tr>';
            }
        }

        return response()->json([
            'title' => $title,
            'html' => $html
        ]);
    }

    public function getKukDetail(Request $request)
    {
        $kukLevel = $request->input('kuk'); // '1', '2', '3', atau '4'

        $result = Cache::store('file')->get('ods_full_data_dashboard');

        if (!$result || !isset($result['data'])) {
            return response()->json(['html' => '<tr><td colspan="5" class="text-center text-danger">Gagal memuat cache data.</td></tr>']);
        }

        $collection = collect($result['data']);

        // Filter koperasi berdasarkan tingkatan KUK yang diklik
        $filtered = $collection->filter(function ($item) use ($kukLevel) {
            // Menyamakan nilai KUK dalam bentuk string/integer dan mengantisipasi spasi kosong
            return trim($item['KUK'] ?? '') == trim($kukLevel);
        });

        $title = "Daftar Koperasi Klasifikasi Usaha Koperasi (KUK) Tingkat " . $kukLevel;

        // Render baris tabel HTML
        $html = '';
        if ($filtered->isEmpty()) {
            $html .= '<tr><td colspan="5" class="text-center text-muted">Tidak ada data koperasi ditemukan pada tingkat KUK ini.</td></tr>';
        } else {
            $no = 1;
            foreach ($filtered as $kop) {
                $html .= '<tr>
                <td class="text-center">' . $no++ . '</td>
                <td>' . e($kop['NIK'] ?? '-') . '</td>
                <td><strong>' . e($kop['Nama_Koperasi'] ?? '-') . '</strong></td>
                <td>' . e($kop['Desa'] ?? $kop['Kelurahan'] ?? '-') . ', ' . e($kop['Kecamatan'] ?? '-') . '</td>
                <td class="text-center"><span class="badge bg-success">' . e($kop['StatusKoperasi'] ?? $kop['Status Koperasi'] ?? 'Aktif') . '</span></td>
                <td><a href="'. route('admin.koperasi.detail', Crypt::encryptString($kop['NIK'])) . ' ">Detail</a></td>

            </tr>';
            }
        }

        return response()->json([
            'title' => $title,
            'html' => $html
        ]);
    }


    public function getGradeDetail(Request $request)
{
    $gradeCode = $request->input('grade'); // Contoh: 'A', 'B', 'C1', 'C2', 'C3'

    $result = Cache::store('file')->get('ods_full_data_dashboard');

    if (!$result || !isset($result['data'])) {
        return response()->json(['html' => '<tr><td colspan="5" class="text-center text-danger">Gagal memuat cache data.</td></tr>']);
    }

    $collection = collect($result['data']);

    // Filter koperasi dengan membandingkan nilai properti 'Grade' (case-insensitive)
    // Digabungkan dengan fallback 'Grade_Sertifikat' jika ada variasi nama properti di API Anda
    $filtered = $collection->filter(function ($item) use ($gradeCode) {
        $currentGrade = $item['Grade'] ?? $item['Grade_Sertifikat'] ?? '';
        return strtoupper(trim($currentGrade)) === strtoupper(trim($gradeCode));
    });

    $title = "Daftar Koperasi - Tingkat Klasifikasi Grade " . strtoupper($gradeCode);

    // Render baris tabel HTML respon AJAX
    $html = '';
    if ($filtered->isEmpty()) {
        $html .= '<tr><td colspan="5" class="text-center text-muted">Tidak ada data koperasi ditemukan untuk kategori Grade ini.</td></tr>';
    } else {
        $no = 1;
        foreach ($filtered as $kop) {
            $html .= '<tr>
                <td class="text-center">' . $no++ . '</td>
                <td>' . e($kop['NIK'] ?? '-') . '</td>
                <td><strong>' . e($kop['Nama_Koperasi'] ?? '-') . '</strong></td>
                <td>' . e($kop['Kabupaten'] ?? $kop['Kota'] ?? $kop['Desa'] ?? '-') . ', ' . e($kop['Kecamatan'] ?? '-') . '</td>
                <td class="text-center"><span class="badge bg-success">' . e($kop['StatusKoperasi'] ?? $kop['Status Koperasi'] ?? 'Aktif') . '</span></td>
                <td><a href="'. route('admin.koperasi.detail', Crypt::encryptString($kop['NIK'])) . ' ">Detail</a></td>
            </tr>';
        }
    }

    return response()->json([
        'title' => $title,
        'html' => $html
    ]);
}
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


}
