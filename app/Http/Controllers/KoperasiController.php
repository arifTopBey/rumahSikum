<?php

namespace App\Http\Controllers;

use App\Services\KoperasiCryptoService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class KoperasiController extends Controller
{
    protected $cryptoService;

    public function __construct(KoperasiCryptoService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function index(){

        return view('admin.koperasi.index');
    }

    public function show(){
        return view('admin.koperasi.detail');
    }

    public function statistikKoperasi(){

        return view('admin.koperasi.statistikKoperasi');
    }
    public function pendirianKoperasi(){

        return view('admin.koperasi.pendirian');
    }

    public function jenisKoperasi(){

        return view('admin.koperasi.jenisKoperasi');
    }

    public function kukKoperasi(){

        return view('admin.koperasi.kukKoperasi');
    }

    public function grafikKoperasi(){

        return view('admin.koperasi.grafikKoperasi');
    }

    public function gradeKoperasi(){
        return view('admin.koperasi.gradeKoperasi');
    }

    public function syncProductAndGetNikop()
    {
       
        $token = "eyJpdiI6IkF4VjUwMFByL21EOURMUnZMOVR3WHc9PSIsInZhbHVlIjoieDR4akVQNGRWWnhRVVZYZW1pcWxsRm1LSGw4NkJ6R1dkRnFDRFhobUkrVWR5YjZxMG9YY2hPbTZBZCtzV3R4aFlWSVpLQ3hUZ3RPSUhyc3kyK1BoSWhnaGtQV1YvOVNac2NqSUJkRW9yRlVicUc2eStpZFhoMVdIdlJ0d3QvVGg5Qi9Oanp3dUJIZ2J3ZFo4OUFqbWZKTnkyN2NlNEJkL1N3amJrSmVQTy80b0Q0cGN0UHJGemZ1WnQrZ3JURzltMFpmUXlpZG1leUcvayticjI4V2NMTVVyWDBHS1pkK3NOSU1CL2V5V2ZLb3V6UWl2bzBEaUQzK0N2VmtVa0x3c1FjSlVEN3lQTW50YlVJMElTZFZKMjI3dmEzenJhVXdvNTJmRCtBdE1hN2FFSVRMMG1pK3ViVjdNdHFJbWZhd2VVUVlkcFN6T2ZNZHlweHNNeXdBNEtmS3lYVHo4dU9hTHBtUnJqT0YxS2IvNllRcGRQaTFOYThQZkNEWVF5MFNkRTkzdkg0bStLdDRuZGNGNWRURVloVWZ0OGZjSm9Mc0FTM1R2VFhzVXFyUDVCUEdIaldzek44d2hCS0tlS01pdFcyUTM1cFpNYkVzdUZCTS9TQjVpYldmYjRBS0QwaU1IMmNhNEJHRWF4YnJ5K3A1SG5zU3F0TWZjTU5qWnhBcENHZjJJc2FpeUJESXZkL2p1K1gxOHJhSXJwUXpvWjF3T3RpQnFTQzNZOTBTTzVKTXN0cjJ4emd5bkdTQmVRK1RoamRZWDVXcUcvUWdwazZ0Q1BOMUgrMVZRMkcwUHRNV2tCVmo0MlFxajJmeG1FM3kxeEFaNEJEZzkzMnF6OEM5b0RaaEN6TXVwQ0ZpcWkwVkR5NEtpRmUydTJMd0N1QVIwMkhiTlk5VW91WVBNV2dpcnh4OWFreXVUV2lTOUFGbnRJYXErTDc3cjFoSEhmK01TeXJXWDVmNU1sMDk1cVhvdDU3QWxIUjJRK2dRRlVCU0RXdk9UNEZTK0srSVFTMHE2dzBEc1o4a2R3eUU5YjhUWkFtN0tRcmErTzhFSnIvb2h6MURtUzA3bStRK2tBUU1ubGMzRVVHbmVENENFM3oxbjVtNHFJSjNaT0ptbm5DZm1sbzZNZktkTWYzeWtvR0RUM0U0bXBtcWdsQU5YdXNUdFl2ZDRSckphWHFNT0piMVA0a1lnL1RxdnZ1Q3cwanlKTDhlbEdMcGJ5dWVubFpxVzd3SXp1MWR5Z2VQcmRTRnJ5RTI2YVJuNnI3WStHMXpTanlKVzlUTUE2ZlFrdFVMdmE2eitpSk1aNnoybU84WkF2Q0pudFMyQ0JjVnlqVEM2OUNkd2RlRWhYdE9SN3BZY0Q1VEhyanBHODZUeUxZeTB5dTVUei9HZGdhMTRJTVJIbTc0R1RZZmlGbERoSUhLcVdleEhRN05aRGhnMGhRemZRTlVZbGkraHBlc3hUd21PQlE4dHp3PT0iLCJtYWMiOiJmNjI0NDdjMWQwZjJkNTM3ZmUzNjcyMWIzMzc4YWQ1MzNhYzI5YzU1NjRlYjM2MGFjNTM2NTc0MWJhZGEyYzYyIiwidGFnIjoiIn0=";

        $response = Http::withToken($token)
            ->get('https://dev.api.merahputih.kop.id/api/technology-provider-member/sync-national-product');
        // $response = Http::withToken($token)
        //     ->get('https://dev.api.merahputih.kop.id/api/technology-provider-member/sync-national-product', [
        //         'search' => 'mama lemon',
        //         'page' => 1
        //     ]);

        if ($response->successful()) {
            $encryptedData = $response->json('data');

            // 3. DEKRIPSI teks acak menggunakan Service tadi
            $decryptedJson = $this->cryptoService->decryptData($encryptedData, 'json');

            
            return response()->json([
                'status' => 'success',
                'raw_data' => $decryptedJson
            ]);
        }

        return response()->json(['status' => 'error'], 400);
    }

    public function dashboardKoperasi(){
        
        return view('admin.koperasi.dashboardKoperasi');
    }

    public function daftarkanKoperasiMitra(Request $request)
    {
        // 1. Validasi input 
        $request->validate([
            'nikop' => 'required|string',
            'nama_koperasi' => 'required|string',
            'alamat' => 'required|string',
            'dokumen_kerjasama' => 'required|file|mimes:pdf|max:25600', // Maksimal 25MB sesuai dokumen
        ]);

       
        $token = "eyJpdiI6IkF4VjUwMFByL21EOURMUnZMOVR3WHc9PSIsInZhbHVlIjoieDR4akVQNGRWWnhRVVZYZW1pcWxsRm1LSGw4NkJ6R1dkRnFDRFhobUkrVWR5YjZxMG9YY2hPbTZBZCtzV3R4aFlWSVpLQ3hUZ3RPSUhyc3kyK1BoSWhnaGtQV1YvOVNac2NqSUJkRW9yRlVicUc2eStpZFhoMVdIdlJ0d3QvVGg5Qi9Oanp3dUJIZ2J3ZFo4OUFqbWZKTnkyN2NlNEJkL1N3amJrSmVQTy80b0Q0cGN0UHJGemZ1WnQrZ3JURzltMFpmUXlpZG1leUcvayticjI4V2NMTVVyWDBHS1pkK3NOSU1CL2V5V2ZLb3V6UWl2bzBEaUQzK0N2VmtVa0x3c1FjSlVEN3lQTW50YlVJMElTZFZKMjI3dmEzenJhVXdvNTJmRCtBdE1hN2FFSVRMMG1pK3ViVjdNdHFJbWZhd2VVUVlkcFN6T2ZNZHlweHNNeXdBNEtmS3lYVHo4dU9hTHBtUnJqT0YxS2IvNllRcGRQaTFOYThQZkNEWVF5MFNkRTkzdkg0bStLdDRuZGNGNWRURVloVWZ0OGZjSm9Mc0FTM1R2VFhzVXFyUDVCUEdIaldzek44d2hCS0tlS01pdFcyUTM1cFpNYkVzdUZCTS9TQjVpYldmYjRBS0QwaU1IMmNhNEJHRWF4YnJ5K3A1SG5zU3F0TWZjTU5qWnhBcENHZjJJc2FpeUJESXZkL2p1K1gxOHJhSXJwUXpvWjF3T3RpQnFTQzNZOTBTTzVKTXN0cjJ4emd5bkdTQmVRK1RoamRZWDVXcUcvUWdwazZ0Q1BOMUgrMVZRMkcwUHRNV2tCVmo0MlFxajJmeG1FM3kxeEFaNEJEZzkzMnF6OEM5b0RaaEN6TXVwQ0ZpcWkwVkR5NEtpRmUydTJMd0N1QVIwMkhiTlk5VW91WVBNV2dpcnh4OWFreXVUV2lTOUFGbnRJYXErTDc3cjFoSEhmK01TeXJXWDVmNU1sMDk1cVhvdDU3QWxIUjJRK2dRRlVCU0RXdk9UNEZTK0srSVFTMHE2dzBEc1o4a2R3eUU5YjhUWkFtN0tRcmErTzhFSnIvb2h6MURtUzA3bStRK2tBUU1ubGMzRVVHbmVENENFM3oxbjVtNHFJSjNaT0ptbm5DZm1sbzZNZktkTWYzeWtvR0RUM0U0bXBtcWdsQU5YdXNUdFl2ZDRSckphWHFNT0piMVA0a1lnL1RxdnZ1Q3cwanlKTDhlbEdMcGJ5dWVubFpxVzd3SXp1MWR5Z2VQcmRTRnJ5RTI2YVJuNnI3WStHMXpTanlKVzlUTUE2ZlFrdFVMdmE2eitpSk1aNnoybU84WkF2Q0pudFMyQ0JjVnlqVEM2OUNkd2RlRWhYdE9SN3BZY0Q1VEhyanBHODZUeUxZeTB5dTVUei9HZGdhMTRJTVJIbTc0R1RZZmlGbERoSUhLcVdleEhRN05aRGhnMGhRemZRTlVZbGkraHBlc3hUd21PQlE4dHp3PT0iLCJtYWMiOiJmNjI0NDdjMWQwZjJkNTM3ZmUzNjcyMWIzMzc4YWQ1MzNhYzI5YzU1NjRlYjM2MGFjNTM2NTc0MWJhZGEyYzYyIiwidGFnIjoiIn0=";

        $partnershipCode = 'PARTNER-' . strtoupper(uniqid());

        // 3. ENKRIPSI parameter teks menggunakan Service AES-256-CBC
        $encryptedNikop = $this->cryptoService->encryptData($request->nikop);
        $encryptedPartnershipCode = $this->cryptoService->encryptData($partnershipCode);

        $file = $request->file('dokumen_kerjasama');

        $response = Http::withToken($token)
            ->asMultipart()
            ->attach(
                'dokumen_kerjasama',               
                file_get_contents($file->path()), 
                $file->getClientOriginalName()     
            )
            ->post('https://dev.api.merahputih.kop.id/api/technology-provider-member/cooperative-provider-partnership/institution-partnership-verification', [
                'nikop' => $encryptedNikop,
                'partnership_code' => $encryptedPartnershipCode,
            ]);

        // 5. Cek Response dari Server Kemenkop
        if ($response->successful()) {
            
            // // JIKA SUKSES, Simpan data koperasi asli ke database lokal Anda
            // Koperasi::create([
            //     'nikop' => $request->nikop,
            //     'nama_koperasi' => $request->nama_koperasi,
            //     'alamat' => $request->alamat,
            //     'partnership_code' => $partnershipCode,
            //     'status' => 'Terintegrasi' // Mengubah status menjadi aktif/terintegrasi di frontend
            // ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Koperasi berhasil didaftarkan kemitraannya ke Kemenkop dan disimpan ke lokal.',
                'data_kemenkop' => $response->json()
            ], 200);
        }

        // Jika gagal dari server Kemenkop
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal verifikasi ke server Kemenkop',
            'error_detail' => $response->json()
        ], $response->status());
    }

   

    public function syncAnggota(Request $request)
{
        $token = "eyJpdiI6IkF4VjUwMFByL21EOURMUnZMOVR3WHc9PSIsInZhbHVlIjoieDR4akVQNGRWWnhRVVZYZW1pcWxsRm1LSGw4NkJ6R1dkRnFDRFhobUkrVWR5YjZxMG9YY2hPbTZBZCtzV3R4aFlWSVpLQ3hUZ3RPSUhyc3kyK1BoSWhnaGtQV1YvOVNac2NqSUJkRW9yRlVicUc2eStpZFhoMVdIdlJ0d3QvVGg5Qi9Oanp3dUJIZ2J3ZFo4OUFqbWZKTnkyN2NlNEJkL1N3amJrSmVQTy80b0Q0cGN0UHJGemZ1WnQrZ3JURzltMFpmUXlpZG1leUcvayticjI4V2NMTVVyWDBHS1pkK3NOSU1CL2V5V2ZLb3V6UWl2bzBEaUQzK0N2VmtVa0x3c1FjSlVEN3lQTW50YlVJMElTZFZKMjI3dmEzenJhVXdvNTJmRCtBdE1hN2FFSVRMMG1pK3ViVjdNdHFJbWZhd2VVUVlkcFN6T2ZNZHlweHNNeXdBNEtmS3lYVHo4dU9hTHBtUnJqT0YxS2IvNllRcGRQaTFOYThQZkNEWVF5MFNkRTkzdkg0bStLdDRuZGNGNWRURVloVWZ0OGZjSm9Mc0FTM1R2VFhzVXFyUDVCUEdIaldzek44d2hCS0tlS01pdFcyUTM1cFpNYkVzdUZCTS9TQjVpYldmYjRBS0QwaU1IMmNhNEJHRWF4YnJ5K3A1SG5zU3F0TWZjTU5qWnhBcENHZjJJc2FpeUJESXZkL2p1K1gxOHJhSXJwUXpvWjF3T3RpQnFTQzNZOTBTTzVKTXN0cjJ4emd5bkdTQmVRK1RoamRZWDVXcUcvUWdwazZ0Q1BOMUgrMVZRMkcwUHRNV2tCVmo0MlFxajJmeG1FM3kxeEFaNEJEZzkzMnF6OEM5b0RaaEN6TXVwQ0ZpcWkwVkR5NEtpRmUydTJMd0N1QVIwMkhiTlk5VW91WVBNV2dpcnh4OWFreXVUV2lTOUFGbnRJYXErTDc3cjFoSEhmK01TeXJXWDVmNU1sMDk1cVhvdDU3QWxIUjJRK2dRRlVCU0RXdk9UNEZTK0srSVFTMHE2dzBEc1o4a2R3eUU5YjhUWkFtN0tRcmErTzhFSnIvb2h6MURtUzA3bStRK2tBUU1ubGMzRVVHbmVENENFM3oxbjVtNHFJSjNaT0ptbm5DZm1sbzZNZktkTWYzeWtvR0RUM0U0bXBtcWdsQU5YdXNUdFl2ZDRSckphWHFNT0piMVA0a1lnL1RxdnZ1Q3cwanlKTDhlbEdMcGJ5dWVubFpxVzd3SXp1MWR5Z2VQcmRTRnJ5RTI2YVJuNnI3WStHMXpTanlKVzlUTUE2ZlFrdFVMdmE2eitpSk1aNnoybU84WkF2Q0pudFMyQ0JjVnlqVEM2OUNkd2RlRWhYdE9SN3BZY0Q1VEhyanBHODZUeUxZeTB5dTVUei9HZGdhMTRJTVJIbTc0R1RZZmlGbERoSUhLcVdleEhRN05aRGhnMGhRemZRTlVZbGkraHBlc3hUd21PQlE4dHp3PT0iLCJtYWMiOiJmNjI0NDdjMWQwZjJkNTM3ZmUzNjcyMWIzMzc4YWQ1MzNhYzI5YzU1NjRlYjM2MGFjNTM2NTc0MWJhZGEyYzYyIiwidGFnIjoiIn0=";

    
        // Contoh di bawah ini adalah struktur array asli yang diminta oleh Kemenkop
        $payloadAsli = [
            "nikop" => $request->nikop, // Contoh: "112345678901"
            "anggota" => [
                [
                    "nama" => "SURYADI",
                    "jenis_kelamin" => "LAKI-LAKI",
                    "nik" => "1611050102890001",
                    "phone" => "081234567890"
                ],
                [
                    "nama" => "ANISA",
                    "jenis_kelamin" => "PEREMPUAN",
                    "nik" => "1611050102890002",
                    "phone" => "089876543210"
                ]
            ]
        ];

        // 2. ENKRIPSI seluruh payload array menjadi string AES-256-CBC
        $encryptedData = $this->cryptoService->encryptData($payloadAsli);

        $response = Http::withToken($token)
            ->post('https://dev.api.merahputih.kop.id/api/technology-provider-member/sync-cooperative-member', [
                'data' => $encryptedData
            ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Sinkronisasi Anggota Sukses!']);
        }

        return response()->json(['message' => 'Gagal', 'error' => $response->json()], $response->status());
    }

   public function syncTransaksi(Request $request)
{
    $token = "eyJpdiI6IkF4VjUwMFByL21EOURMUnZMOVR3WHc9PSIsInZhbHVlIjoieDR4akVQNGRWWnhRVVZYZW1pcWxsRm1LSGw4NkJ6R1dkRnFDRFhobUkrVWR5YjZxMG9YY2hPbTZBZCtzV3R4aFlWSVpLQ3hUZ3RPSUhyc3kyK1BoSWhnaGtQV1YvOVNac2NqSUJkRW9yRlVicUc2eStpZFhoMVdIdlJ0d3QvVGg5Qi9Oanp3dUJIZ2J3ZFo4OUFqbWZKTnkyN2NlNEJkL1N3amJrSmVQTy80b0Q0cGN0UHJGemZ1WnQrZ3JURzltMFpmUXlpZG1leUcvayticjI4V2NMTVVyWDBHS1pkK3NOSU1CL2V5V2ZLb3V6UWl2bzBEaUQzK0N2VmtVa0x3c1FjSlVEN3lQTW50YlVJMElTZFZKMjI3dmEzenJhVXdvNTJmRCtBdE1hN2FFSVRMMG1pK3ViVjdNdHFJbWZhd2VVUVlkcFN6T2ZNZHlweHNNeXdBNEtmS3lYVHo4dU9hTHBtUnJqT0YxS2IvNllRcGRQaTFOYThQZkNEWVF5MFNkRTkzdkg0bStLdDRuZGNGNWRURVloVWZ0OGZjSm9Mc0FTM1R2VFhzVXFyUDVCUEdIaldzek44d2hCS0tlS01pdFcyUTM1cFpNYkVzdUZCTS9TQjVpYldmYjRBS0QwaU1IMmNhNEJHRWF4YnJ5K3A1SG5zU3F0TWZjTU5qWnhBcENHZjJJc2FpeUJESXZkL2p1K1gxOHJhSXJwUXpvWjF3T3RpQnFTQzNZOTBTTzVKTXN0cjJ4emd5bkdTQmVRK1RoamRZWDVXcUcvUWdwazZ0Q1BOMUgrMVZRMkcwUHRNV2tCVmo0MlFxajJmeG1FM3kxeEFaNEJEZzkzMnF6OEM5b0RaaEN6TXVwQ0ZpcWkwVkR5NEtpRmUydTJMd0N1QVIwMkhiTlk5VW91WVBNV2dpcnh4OWFreXVUV2lTOUFGbnRJYXErTDc3cjFoSEhmK01TeXJXWDVmNU1sMDk1cVhvdDU3QWxIUjJRK2dRRlVCU0RXdk9UNEZTK0srSVFTMHE2dzBEc1o4a2R3eUU5YjhUWkFtN0tRcmErTzhFSnIvb2h6MURtUzA3bStRK2tBUU1ubGMzRVVHbmVENENFM3oxbjVtNHFJSjNaT0ptbm5DZm1sbzZNZktkTWYzeWtvR0RUM0U0bXBtcWdsQU5YdXNUdFl2ZDRSckphWHFNT0piMVA0a1lnL1RxdnZ1Q3cwanlKTDhlbEdMcGJ5dWVubFpxVzd3SXp1MWR5Z2VQcmRTRnJ5RTI2YVJuNnI3WStHMXpTanlKVzlUTUE2ZlFrdFVMdmE2eitpSk1aNnoybU84WkF2Q0pudFMyQ0JjVnlqVEM2OUNkd2RlRWhYdE9SN3BZY0Q1VEhyanBHODZUeUxZeTB5dTVUei9HZGdhMTRJTVJIbTc0R1RZZmlGbERoSUhLcVdleEhRN05aRGhnMGhRemZRTlVZbGkraHBlc3hUd21PQlE4dHp3PT0iLCJtYWMiOiJmNjI0NDdjMWQwZjJkNTM3ZmUzNjcyMWIzMzc4YWQ1MzNhYzI5YzU1NjRlYjM2MGFjNTM2NTc0MWJhZGEyYzYyIiwidGFnIjoiIn0=";

    
    $tanggalHariIni   = date('Y-m-d'); 
    $waktuTransaksiFull = date('Y-m-d H:i:s'); 

    // Struktur payload disesuaikan dengan validasi server Kemenkop
    $payloadAsli = [
        "nikop" => $request->nikop ?? "112345678901",
        "periode_transaksi_mulai" => $tanggalHariIni,
        "periode_transaksi_akhir" => $tanggalHariIni,
        "laporan_transaksi" => [
            [
                "kode_produk_terstandarisasi" => "SKU0023",
                "nilai_transaksi_produk"      => 50000,
                "volume_transaksi_produk"     => 10,
                "internal_tp_kode_produk"     => "LOCAL-SKU0023", 
                "internal_tp_nama_produk"     => "Mama Lemon Pencuci Piring Ekstra",
                "tanggal_transaksi"           => $waktuTransaksiFull 
            ],
            [
                "kode_produk_terstandarisasi" => "SKU0078",
                "nilai_transaksi_produk"      => 45000,
                "volume_transaksi_produk"     => 5,
                "internal_tp_kode_produk"     => "LOCAL-SKU0078",
                "internal_tp_nama_produk"     => "Mama Lemon 400ml",
                "tanggal_transaksi"           => $waktuTransaksiFull 
            ]
        ]
    ];

    $encryptedData = $this->cryptoService->encryptData($payloadAsli);

    $response = Http::withToken($token)
        ->post('https://dev.api.merahputih.kop.id/api/technology-provider-member/sync-technology-provider-product-transaction', [
            'data' => $encryptedData
        ]);

    if ($response->successful()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Sinkronisasi Transaksi Sukses!',
            'data' => $response->json()
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Gagal', 
        'error' => $response->json()
    ], $response->status());
}


}
