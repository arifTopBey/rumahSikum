<?php

namespace App\Console\Commands;

use App\Jobs\ProcessUmkmImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncAllUmkm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-all-umkm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJrdW1rbS1hcGktc2F0dWRhdGEiLCJzdWIiOnsidXNlcm5hbWUiOiJzaWR0X2thYl90YW5nZXJhbmciLCJhbGFtYXRfaWRfcHJvdiI6MTYsImFsYW1hdF9pZF9rYWJrb3QiOjI2OCwia2V0ZXJhbmdhbiI6IkludGVncmFzaSBTSURUIGRlbmdhbiBLQUIuIFRBTkdFUkFORyIsIm5hbWFfcHJvdmluc2kiOiJCQU5URU4iLCJuYW1hX2thYnVwYXRlbiI6IktBQi4gVEFOR0VSQU5HIn0sImlhdCI6MTc3MjE1NDk3MCwiZXhwIjoxNzcyMTU4NTcwfQ.WojiYPaWDeaAVNO5XN60QKQDG1YwIacM-Qzq___sr-o';
        $baseUrl = config('services.api.base_url'); // Contoh URL asli

        $this->info('Mengambil daftar ID dari API...');

    // for ($block = 1; $block <= 12; $block++) {
        $page = 1;
        while (true) {
            $response = Http::withToken($token)->get("https://satudata.umkm.go.id/api/umkm-kab-tangerang/getData", [
                'page' => $page,
                'limit' => 500,
                'block' => 1
            ]);

            $data = $response->json()['data'];
            // dd($response->json());
            if (empty($data)) break; // Berhenti jika data habis

            foreach ($data as $item) {
                $id = $item['id_badan_usaha'] ?? $item['id_data_badan_usaha'] ?? null;
                if ($id) {
                    ProcessUmkmImport::dispatch($id, $token, $baseUrl);
                }else{
                    $this->error("ID tidak ditemukan untuk item: " . json_encode($item));
                }
            }

            $this->info("Halaman $page masuk antrean...");
            $page++;
        }
     }
}
