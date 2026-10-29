<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UmkmGenderExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading
{
    protected $gender;

    public function __construct($gender)
    {
        $this->gender = $gender;
    }

    public function query()
    {
        $query = LaporanKeuangan::with('identitasUsaha', 'identitasPengusaha')
            ->whereHas('identitasPengusaha', function ($q) {

                if ($this->gender === 'Laki-laki') {
                    $q->where('status_pengusaha', 1);
                }

                if ($this->gender === 'Perempuan') {
                    $q->where('status_pengusaha', 2);
                }

                if ($this->gender === 'Tidak Diketahui') {
                    $q->where(function ($sub) {
                        $sub->whereNull('status_pengusaha')
                            ->orWhereNotIn('status_pengusaha', [1, 2]);
                    });
                }
            });

        return $query;
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Jenis Kelamin',
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

        $genderText = 'Tidak Diketahui';

        if ($row->identitasPengusaha?->status_pengusaha == 1) {
            $genderText = 'Laki-laki';
        }

        if ($row->identitasPengusaha?->status_pengusaha == 2) {
            $genderText = 'Perempuan';
        }

        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            $genderText,
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