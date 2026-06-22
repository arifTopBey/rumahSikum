<?php

namespace App\Http\Controllers\Koperasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GrafikExportController extends Controller
{
    public function exportExcelByChart(Request $request){
        $type = $request->input('type');
    $value = $request->input('value');
    $datasetLabel = $request->input('datasetLabel');

    // 1. Ambil data dari cache lokal
    $result = Cache::store('file')->get('ods_full_data_dashboard');

    if (!$result || !isset($result['data'])) {
        return back()->with('error', 'Gagal mengekspor data, cache tidak ditemukan.');
    }

    $collection = collect($result['data']);

    // 2. Jalankan logika penyaringan data (Sama persis dengan getListByChart)
    $filtered = $collection->filter(function ($item) use ($type, $value, $datasetLabel) {
        if ($type === 'Bentuk_Koperasi') {
            $textBentuk = $item['Bentuk_Koperasi'] ?? '';
            $isPrimer = str_contains(strtoupper($textBentuk), 'PRIMER');

            if (strtoupper($datasetLabel) === 'PRIMER' && !$isPrimer) return false;
            if (strtoupper($datasetLabel) === 'SEKUNDER' && $isPrimer) return false;

            if ($value === 'Primer Provinsi') return str_contains(strtoupper($textBentuk), 'PROVINSI');
            if ($value === 'Sekunder Nasional') return str_contains(strtoupper($textBentuk), 'NASIONAL');
            if ($value === 'Sekunder Kabupaten/Kota') {
                return (str_contains(strtoupper($textBentuk), 'KABUPATEN') || str_contains(strtoupper($textBentuk), 'KOTA'));
            }
            return false;
        }

        if ($type === 'Pola_Pengelolaan') {
            $pola = strtoupper($item['Pola_Pengelolaan'] ?? '');
            if ($value === 'Syariah') return str_contains($pola, 'SYARIAH');
            return ($pola === 'KONVENSIONAL' || empty($pola)) && $value === 'Konvensional';
        }

        return strtoupper(trim($item[$type] ?? '')) === strtoupper(trim($value));
    });

    // 3. Proses Pembuatan File Excel menggunakan PhpSpreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul & Header Informasi Atas
    $sheet->setCellValue('A1', 'DATA REKAPITULASI DETAIL KOPERASI');
    $sheet->setCellValue('A2', 'Kategori Grafik: ' . $type);
    $sheet->setCellValue('A3', 'Nilai Filter: ' . $value . ($datasetLabel ? ' (' . $datasetLabel . ')' : ''));
    $sheet->setCellValue('A4', 'Tanggal Unduh: ' . date('Y-m-d H:i:s'));

    // Label Header Tabel
    $sheet->setCellValue('A6', 'No');
    $sheet->setCellValue('B6', 'NIK');
    $sheet->setCellValue('C6', 'Nama Koperasi');
    $sheet->setCellValue('D6', 'Desa');
    $sheet->setCellValue('E6', 'Kecamatan');
    $sheet->setCellValue('F6', 'Status');

    // Styling Header Tabel (Bold)
    $sheet->getStyle('A6:F6')->getFont()->setBold(true);

    // Isi Baris Data Koperasi
    $rowNumber = 7;
    $no = 1;
    foreach ($filtered as $kop) {
        $sheet->setCellValue('A' . $rowNumber, $no++);
        // Set NIK sebagai string agar angka nol di depan tidak hilang
        $sheet->setCellValueExplicit('B' . $rowNumber, $kop['NIK'] ?? '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('C' . $rowNumber, $kop['Nama_Koperasi'] ?? '-');
        $sheet->setCellValue('D' . $rowNumber, $kop['Desa'] ?? '-');
        $sheet->setCellValue('E' . $rowNumber, $kop['Kecamatan'] ?? '-');
        $sheet->setCellValue('F' . $rowNumber, $kop['StatusKoperasi'] ?? 'Aktif');
        $rowNumber++;
    }

    // Auto-size kolom agar lebar rapi menyesuaikan teks
    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // 4. Stream output langsung download ke browser tanpa simpan di server
    $filename = "Export_Koperasi_" . str_replace(' ', '_', $value) . "_" . date('Ymd_His') . ".xlsx";
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
    }

    public function exportExcelPendirian(Request $request){
        $type = $request->input('type');
    $year = $request->input('year');
    $value = $request->input('value');

    // 1. Ambil data dari cache
    $result = Cache::store('file')->get('ods_full_data_dashboard');

    if (!$result || !isset($result['data'])) {
        return back()->with('error', 'Gagal mengekspor data, cache tidak ditemukan.');
    }

    $collection = collect($result['data']);
    $title = '';

    // 2. Jalankan logika penyaringan data yang sama persis
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

    // 3. Proses Pembuatan Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul & Header Laporan Atas
    $sheet->setCellValue('A1', 'LAPORAN REKAPITULASI DATA DETIL KOPERASI');
    $sheet->setCellValue('A2', 'Kategori Analisis: ' . $type);
    $sheet->setCellValue('A3', 'Keterangan Filter: ' . $title);
    $sheet->setCellValue('A4', 'Waktu Unduh: ' . date('Y-m-d H:i:s'));

    // Label Header Kolom Tabel
    $sheet->setCellValue('A6', 'No');
    $sheet->setCellValue('B6', 'NIK');
    $sheet->setCellValue('C6', 'Nama Koperasi');
    $sheet->setCellValue('D6', 'Desa / Kelurahan');
    $sheet->setCellValue('E6', 'Kecamatan');
    $sheet->setCellValue('F6', 'Status Koperasi');

    // Tebalkan teks header
    $sheet->getStyle('A6:F6')->getFont()->setBold(true);

    // Iterasi baris data
    $rowNumber = 7;
    $no = 1;
    foreach ($filtered as $kop) {
        $sheet->setCellValue('A' . $rowNumber, $no++);
        // Jaga agar tipe data NIK tetap String agar angka 0 di depan tidak lenyap
        $sheet->setCellValueExplicit('B' . $rowNumber, $kop['NIK'] ?? '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('C' . $rowNumber, $kop['Nama_Koperasi'] ?? '-');
        $sheet->setCellValue('D' . $rowNumber, $kop['Desa'] ?? '-');
        $sheet->setCellValue('E' . $rowNumber, $kop['Kecamatan'] ?? '-');
        $sheet->setCellValue('F' . $rowNumber, $kop['StatusKoperasi'] ?? 'Aktif');
        $rowNumber++;
    }

    // Mengatur Auto-width kolom agar pas dengan panjang konten data
    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // 4. Output Stream menuju Browser untuk otomatis download
    $filename = "Laporan_Grafik_" . str_replace(' ', '_', $type) . "_" . date('Ymd_His') . ".xlsx";
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
    }

    public function exportExcelKarakteristik(Request $request)
{
    $type = $request->input('type');
    $value = $request->input('value');
    $datasetLabel = $request->input('datasetLabel');

    // 1. Ambil data dari cache lokal
    $result = Cache::store('file')->get('ods_full_data_dashboard');

    if (!$result || !isset($result['data'])) {
        return back()->with('error', 'Gagal mengekspor data, cache tidak ditemukan.');
    }

    $collection = collect($result['data']);
    $title = '';

    // 2. Jalankan logika penyaringan data (Sama persis dengan getKarakteristikDetail)
    if ($type === 'Jenis') {
        $title = "Daftar Koperasi dengan Jenis: $value";
        $filtered = $collection->filter(function ($item) use ($value) {
            return trim($item['Jenis_Koperasi'] ?? 'Lainnya') === $value;
        });
    } elseif ($type === 'Bentuk') {
        $targetBentuk = $datasetLabel . ' ' . $value;
        $title = "Daftar Koperasi dengan Bentuk: $targetBentuk";

        $filtered = $collection->filter(function ($item) use ($targetBentuk) {
            return trim($item['Bentuk_Koperasi'] ?? 'Lainnya') === $targetBentuk;
        });
    } else {
        $filtered = collect();
    }

    // 3. Pembuatan Dokumen Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul Informasi Dokumen Bagian Atas
    $sheet->setCellValue('A1', 'LAPORAN REKAPITULASI DETAIL KARAKTERISTIK KOPERASI');
    $sheet->setCellValue('A2', 'Kategori Analisis: ' . $type);
    $sheet->setCellValue('A3', 'Keterangan Filter: ' . $title);
    $sheet->setCellValue('A4', 'Waktu Cetak: ' . date('Y-m-d H:i:s'));

    // Label Header Tabel
    $sheet->setCellValue('A6', 'No');
    $sheet->setCellValue('B6', 'NIK');
    $sheet->setCellValue('C6', 'Nama Koperasi');
    $sheet->setCellValue('D6', 'Desa / Kelurahan');
    $sheet->setCellValue('E6', 'Kecamatan');
    $sheet->setCellValue('F6', 'Status Koperasi');

    // Menebalkan Font Header
    $sheet->getStyle('A6:F6')->getFont()->setBold(true);

    // Memasukkan Data Koperasi ke Dalam Baris Baris Excel
    $rowNumber = 7;
    $no = 1;
    foreach ($filtered as $kop) {
        $sheet->setCellValue('A' . $rowNumber, $no++);
        // Set NIK sebagai tipe data String agar format angka 0 di depan tidak terpotong/hilang
        $sheet->setCellValueExplicit('B' . $rowNumber, $kop['NIK'] ?? '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('C' . $rowNumber, $kop['Nama_Koperasi'] ?? '-');
        $sheet->setCellValue('D' . $rowNumber, $kop['Desa'] ?? '-');
        $sheet->setCellValue('E' . $rowNumber, $kop['Kecamatan'] ?? '-');
        $sheet->setCellValue('F' . $rowNumber, $kop['StatusKoperasi'] ?? $kop['Status Koperasi'] ?? 'Aktif');
        $rowNumber++;
    }

    // Mengatur lebar kolom otomatis agar pas dengan konten teks
    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // 4. Melakukan output stream download langsung ke browser
    $filename = "Laporan_Karakteristik_" . str_replace([' ', '/'], '_', $value) . "_" . date('Ymd_His') . ".xlsx";
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
    }

    public function exportExcelKuk(Request $request)
{
    $kukLevel = $request->input('kuk');

    // 1. Ambil data dari cache lokal
    $result = Cache::store('file')->get('ods_full_data_dashboard');

    if (!$result || !isset($result['data'])) {
        return back()->with('error', 'Gagal mengekspor data, cache tidak ditemukan.');
    }

    $collection = collect($result['data']);

    // 2. Jalankan logika penyaringan data yang sama persis dengan getKukDetail
    $filtered = $collection->filter(function ($item) use ($kukLevel) {
        return trim($item['KUK'] ?? '') == trim($kukLevel);
    });

    $title = "Daftar Koperasi Klasifikasi Usaha Koperasi (KUK) Tingkat " . $kukLevel;

    // 3. Proses Pembuatan Dokumen Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul Informasi Dokumen Bagian Atas
    $sheet->setCellValue('A1', 'LAPORAN REKAPITULASI DETAIL KUK KOPERASI');
    $sheet->setCellValue('A2', 'Kategori Analisis: Klasifikasi Usaha Koperasi (KUK)');
    $sheet->setCellValue('A3', 'Keterangan Filter: Tingkat ' . $kukLevel);
    $sheet->setCellValue('A4', 'Waktu Cetak: ' . date('Y-m-d H:i:s'));

    // Label Header Tabel
    $sheet->setCellValue('A6', 'No');
    $sheet->setCellValue('B6', 'NIK');
    $sheet->setCellValue('C6', 'Nama Koperasi');
    $sheet->setCellValue('D6', 'Desa / Kelurahan');
    $sheet->setCellValue('E6', 'Kecamatan');
    $sheet->setCellValue('F6', 'Status Koperasi');

    // Menebalkan Font Header
    $sheet->getStyle('A6:F6')->getFont()->setBold(true);

    // Memasukkan Data Koperasi ke Dalam Baris Baris Excel
    $rowNumber = 7;
    $no = 1;
    foreach ($filtered as $kop) {
        $sheet->setCellValue('A' . $rowNumber, $no++);
        // Set NIK sebagai tipe data String agar format angka 0 di depan tidak terpotong
        $sheet->setCellValueExplicit('B' . $rowNumber, $kop['NIK'] ?? '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('C' . $rowNumber, $kop['Nama_Koperasi'] ?? '-');
        $sheet->setCellValue('D' . $rowNumber, $kop['Desa'] ?? $kop['Kelurahan'] ?? '-');
        $sheet->setCellValue('E' . $rowNumber, $kop['Kecamatan'] ?? '-');
        $sheet->setCellValue('F' . $rowNumber, $kop['StatusKoperasi'] ?? $kop['Status Koperasi'] ?? 'Aktif');
        $rowNumber++;
    }

    // Mengatur lebar kolom otomatis agar pas dengan konten teks
    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // 4. Melakukan output stream download langsung ke browser
    $filename = "Laporan_KUK_Tingkat_" . $kukLevel . "_" . date('Ymd_His') . ".xlsx";
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

public function exportExcelGrade(Request $request)
{
    $gradeCode = $request->input('grade');

    // 1. Ambil data dari cache lokal
    $result = Cache::store('file')->get('ods_full_data_dashboard');

    if (!$result || !isset($result['data'])) {
        return back()->with('error', 'Gagal mengekspor data, cache tidak ditemukan.');
    }

    $collection = collect($result['data']);

    // 2. Jalankan logika penyaringan data yang sama persis dengan getGradeDetail
    $filtered = $collection->filter(function ($item) use ($gradeCode) {
        $currentGrade = $item['Grade'] ?? $item['Grade_Sertifikat'] ?? '';
        return strtoupper(trim($currentGrade)) === strtoupper(trim($gradeCode));
    });

    $title = "Daftar Koperasi - Tingkat Klasifikasi Grade " . strtoupper($gradeCode);

    // 3. Proses Pembuatan Dokumen Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul Informasi Dokumen Bagian Atas
    $sheet->setCellValue('A1', 'LAPORAN REKAPITULASI DETAIL GRADE KOPERASI');
    $sheet->setCellValue('A2', 'Kategori Analisis: Klasifikasi Tingkat Sertifikat / Grade');
    $sheet->setCellValue('A3', 'Keterangan Filter: Grade ' . strtoupper($gradeCode));
    $sheet->setCellValue('A4', 'Waktu Cetak: ' . date('Y-m-d H:i:s'));

    // Label Header Tabel
    $sheet->setCellValue('A6', 'No');
    $sheet->setCellValue('B6', 'NIK');
    $sheet->setCellValue('C6', 'Nama Koperasi');
    $sheet->setCellValue('D6', 'Wilayah / Alamat');
    $sheet->setCellValue('E6', 'Status Koperasi');

    // Menebalkan Font Header
    $sheet->getStyle('A6:E6')->getFont()->setBold(true);

    // Memasukkan Data Koperasi ke Dalam Baris Excel
    $rowNumber = 7;
    $no = 1;
    foreach ($filtered as $kop) {
        $sheet->setCellValue('A' . $rowNumber, $no++);
        // Set NIK sebagai tipe data String agar format angka 0 di depan tidak hilang
        $sheet->setCellValueExplicit('B' . $rowNumber, $kop['NIK'] ?? '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('C' . $rowNumber, $kop['Nama_Koperasi'] ?? '-');
        
        $wilayah = ($kop['Kabupaten'] ?? $kop['Kota'] ?? $kop['Desa'] ?? '-') . ', ' . ($kop['Kecamatan'] ?? '-');
        $sheet->setCellValue('D' . $rowNumber, $wilayah);
        
        $sheet->setCellValue('E' . $rowNumber, $kop['StatusKoperasi'] ?? $kop['Status Koperasi'] ?? 'Aktif');
        $rowNumber++;
    }

    // Mengatur lebar kolom otomatis agar pas dengan konten teks
    foreach (range('A', 'E') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // 4. Melakukan output stream download langsung ke browser
    $filename = "Laporan_Grade_" . strtoupper($gradeCode) . "_" . date('Ymd_His') . ".xlsx";
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}


}
