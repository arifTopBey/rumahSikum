<?php

namespace App\Exports;

use App\Models\ProduksiDanPemasaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MetodePemasaranExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $metode;
    protected $skala;
    protected $search;

    // Mapping metode ke kolom database
    protected $metodeMap = [
        'Digital'          => 'pemasaran_toko_sendiri',
        'NonDigital'       => 'pemasaran_titip_jual',
        'Perantara'        => 'pemasaran_reseller',
        'Pemerintah Pusat' => 'pemasaran_distributor',
        'Provinsi'         => 'pemasaran_marketplace',
        'Kabupaten'        => 'pemasaran_media_sosial',
        'Lainnya'          => 'pemasaran_lainnya',
    ];

    public function __construct($metode = null, $skala = null, $search = null)
    {
        $this->metode = $metode;
        $this->skala  = $skala;
        $this->search = $search;
    }

    public function query()
    {
        $query = ProduksiDanPemasaran::with(['skalaUsaha', 'identitasUsaha'])
            ->select('usaha_produksi_pemasaran.*');

        // Filter Metode
        if (!empty($this->metode) && isset($this->metodeMap[$this->metode])) {
            $kolom = $this->metodeMap[$this->metode];
            $query->where($kolom, 1);
        }

        // Filter Skala
        if (!empty($this->skala) && $this->skala !== 'null') {
            $skala = $this->skala;
            $query->whereHas('skalaUsaha', function ($q) use ($skala) {
                $q->where('skala_usaha', $skala);
            });
        }

        // Filter Search
        if (!empty($this->search)) {
            $query->search(['search' => $this->search]);
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha    ?? '-'),
            $this->metode                            ?? 'Semua',
            $row->identitasUsaha->kecamatan          ?? '-',
            $row->identitasUsaha->kelurahan          ?? '-',
            // Kolom detail metode pemasaran yang dimiliki
            $row->pemasaran_toko_sendiri  == 1 ? 'Ya' : 'Tidak',
            $row->pemasaran_titip_jual    == 1 ? 'Ya' : 'Tidak',
            $row->pemasaran_reseller      == 1 ? 'Ya' : 'Tidak',
            $row->pemasaran_distributor   == 1 ? 'Ya' : 'Tidak',
            $row->pemasaran_marketplace   == 1 ? 'Ya' : 'Tidak',
            $row->pemasaran_media_sosial  == 1 ? 'Ya' : 'Tidak',
            $row->pemasaran_lainnya       == 1 ? 'Ya' : 'Tidak',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Filter Metode Aktif',
            'Kecamatan',
            'Desa',
            'Digital',
            'NonDigital',
            'Pemasaran Perantara',
            'PemasarabPemerintah Pusat',
            'Pemasaran Provinsi',
            'Pemasaran Kabupaten',
            'Lainnya',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}