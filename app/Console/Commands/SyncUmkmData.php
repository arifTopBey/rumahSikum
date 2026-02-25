<?php

namespace App\Console\Commands;

use App\Interface\UmkmInterface;
use Illuminate\Console\Command;

class SyncUmkmData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-umkm-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
   public function handle(UmkmInterface $umkmRepo)
{
    $this->info('Memulai sinkronisasi data UMKM...');

    $page = 1;
    $limit = 25000; // Ambil 50.000 data per tarikan

    do {
        $this->info("Menarik data halaman: $page");

        // 1. Ambil data list (Block 1) untuk mendapatkan daftar ID
        $response = $umkmRepo->getData($limit, $page, 1);
        $items = $response['data'] ?? [];

        foreach ($items as $item) {
            $id = $item['id_badan_usaha'];
            $this->line("Memproses UMKM ID: $id");

            // 2. Ambil detail lengkap 12 block untuk ID tersebut
            // Gunakan fungsi getFullDetail yang sudah kita buat sebelumnya
            $fullData = (array) $umkmRepo->getFullDetail($id);

            // 3. Masukkan ke Database menggunakan fungsi storeFullData
            $umkmRepo->mapToDatabase($fullData);
        }

        $page++;
    } while (count($items) > 0);

    $this->info('Sinkronisasi selesai seluruhnya!');
}
}
