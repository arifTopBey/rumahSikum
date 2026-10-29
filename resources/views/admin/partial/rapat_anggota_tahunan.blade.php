<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table  table-striped table-hover align-middle">
            <thead class="text-center text-white">
                <tr class="bg-primary">
                    <th style="background-color: #00997a; color: white;">Tahun Laporan</th>
                    <th style="background-color: #00997a; color: white;">Tanggal RAT</th>
                    <th style="background-color: #00997a; color: white;">Nomor Akta</th>
                    <th style="background-color: #00997a; color: white;">Tanggal Akta</th>
                    <th style="background-color: #00997a; color: white;">Nama Notaris</th>
                    <th style="background-color: #00997a; color: white;">Alamat Rapat</th>
                    <th style="background-color: #00997a; color: white;">Jumlah Peserta</th>
                </tr>
            </thead>
            <tbody>
                @forelse($koperasi['RAT'] ?? [] as $pad)
                <tr>
                    <td class="text-center">{{ $pad['TahunRAT'] ?? '-' }}</td>
                    <td class="text-center">{{ $pad['TanggalRAT'] ?? '-' }}</td>
                    <td class="text-center">{{ $pad['NomorAkta'] ?? '-' }}</td>
                    <td class="text-center">{{ $pad['TanggalAkta'] ?? '-' }}</td>
                    <td class="text-center">{{ $pad['NamaNotaris'] ?? '-' }}</td>
                    <td class="text-center">{{ $pad['AlamatRapat'] ?? '-' }}</td>
                    <td class="text-center">{{ $pad['JumlahPeserta'] ?? '-' }}</td>
                </tr>
                @empty
                <tr style="width: 100%;">
                    <td colspan="8" class="text-center text-muted">Tidak ada data rapat anggota tahunan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
