<?php

namespace App\Exports;

use App\Models\SkalaUsaha;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class GenderExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $gender;
    protected $skala;
    protected $search;

    public function __construct($gender = null, $skala = null, $search = null)
    {
        $this->gender = $gender;
        $this->skala  = $skala;
        $this->search = $search;
    }

    public function query()
    {
        $query = SkalaUsaha::with(['identitasPengusaha', 'identitasUsaha']);

        // Filter Gender
        if ($this->gender == 'Laki-Laki') {
            $query->whereHas('identitasPengusaha', function ($q) {
                $q->where('status_pengusaha', 1);
            });
        } elseif ($this->gender == 'Perempuan') {
            $query->whereHas('identitasPengusaha', function ($q) {
                $q->where('status_pengusaha', 2);
            });
        } elseif ($this->gender == 'Tidak Diketahui') {
            $query->whereHas('identitasPengusaha', function ($q) {
                $q->whereNotIn('status_pengusaha', [1, 2])
                  ->orWhereNull('status_pengusaha');
            });
        }

        // Filter Skala — langsung di tabel skala_usaha
        if (!empty($this->skala) && $this->skala !== 'null') {
            $query->where('skala_usaha', $this->skala);
        }

        // Filter Search
        if (!empty($this->search)) {
            $query->search(['search' => $this->search]);
        }

        return $query;
    }

    public function map($row): array
    {
        $statusMap = [1 => 'Laki-Laki', 2 => 'Perempuan'];
        $statusPengusaha = $row->identitasPengusaha->status_pengusaha ?? null;

        return [
            $row->identitasUsaha->nama_lengkap_usaha    ?? '-',
            ucfirst($row->skala_usaha                   ?? '-'),
            $row->identitasPengusaha->nama_pengusaha    ?? '-',
            $statusMap[$statusPengusaha]                ?? 'Tidak Diketahui',
            $row->identitasUsaha->kecamatan             ?? '-',
            $row->identitasUsaha->kelurahan                  ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Nama Pengusaha',
            'Jenis Kelamin',
            'Kecamatan',
            'Desa',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}