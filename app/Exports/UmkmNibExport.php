<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;



class UmkmNibExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function query()
    {
        $query =  LaporanKeuangan::with('usahaKarakteristik','identitasUsaha')
            ->whereHas('usahaKarakteristik', function ($q) {

                if ($this->status === 'Punya') {
                    $q->whereNotNull('nomor_induk_berusaha')
                      ->where('nomor_induk_berusaha', '!=', '');
                }

                // request timeout
                if($this->status === 'Tidak'){
                    $q->whereNull('nomor_induk_berusaha')->orWhere('nomor_induk_berusaha', '');
                }
            });

        return $query;
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Nomor Induk Berusaha',
            'Skala Usaha',
            'Provinsi',
            'Kabupaten',
            'Kecamatan'
        ];
    }

    public function map($row): array
    {
        $skala = 'Menengah';

        if ($row->omzet_usaha <= 2000000) {
            $skala = 'Mikro';
        } elseif ($row->omzet_usaha <= 15000000) {
            $skala = 'Kecil';
        }

        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            $row->usahaKarakteristik->nomor_induk_berusaha ?? '-',
            $skala,
            $row->identitasUsaha->provinsi ?? '-',
            $row->identitasUsaha->kabupaten ?? '-',
            $row->identitasUsaha->kecamatan ?? '-',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}