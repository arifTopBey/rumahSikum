<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table  table-striped table-hover align-middle">
            <thead class="text-center text-white">
                <tr class="bg-primary">
                    <th style="background-color: #00997a; color: white;">Edisi Cetak</th>
                    <th style="background-color: #00997a; color: white;">Tanggal Issued</th>
                    <th style="background-color: #00997a; color: white;">Tanggal Cetak</th>
                    <th style="background-color: #00997a; color: white;">Tanggal Expired</th>
                    <th style="background-color: #00997a; color: white;">Alasan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($koperasi['Sertifikat'] ?? [] as $cert)
                <tr>
                    <td class="text-center">{{ $cert['EdisiCetak'] ?? '-' }}</td>
                    <td>{{ $cert['TglIssued'] ?? '-' }}</td>
                    <td>{{ $cert['TglCetak'] ?? '-' }}</td>
                    <td>{{ $cert['TglExpired'] ?? '-' }}</td>
                    <td>{{ $cert['Alasan'] ?? '-' }}</td>
                </tr>
                @empty
                <tr style="width: 100%;">
                    <td colspan="5" class="text-center text-muted">Tidak ada riwayat sertifikat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>