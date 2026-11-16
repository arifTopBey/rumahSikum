<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TenagaKerjaExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $status;
    protected $skala;
    protected $search;

    public function __construct($status = null, $skala = null, $search = null)
    {
        $this->status = $status;
        $this->skala  = $skala;
        $this->search = $search;
    }

    public function query()
    {
        $query = LaporanKeuangan::with(['identitasUsaha', 'identitasPengusaha', 'skalaUsaha'])
            ->join('tenagaKerja', 'usaha_laporan_keuangan.id_badan_usaha', '=', 'tenagaKerja.id_data_badan_usaha')
            ->select('usaha_laporan_keuangan.*'); // Wajib ada agar tidak konflik kolom

        // Filter Status Tenaga Kerja
        if ($this->status == 'Dibayar') {
            $query->where('tenagaKerja.total_pembayaran_upah', '>', 0);
        } elseif ($this->status == 'Tidak Dibayar') {
            $query->where(function ($q) {
                $q->whereNull('tenagaKerja.total_pembayaran_upah')
                  ->orWhere('tenagaKerja.total_pembayaran_upah', 0);
            });
        }

        // Filter Skala
        if (!empty($this->skala) && $this->skala !== 'null') {
            $skala = $this->skala;
            $query->whereHas('skalaUsaha', function ($q) use ($skala) {
                $q->where('skala_usaha', $skala);
            });
        }

        // Filter Search — gunakan scope yang sama
        if (!empty($this->search)) {
            $query->search(['search' => $this->search]);
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha        ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha           ?? '-'),
            $row->identitasPengusaha->nama_pengusaha        ?? '-',
            $row->identitasUsaha->kecamatan                 ?? '-',
            $row->identitasUsaha->kelurahan                 ?? '-',
            $this->status                                   ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Nama Pengusaha',
            'Kecamatan',
            'Desa',
            'Status Tenaga Kerja',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}