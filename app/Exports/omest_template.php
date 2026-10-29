<?php
// namespace App\Exports;

// use App\Models\LaporanKeuangan;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithChunkReading;




// class UsahaBerdasarkanOmset implements FromCollection,WithHeadings,ShouldAutoSize, WithChunkReading
// {
//     protected $skala, $search;

//     public function __construct($skala, $search)
//     {
//         $this->skala = $skala;
//         $this->search = $search;
//     }

//     public function collection()
//     {
//         $query = LaporanKeuangan::with('identitasUsaha');

//         if ($this->skala == 'Di Bawah 2 Miliar') {
//             $query->where('omzet_usaha', '<', 2000000000);
//         } elseif ($this->skala == '2 Miliar - 15 Miliar') {
//             $query->whereBetween('omzet_usaha', [2000000000, 15000000000]);
//         } elseif ($this->skala == '15 Miliar - 50 Miliar') {
//             $query->whereBetween('omzet_usaha', [15000000001, 50000000000]);
//         }

//         if ($this->search) {
//             $query->whereHas('identitasUsaha', function ($q) {
//                 $q->where('nama_lengkap_usaha', 'like', "%{$this->search}%")
//                   ->orWhere('kecamatan', 'like', "%{$this->search}%")
//                   ->orWhere('kelurahan', 'like', "%{$this->search}%");
//             });
//         }

//         return $query->get()->map(function ($item) {

//             $usaha = $item->identitasUsaha;

//             if ($item->omzet_usaha <= 2000000000) {
//                 $skalaText = 'Usaha Mikro';
//             } elseif ($item->omzet_usaha <= 15000000000) {
//                 $skalaText = 'Usaha Kecil';
//             } else {
//                 $skalaText = 'Usaha Menengah';
//             }

//             return [
//                 'Nama Usaha' => $usaha->nama_lengkap_usaha ?? '-',
//                 'Skala Usaha' => $skalaText,
//                 'Omzet' => $item->omzet_usaha,

//                 'Provinsi' => preg_replace('/^[0-9.]+\s*/', '', $usaha->provinsi ?? ''),
//                 'Kabupaten' => preg_replace('/^[0-9.]+\s*/', '', $usaha->kabupaten ?? ''),
//                 'Kecamatan' => preg_replace('/^[0-9.]+\s*/', '', $usaha->kecamatan ?? ''),
//             ];
//         });
//     }

//      public function headings(): array
//     {
//         return [
//             'Nama Usaha',
//             'Skala Usaha',
//             'Omzet',
//             'Provinsi',
//             'Kabupaten',
//             'Kecamatan',        ];
//     }

//     public function chunkSize(): int{
//         return 1000;
//     }
// }