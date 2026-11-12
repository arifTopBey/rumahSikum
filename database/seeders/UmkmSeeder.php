<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Vendor;
use App\Models\IdentitasUsaha;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hash password cukup satu kali
        $password = Hash::make('password2026');

        // Proses data per 800 record
        IdentitasUsaha::with('identitasPengusaha')
            ->chunkById(800, function ($dataUsaha) use ($password) {

                foreach ($dataUsaha as $usaha) {

                    $pengusaha = $usaha->identitasPengusaha;

                    // Lewati jika relasi tidak tersedia
                    if (!$pengusaha) {
                        continue;
                    }

                    // Lewati jika NIK kosong
                    if (empty($pengusaha->nik_pengusaha)) {
                        continue;
                    }

                    // Ambil data untuk tabel vendors
                    $vendorData = [
                        'kategori_produk_id' => 1,
                        'shop_name'          => $usaha->nama_lengkap_usaha,
                        'name'               => $pengusaha->nama_pengusaha,
                        'phone'              => $pengusaha->nomor_whatsapp,
                        'kecamatan'          => $usaha->kecamatan,
                        'kab_kota'           => $usaha->kabupaten,
                        'kelurahan'          => $usaha->kelurahan,
                        'provinsi'           => $usaha->provinsi,
                        'identity_number'    => $pengusaha->nik_pengusaha,
                        'shop_address'       => $usaha->alamat_lengkap,
                        'status_store'       => 1,
                    ];

                    // Validasi kolom wajib tabel vendors
                    $requiredFields = [
                        'shop_name',
                        'name',
                        'phone',
                        'kecamatan',
                        'kab_kota',
                        'kelurahan',
                        'provinsi',
                        'identity_number',
                        'shop_address',
                    ];

                    $valid = true;

                    foreach ($requiredFields as $field) {
                        if (empty(trim((string) ($vendorData[$field] ?? '')))) {
                            $valid = false;
                            break;
                        }
                    }

                    // Lewati jika data wajib vendor tidak lengkap
                    if (!$valid) {
                        continue;
                    }

                    // Buat atau ambil user berdasarkan NIK
                    $user = User::firstOrCreate(
                        [
                            'nik' => $pengusaha->nik_pengusaha,
                        ],
                        [
                            'name'      => $pengusaha->nama_pengusaha ?: 'Vendor',
                            'password'  => $password,
                            'phone'     => $pengusaha->nomor_whatsapp,
                            'user_role' => 'vendor',
                            'status'    => 'active',
                        ]
                    );

                    // Masukkan user_id ke data vendor
                    $vendorData['user_id'] = $user->id;

                    // Buat atau perbarui data vendor
                    Vendor::updateOrCreate(
                        [
                            'user_id'           => $user->id,
                            'kategori_produk_id' => 1,
                            'phone'             => $pengusaha->nomor_whatsapp,
                        ],
                        $vendorData
                    );
                }

                unset($dataUsaha);
            });

        $this->command->info(
            'Seeder UMKM dan Vendor berhasil dijalankan.'
        );
    }
}
