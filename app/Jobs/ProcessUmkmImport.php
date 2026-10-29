<?php

// namespace App\Jobs;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Http;
// use App\Models\{Umkm, UmkmBlock2, UmkmBlock3, UmkmBlock4, UmkmBlock5, UmkmBlock6, UmkmBlock7, UmkmBlock8, UmkmBlock9, UmkmBlock10, UmkmBlock11, UmkmBlock12};
// use Illuminate\Support\Facades\Log;

// class ProcessUmkmImport implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
//     /**
//      * Create a new job instance.
//      */ protected $idUsaha;
//     protected $token;
//     protected $baseUrl;

//     public function __construct($idUsaha, $token, $baseUrl)
//     {
//         $this->idUsaha = $idUsaha;
//         $this->token = $token;
//         $this->baseUrl = $baseUrl;
//     }

//     /**
//      * Execute the job.
//      */
//     public function handle(): void
//     {
//         // $id = $this->idUsaha;

//         // for ($b = 1; $b <= 12; $b++) {
//         //     // Menggunakan variabel $this->token dan $this->baseUrl
//         //     $response = Http::withToken($this->token)
//         //         ->get("", [
//         //             'id_badan_usaha' => $id,
//         //             'block' => $b
//         //         ]);

//         //     if ($response->successful()) {
//         //         $data = $response->json()['data'][0] ?? null;
//         //         if ($data) {
//         //             $this->saveToDatabase($b, $id, $data);
//         //         }
//         //     }
//         // }

//         try {
//             $id = $this->idUsaha;
//             // Kode loop API Anda...

//             Log::info("Memproses UMKM ID: " . $this->idUsaha);

//             for ($b = 1; $b <= 12; $b++) {
//                 // ... kode request HTTP ...
//                 $response = Http::withToken($this->token)
//                     ->get("", [
//                         // 'id_badan_usaha' => $id,
//                         'block' => 1
//                     ]);
//                 if ($response->successful()) {
//                     $data = $response->json()['data'][0] ?? null;
//                     if ($data) {
//                         $this->saveToDatabase($b, $id, $data);
//                     }
//                 }
//             }
//         } catch (\Exception $e) {
//             // Ini akan mencatat error sebenarnya ke storage/logs/laravel.log
//             Log::error("Gagal proses ID {$this->idUsaha}: " . $e->getMessage());
//             throw $e;
//         }
//     }

//     protected function saveToDatabase($block, $id, $data)
//     {

//         // $idDariRespon = $data['id_badan_usaha'] ?? $data['id_data_badan_usaha'] ?? $id;
//         $targetId = $id;

//         switch ($block) {
//             case 1:

//                 // Umkm::create([
//                 //     'id_badan_usaha' => $idDariRespon,
//                 //     'nama_usaha' => $data['106'],
//                 //     'kecamatan'  => $data['104'],
//                 //     'provinsi'   => $data['102'],
//                 //     'kabupaten'  => $data['103'],
//                 //     'kelurahan'  => $data['105'],
//                 //     'tempat_usaha' => $data['108'],
//                 //     'alamat'     => $data['109a'],
//                 //     'telepon'    => $data['109e'],
//                 // ]);

//                 Umkm::updateOrCreate(['id_badan_usaha' => $targetId], [
//                     'nama_usaha' => $data['106'],
//                     'kecamatan'  => $data['104'],
//                     'provinsi'   => $data['102'],
//                     'kabupaten'  => $data['103'],
//                     'kelurahan'  => $data['105'],
//                     'tempat_usaha' => $data['108'],
//                     'alamat'     => $data['109a'],
//                     'telepon'    => $data['109e'],
//                 ]);
//                 break;
//             // case 2:

//             //     UmkmBlock2::updateOrCreate(['id_badan_usaha' => $id], [

//             //         'kegiatan_utama' => $data['201'],
//             //         'produk_utama' => $data['202a'],
//             //         'kategori_kbli' => $data['202b'],
//             //         'kode_kbli' => $data['202c'],
//             //         'status_badan_usaha' => $data['203'],
//             //         'nib' => $data['204'],
//             //         'npwp' => $data['206'],
//             //         'bulan_mulai' => $data['207a'],
//             //         'tahun_mulai' => $data['207b'],
//             //     ]);
//             // break;
//             // case 3:
//             //     UmkmBlock3::updateOrCreate(['id_badan_usaha' => $id], [
//             //         'nama_pengusaha' => $data['301'],
//             //         'status_pengusaha' => $data['304'],
//             //         'nik_pengusaha' => $data['305'],
//             //         'provinsi_pengusaha' => $data['308a'],
//             //         'kabupaten_kota_pengusaha' => $data['308b'],
//             //         'kecamatan_pengusaha' => $data['308c'],
//             //         'kelurahan_pengusaha' => $data['308d'],
//             //         'wa_pengusaha' => $data['309b'],

//             //     ]);
//             // break;
//             // case 4:
//             //     UmkmBlock4::updateOrCreate(['id_badan_usaha' => $id], [
//             //         'izin_pirt' => $data['401b'],
//             //         'izin_bpom' => $data['401c'],
//             //         'izin_tdp' => $data['401j'],
//             //         'sertifikat_halal' => $data['402b'],
//             //         // Sesuaikan dengan nama kolom yang Anda buat
//             //     ]);
//             //     break;
//             // case 5:
//             //     UmkmBlock5::updateOrCreate(['id_badan_usaha' => $idDariRespon], [
//             //         'tanggal_mulai' => $data['1405a'],
//             //         'tanggal_selesai' => $data['1405b'],
//             //     ]);
//             //     break;
//             // case 6:
//             //     UmkmBlock6::updateOrCreate(['id_badan_usaha' => $id], [
//             //         'nilai_bahan_baku' => $data['601d'],
//             //         'usaha_mikro' => $data['602a'],
//             //         'usaha_kecil' => $data['602b'],
//             //         'usaha_menengah' => $data['602c'],
//             //         'usaha_besar' => $data['602d'],
//             //         'koperasi' => $data['602e'],
//             //     ]);
//             //     break;
//             // case 7:
//             //      // Var 701a: Sekarang menggunakan JSON karena responnya Array [ {nama_produk, ...} ]
//             //     UmkmBlock7::updateOrCreate(['id_badan_usaha' => $id], [
//             //         'rincian_produk' => $data['701a'], // Otomatis jadi JSON 
//             //         'nilai_penjualan_setahun' => $data['702a'],
//             //         'nilai_pembelian_setahun' => $data['702b'],
//             //         'pasar_rumah_tangga' => $data['704a'],
//             //         'pasar_pemerintah' => $data['704f'],
//             //         'is_medsos' => $data['707a'],
//             //         'is_marketplace' => $data['707b'],
//             //         'is_ojek_online' => $data['707d'],
//             //         'is_messaging_wa' => $data['707f'],
//             //         'is_digital_lainnya' => $data['707g'],
//             //         // Sesuaikan nama kolom lainnya
//             //     ]);
//             //     break;

//             // case 8:
//             //     UmkmBlock8::updateOrCreate(['id_badan_usaha' => $idDariRespon], [
//             //         'total_naker' => $data['801i'],
//             //         'total_upah' => $data['803i'],
//             //         // Sesuaikan nama kolom lainnya
//             //     ]);
//             //     break;
//                 // case 9:
//                 //     UmkmBlock9::updateOrCreate(['id_badan_usaha' => $id], [
//                 //         'is_manual' => $data['901a'],
//                 //         'is_mekanik' => $data['901b'],
//                 //         'is_elektronik' => $data['901c'],
//                 //         'is_digital' => $data['901d'],
//                 //         'is_ai' => $data['901e'],
//                 //         // Sesuaikan nama kolom lainnya
//                 //     ]);
//                 //     break;
//                 // case 10:

//                 //     UmkmBlock10::updateOrCreate(['id_badan_usaha' => $id], [
//                 //         'data_mitra' => $data['1001'], // Otomatis jadi JSON karena casting di model
//                 //         // Sesuaikan nama kolom lainnya
//                 //     ]);
//                 //     break;
//                 // case 11:

//                 //     UmkmBlock11::updateOrCreate(['id_badan_usaha' => $id], [
//                 //         'ada_laporan' => $data['1101'],
//                 //         'omzet' => $data['1102a'],
//                 //         'pendapatan_ops' => $data['1102b'],
//                 //         'pendapatan_non_ops' => $data['1102c'],
//                 //         'pendapatan_lainnya_subsidi_usaha' => $data['1102d'],
//                 //         'pendapatan_lainnya_subsidi_fiskal' => $data['1102e'],
//                 //         'pph_badan_pasal' => $data['1103a'],
//                 //         'pph_final_omzet' => $data['1103b'],
//                 //         // Sesuaikan nama kolom lainnya
//                 //     ]);
//                 //     break;
//                 // case 12:

//                 //     UmkmBlock12::updateOrCreate(['id_badan_usaha' => $id], [
//                 //        'teknis_produksi' => $data['1201a'],
//                 //         'pemasaran_jaringan' => $data['1201b'],
//                 //         'pembiayaan' => $data['1202c'],
//                 //         'ekspor' => $data['1202d'],
//                 //         'digitalisasi' => $data['1202e'],
//                 //         'manajement' => $data['1202f'],
//                 //         'standarisasi' => $data['1202g'],
//                 //         'hak_kekayaan_intelektual' => $data['1202h'],
//                 //         'mitigasi_kebencanaan' => $data['1202i'],
//                 //         'usaha_sendiri' => $data['1202j'],
//                 //     ]);
//                 //     break;

//         }
//     }
// }
