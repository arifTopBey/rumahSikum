<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table  table-striped table-hover align-middle">
            <thead class="text-center text-white">
                <tr class="bg-primary">
                    <th style="background-color: #00997a; color: white;">Kode KBLI</th>
                    <th style="background-color: #00997a; color: white;">Jenis Usaha</th>
                    <th style="background-color: #00997a; color: white;">Deskripsi</th>
                    <th style="background-color: #00997a; color: white;">Status</th>
                    <th style="background-color: #00997a; color: white;">Sumber Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse($koperasi['KBLI'] ?? [] as $kbli)
                   
                    <tr>
                        <td><code>{{ $kbli['IdKBLIStr'] ?? '-' }}</code></td>
                        <td>{{ $kbli['JenisUsaha'] ?? '-' }}</td>
                        <td>{{ $kbli['DeskripsiKBLI'] ?? '-' }}</td>
                        <td>{{ $kbli['Status'] ?? '-' }}</td>
                        <td>{{ $kbli['SumberData'] ?? '-' }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data usaha utama.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>