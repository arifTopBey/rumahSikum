<?php

namespace App\Repository;

use App\Interface\UmkmInterface;
use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Cache;

class UmkmRepositoryInterface implements UmkmInterface
{


    protected $baseUrl;
    protected $sidtKey;

    public function __construct()
    {
        $this->baseUrl = config('services.sidt.url', env('SIDT_BASE_URL'));
        $this->sidtKey = config('services.sidt.key', env('SIDT_KEY'));
    }

    // method dengan login akun auth api
    // public function getUmkmData($limit = 10, $page = 1)
    // {
    //     $token = session('api_token');

    //     $response = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'sidt-key' => $this->sidtKey, // 1mRC99H3IvQ6x03w
    //     ])
    //         ->withToken($token)
    //         ->get($this->baseUrl . 'umkm-kab-tangerang/getData', [
    //             'limit' => $limit,
    //             'page'  => $page,
    //             'block' => 1
    //         ]);

    //     if ($response->successful()) {
    //         return $response->json();
    //     }

    //     return null;
    // }


    public function getToken()
    {

        $response = Http::asForm()->post($this->baseUrl . 'token', [
            'username' => config('services.sidt.username'),
            'password' => config('services.sidt.password'),
        ]);

        if ($response->failed()) {
            return null;
        }


        // });

        $result = $response->json();
        // dd($data);


        return $result['data']['access_token'] ?? null;
    }

    public function getData(int $limit, int $page, int $block)
    {

        $token = $this->getToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'sidt-key' => $this->sidtKey,
        ])
            ->get($this->baseUrl . 'umkm-kab-tangerang/getData', [
                'limit' => $limit,
                'page' => $page,
                'block' => $block,
            ]);

        return $response->json();
    }

    public function getById(int $id)
    {
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->withHeaders([
                'Accept' => 'application/json',
                'sidt-key' => $this->sidtKey,
            ])
            ->get($this->baseUrl . 'umkm-kab-tangerang/getData', [
                'search' => $id,
                'limit' => 1,
                'block' => 11,
            ]);

        $result = $response->json();
        dd($result);

        // Kita cari di dalam array data yang balik, apakah ada yang ID-nya cocok
        return collect($result['data'] ?? [])->firstWhere('id_badan_usaha', $id);
    }

        public function getFullDetail(int $id)
        {
            $token = $this->getToken();
            $allData = [];

            // Tentukan blok mana saja yang kritikal untuk aplikasi Anda
            // Misalnya blok 1 (Identitas), 3 (Pengusaha), 4 (Izin), dan 8 (Tenaga Kerja)
            $neededBlocks = [1, 2, 3, 4, 7,  8, 9, 11];

            foreach ($neededBlocks as $blockId) {
                $response = Http::withToken($token)
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'sidt-key' => $this->sidtKey,
                    ])
                    ->get($this->baseUrl . 'umkm-kab-tangerang/getData', [
                        'search' => $id,
                        'limit' => 1,
                        'block' => $blockId,
                    ]);

                if ($response->successful()) {
                    $res = $response->json();
                    // Ambil index ke-0 karena limit=1
                    $blockData = $res['data'][0] ?? [];


                    // $allData = array_merge($allData, $blockData);
                    $allData = $allData + $blockData;
                }
            }

            return (object) $allData;
        }

        public function getKeuangan()
        {
            $token = $this->getToken();


            $response = Http::withToken($token)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'sidt-key' => $this->sidtKey,
                ])
                ->get($this->baseUrl . 'umkm-kab-tangerang/getData', [
                    'limit' => 100, // Sesuaikan limit untuk mendapatkan banyak data
                    'block' => 11,
                ]);

            if ($response->successful()) {
                $allData = collect($response->json()['data'] ?? []);

                // Berdasarkan data SIDT, biasanya Skala Usaha ada di index tertentu
                // Asumsi: Skala Usaha ada di index '6' atau '12' (Mikro=1, Kecil=2, Menengah=3)
                // Kita petakan dan jumlahkan

                return (object) [
                    'mikro' => [
                        'total_modal' => $allData->where('6', 1)->sum('1102a'),
                        'total_omzet' => $allData->where('6', 1)->sum('1103a'),
                        'jumlah_unit' => $allData->where('6', 1)->count(),
                    ],
                    'kecil' => [
                        'total_modal' => $allData->where('6', 2)->sum('1102a'),
                        'total_omzet' => $allData->where('6', 2)->sum('1103a'),
                        'jumlah_unit' => $allData->where('6', 2)->count(),
                    ],
                    'menengah' => [
                        'total_modal' => $allData->where('6', 3)->sum('1102a'),
                        'total_omzet' => $allData->where('6', 3)->sum('1103a'),
                        'jumlah_unit' => $allData->where('6', 3)->count(),
                    ],
                    'total_keseluruhan_omzet' => $allData->sum('1103a')
                ];
            }
        }

        public function getRekapUmkm()
    {
        $token = $this->getToken();

        // Ambil data dalam jumlah banyak untuk dihitung
        $response = Http::withToken($token)
            ->withHeaders([
                'Accept' => 'application/json',
                'sidt-key' => $this->sidtKey,
            ])
            ->get($this->baseUrl . 'umkm-kab-tangerang/getData', [
                'limit' => 500, // Sesuaikan limit sesuai jumlah data yang ingin direkap
                'block' => 2,   // Blok 2 biasanya berisi Karakteristik/Skala Usaha
            ]);

        if ($response->successful()) {
            $data = collect($response->json()['data'] ?? []);

            // Berdasarkan dump data kamu sebelumnya, skala usaha ada di index '6'
            // 1 = Mikro, 2 = Kecil, 3 = Menengah (asumsi standar SIDT)
            $rekap = $data->countBy('6');

            return (object) [
                'total_umkm' => $data->count(),
                'mikro'      => $rekap->get(1, 0), // ambil value dari key 1, default 0
                'kecil'      => $rekap->get(2, 0),
                'menengah'   => $rekap->get(3, 0),
            ];
        }

        return null;
        }


        public function mapToDatabase(array $allData){

                // 1. Simpan/Update Tabel Utama
            $umkm = \App\Models\Umkm::updateOrCreate(
                ['id_badan_usaha' => $allData['id_badan_usaha']],
                [
                    // Blok 1 & 2
                    'nama_usaha'     => $allData['106'] ?? null,
                    'alamat_usaha'   => $allData['109a'] ?? null,
                    'no_hp_usaha'    => $allData['109e'] ?? null,
                    'deskripsi_usaha'=> $allData['201'] ?? null,
                    'komoditas'      => $allData['202a'] ?? null,
                    'nib'            => $allData['204'] ?? null,
                    'tahun_mulai'    => $allData['207b'] ?? null,

                    // Blok 3
                    'nama_pemilik'   => $allData['301'] ?? null,
                    'nik_pemilik'    => $allData['305'] ?? null,
                    'no_hp_pemilik'  => $allData['309b'] ?? null,

                    // Blok 4 (Logika: jika nilainya 1 berarti 'Ya', jika 2 'Tidak')
                    'izin_pirt'      => ($allData['401c'] ?? 2) == 1,
                    'izin_halal'     => ($allData['401j'] ?? 2) == 1,

                    // Blok 6, 7, 8, 11
                    'modal_sendiri'  => (float)($allData['1102a'] ?? 0),
                    'omzet_tahunan'  => (float)($allData['1103a'] ?? 0),
                    'pengeluaran_tahunan' => (float)($allData['1103b'] ?? 0),
                    'nilai_aset'     => (float)($allData['702a'] ?? 0),
                    'jumlah_tenaga_kerja' => (int)($allData['801i'] ?? 0),

                    // Blok 12: Simpan semua key yang diawali '12' ke JSON
                    'data_pembinaan' => collect($allData)->filter(fn($v, $k) => str_starts_with($k, '12'))->toArray(),
                ]
            );

            // 2. Simpan/Update Tabel Mitra (Blok 10)
            if (!empty($allData['1001']) && is_array($allData['1001'])) {
                // Hapus mitra lama agar tidak duplikat saat sinkronisasi ulang
                $umkm->mitras()->delete();

                foreach ($allData['1001'] as $mitra) {
                    $umkm->mitras()->create([
                        'nama_mitra'   => $mitra['nama_mitra'],
                        'alamat_mitra' => $mitra['alamat'],
                        'hp_mitra'     => $mitra['hp'],
                    ]);
                }
            }

            return $umkm;
        }

}
