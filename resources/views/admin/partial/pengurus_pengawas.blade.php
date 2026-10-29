<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table  table-striped table-hover align-middle">
            <thead class="text-center text-white">
                <tr class="bg-primary">
                    <th style="background-color: #00997a; color: white;">No</th>
                    <th style="background-color: #00997a; color: white;">Nama</th>
                    <th style="background-color: #00997a; color: white;">Jabatan</th>
                    <th style="background-color: #00997a; color: white;">Kepengurusan</th>
                    <th style="background-color: #00997a; color: white;">NPWP</th>
                    <th style="background-color: #00997a; color: white;">KTP</th>
                    <th style="background-color: #00997a; color: white;">Tanggal Mulai</th>
                    <th style="background-color: #00997a; color: white;">Tanggal Selesai</th>
                    <th style="background-color: #00997a; color: white;">Status</th>
                    <th style="background-color: #00997a; color: white;">Sumber Data</th>
                </tr>
            </thead>
            <tbody>

                @forelse($koperasi['Pengurus'] ?? [] as $pad)
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">{{ $pad['Nama'] ?? '-' }}</td>
                                    <td class="text-center">{{ $pad['IdJabatan'] ?? '-' }}</td>
                                    <td class="text-center">{{ $pad['IdStatus'] ?? '-' }}</td>
                                    <td class="text-center"> {{
                        !empty($pad['NPWP'])
                        ? str_repeat('X', strlen($pad['NPWP']) - 8) . substr($pad['NPWP'], -8)
                        : '-'
                                            }}</td>
                                    <td class="text-center">{{
                        isset($pad['KTP'])
                        ? substr($pad['KTP'], 0, 4)
                        . str_repeat('X', max(strlen($pad['KTP']) - 7, 0))
                        . substr($pad['KTP'], -3)
                        : '-'
                    }}</td>
                                    <!-- <td class="text-center">{{ $pad['NPWP'] ?? '-' }}</td>
                                    <td class="text-center">{{ $pad['KTP'] ?? '-' }}</td> -->
                                    <td class="text-center">{{ $pad['TanggalMulai'] ?? '-' }}</td>
                                    <td class="text-center">{{ $pad['TanggalSelesai'] ?? '-' }}</td>
                                    <td class="text-center">{{ $pad['StatusKepengurusan'] ?? '-' }}</td>
                                    <td class="text-center">{{ $pad['SumberData'] ?? '-' }}</td>
                                </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">Tidak ada data pengurus dan pengawas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>