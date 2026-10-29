<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Rap2hpoutre\FastExcel\FastExcel;
class UMKMEksportController extends Controller
{
    public function exportByGender($gender): StreamedResponse
    {
        // 1. Hilangkan batasan waktu eksekusi
        set_time_limit(0);

        $fileName = "UMKM_Gender_" . str_replace(' ', '_', $gender) . ".csv";

        return response()->streamDownload(function () use ($gender) {
            $handle = fopen('php://output', 'w');

            // Tambahkan BOM agar Excel bisa membaca UTF-8 (karakter spesial) dengan benar
            fputs($handle, "\xEF\xBB\xBF");

            // Header Kolom
            fputcsv($handle, [
                'Nama Usaha', 
                'Jenis Kelamin', 
                'Skala Usaha', 
                'Provinsi', 
                'Kabupaten', 
                'Kecamatan'
            ]);

            // 2. Query menggunakan cursor() untuk menghemat memori
            $query = LaporanKeuangan::with(['identitasUsaha', 'identitasPengusaha'])
                ->whereHas('identitasPengusaha', function ($q) use ($gender) {
                    if ($gender === 'Laki-laki') {
                        $q->where('status_pengusaha', 1);
                    } elseif ($gender === 'Perempuan') {
                        $q->where('status_pengusaha', 2);
                    } elseif ($gender === 'Tidak Diketahui') {
                        $q->where(function ($sub) {
                            $sub->whereNull('status_pengusaha')
                                ->orWhereNotIn('status_pengusaha', [1, 2]);
                        });
                    }
                })->cursor(); // Mengambil data satu per satu dari DB

            // 3. Iterasi data
            foreach ($query as $row) {
                // Logika Skala Usaha
                $skala = 'Menengah';
                $omzet = $row->omzet_usaha ?? 0;
                if ($omzet <= 2000000) {
                    $skala = 'Mikro';
                } elseif ($omzet <= 15000000) {
                    $skala = 'Kecil';
                }

                // Logika Label Gender
                $status = $row->identitasPengusaha->status_pengusaha ?? null;
                $genderText = match ((int)$status) {
                    1 => 'Laki-laki',
                    2 => 'Perempuan',
                    default => 'Tidak Diketahui',
                };

                // Tulis langsung ke output stream
                fputcsv($handle, [
                    $row->identitasUsaha->nama_lengkap_usaha ?? '-',
                    $genderText,
                    $skala,
                    $row->identitasUsaha->provinsi ?? '-',
                    $row->identitasUsaha->kabupaten ?? '-',
                    $row->identitasUsaha->kecamatan ?? '-',
                ]);

                // Paksa PHP untuk membuang buffer ke browser (mengosongkan RAM)
                flush();
            }

            fclose($handle);
        }, $fileName);
    }

//     public function exportBySkala($skala): StreamedResponse
// {
//     set_time_limit(0);
    
//     $fileName = "UMKM_Skala_" . ucfirst($skala) . ".xlsx";

//     return response()->streamDownload(function () use ($skala) {
//         $handle = fopen('php://output', 'w');
        
//         // Agar Excel bisa baca format UTF-8 (mencegah karakter aneh)
//         fputs($handle, "\xEF\xBB\xBF");

//         // Header
//         fputcsv($handle, ['Nama Usaha', 'Skala Usaha', 'Provinsi', 'Kab/Kota', 'Kecamatan', 'Omzet']);

//         // Query dengan Join & Cursor
//         $query = DB::table('usaha_laporan_keuangan')
//             ->join('identitasusaha', 'identitasusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
//             ->select(
//                 'identitasusaha.nama_lengkap_usaha',
//                 'identitasusaha.provinsi',
//                 'identitasusaha.kabupaten',
//                 'identitasusaha.kecamatan',
//                 'usaha_laporan_keuangan.omzet_usaha'
//             );

//         // Filter Skala berdasarkan Omzet
//         if ($skala == 'mikro') {
//             $query->where('usaha_laporan_keuangan.omzet_usaha', '<=', 2000000);
//         } elseif ($skala == 'kecil') {
//             $query->whereBetween('usaha_laporan_keuangan.omzet_usaha', [2000001, 15000000]);
//         } elseif ($skala == 'menengah') {
//             $query->whereBetween('usaha_laporan_keuangan.omzet_usaha', [15000001, 50000000]);
//         }

//         // Ambil data satu persatu (Cursor)
//         foreach ($query->cursor() as $row) {
            
//             // Logika Penentuan Skala (untuk kolom Skala Usaha)
//             $omzet = $row->omzet_usaha ?? 0;
//             if ($omzet <= 2000000) {
//                 $skalaLabel = 'Mikro';
//             } elseif ($omzet <= 15000000) {
//                 $skalaLabel = 'Kecil';
//             } else {
//                 $skalaLabel = 'Menengah';
//             }

//             // Bersihkan Kode Angka di Nama Wilayah (seperti di map() lama kamu)
//             $cleanProv = preg_replace('/^[0-9.]+\s+/', '', $row->provinsi ?? '');
//             $cleanKab  = preg_replace('/^[0-9.]+\s+/', '', $row->kabupaten ?? '');
//             $cleanKec  = preg_replace('/^[0-9.]+\s+/', '', $row->kecamatan ?? '');

//             fputcsv($handle, [
//                 $row->nama_lengkap_usaha ?? '-',
//                 $skalaLabel,
//                 $cleanProv,
//                 $cleanKab,
//                 $cleanKec,
//                 number_format($omzet, 0, ',', '.'),
//             ]);

//             // Buang sampah memori setiap baris ditulis
//             flush();
//         }

//         fclose($handle);
//     }, $fileName);
//     }

// public function exportBySkala($skala): StreamedResponse
// {
//     set_time_limit(0);

//     $fileName = "UMKM_Skala_" . ucfirst($skala) . ".csv";

//     return response()->streamDownload(function () use ($skala) {

//         $handle = fopen('php://output', 'w');
//         fputs($handle, "\xEF\xBB\xBF");

//         fputcsv($handle, [
//             'Nama Usaha',
//             'Skala Usaha',
//             'Provinsi',
//             'Kab/Kota',
//             'Kecamatan',
//             'Omzet'
//         ]);

//         $query = DB::table('usaha_laporan_keuangan as ulk')
//             ->join('identitasusaha as iu', 'iu.id_badan_usaha', '=', 'ulk.id_badan_usaha')
//             ->select(
//                 'iu.nama_lengkap_usaha',
//                 'iu.provinsi',
//                 'iu.kabupaten',
//                 'iu.kecamatan',
//                 'ulk.omzet_usaha',
//                 'ulk.id_badan_usaha'
//             );

//         // FILTER SKALA
//         if ($skala == 'mikro') {
//             $query->where('ulk.omzet_usaha', '<=', 2000000);
//         } elseif ($skala == 'kecil') {
//             $query->whereBetween('ulk.omzet_usaha', [2000001, 15000000]);
//         } elseif ($skala == 'menengah') {
//             $query->whereBetween('ulk.omzet_usaha', [15000001, 50000000]);
//         }

//         foreach ($query->orderBy('ulk.id_badan_usaha')->cursor() as $row) {

//             $omzet = $row->omzet_usaha ?? 0;

//             if ($omzet <= 2000000) {
//                 $skalaLabel = 'Mikro';
//             } elseif ($omzet <= 15000000) {
//                 $skalaLabel = 'Kecil';
//             } else {
//                 $skalaLabel = 'Menengah';
//             }

//             fputcsv($handle, [
//                 $row->nama_lengkap_usaha ?? '-',
//                 $skalaLabel,
//                 preg_replace('/^[0-9.]+\s+/', '', $row->provinsi ?? ''),
//                 preg_replace('/^[0-9.]+\s+/', '', $row->kabupaten ?? ''),
//                 preg_replace('/^[0-9.]+\s+/', '', $row->kecamatan ?? ''),
//                 number_format($omzet, 0, ',', '.'),
//             ]);

//             flush();
//         }

//         fclose($handle);

//     }, $fileName);
// }

public function exportBySkala($skala)
{
    set_time_limit(0);
    ini_set('memory_limit', '512M'); // Sedikit lebih besar untuk format XLSX

    $fileName = "UMKM_Skala_" . ucfirst($skala) . ".xlsx";

    // 1. Definisikan Generator untuk efisiensi memori
    $dataGenerator = function () use ($skala) {
        $query = DB::table('usaha_laporan_keuangan as ulk')
            ->join('identitasusaha as iu', 'iu.id_badan_usaha', '=', 'ulk.id_badan_usaha')
            ->select(
                'iu.nama_lengkap_usaha',
                'iu.provinsi',
                'iu.kabupaten',
                'iu.kecamatan',
                'ulk.omzet_usaha'
            );

        // Filter Skala
        if ($skala == 'mikro') {
            $query->where('ulk.omzet_usaha', '<=', 2000000);
        } elseif ($skala == 'kecil') {
            $query->whereBetween('ulk.omzet_usaha', [2000001, 15000000]);
        } elseif ($skala == 'menengah') {
            $query->whereBetween('ulk.omzet_usaha', [15000001, 50000000]);
        }

        // Ambil data satu per satu dengan cursor
        foreach ($query->orderBy('ulk.id_badan_usaha')->cursor() as $row) {
            $omzet = $row->omzet_usaha ?? 0;

            // Logika Skala
            if ($omzet <= 2000000) $skalaLabel = 'Mikro';
            elseif ($omzet <= 15000000) $skalaLabel = 'Kecil';
            else $skalaLabel = 'Menengah';

            // Yield data per baris (Sangat hemat RAM)
            yield [
                'Nama Usaha'   => $row->nama_lengkap_usaha ?? '-',
                'Skala Usaha'  => $skalaLabel,
                'Provinsi'     => preg_replace('/^[0-9.]+\s+/', '', $row->provinsi ?? ''),
                'Kab/Kota'     => preg_replace('/^[0-9.]+\s+/', '', $row->kabupaten ?? ''),
                'Kecamatan'    => preg_replace('/^[0-9.]+\s+/', '', $row->kecamatan ?? ''),
                'Omzet'        => $omzet, // Gunakan angka murni, Excel bisa format sendiri
            ];
        }
    };

    // 2. Stream langsung ke browser sebagai XLSX
    return (new FastExcel($dataGenerator()))->download($fileName);
}

public function exportByWilayah($kecamatan)
{
    // 1. Hilangkan batasan waktu eksekusi
    set_time_limit(0);
    ini_set('memory_limit', '512M'); // XLSX butuh sedikit memori lebih dibanding CSV

    $fileName = "UMKM_Wilayah_" . str_replace(' ', '_', $kecamatan) . ".xlsx";

    // 2. Gunakan Generator (yield) agar hemat RAM
    $dataGenerator = function () use ($kecamatan) {
        $query = LaporanKeuangan::with('identitasUsaha')
            ->whereHas('identitasUsaha', function ($q) use ($kecamatan) {
                $q->where('kecamatan', 'like', "%{$kecamatan}%");
            })
            ->cursor(); // Mengambil data satu per satu dari DB

        foreach ($query as $row) {
            // Logika Penentuan Skala
            $omzet = $row->omzet_usaha ?? 0;
            if ($omzet <= 2000000) {
                $skala = 'Mikro';
            } elseif ($omzet <= 15000000) {
                $skala = 'Kecil';
            } else {
                $skala = 'Menengah';
            }

            // Kembalikan data per baris (ini yang dikirim ke file Excel)
            yield [
                'Nama Usaha'  => $row->identitasUsaha->nama_lengkap_usaha ?? '-',
                'Skala Usaha' => $skala,
                'Provinsi'    => $row->identitasUsaha->provinsi ?? '-',
                'Kabupaten'   => $row->identitasUsaha->kabupaten ?? '-',
                'Kecamatan'   => $row->identitasUsaha->kecamatan ?? '-',
                'Omzet'       => $omzet,
            ];
        }
    };

    // 3. Download sebagai file .xlsx asli
    return (new FastExcel($dataGenerator()))->download($fileName);
}
}

