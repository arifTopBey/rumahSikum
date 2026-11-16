<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table  table-striped table-hover align-middle">
            <thead class="text-center text-white">
                <tr class="bg-primary">
                    <th style="background-color: #00997a; color: white;">No</th>
                    <th style="background-color: #00997a; color: white;">Nomor PAD</th>
                    <th style="background-color: #00997a; color: white;">Tanggal PAD</th>
                    <th style="background-color: #00997a; color: white;">Nomor Pelaporan</th>
                    <th style="background-color: #00997a; color: white;">Tanggal Pelaporan</th>
                </tr>
            </thead>
            <tbody>

                @forelse($koperasi['PAD'] ?? [] as $pad)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $pad['NomorPAD'] ?? '-' }}</td>
                        <td class="text-center">{{ $pad['TanggalPAD'] ?? '-' }}</td>
                        <td class="text-center">{{ $pad['NomorPelaporan'] ?? '-' }}</td>
                        <td class="text-center">{{ $pad['TanggalPelaporan'] ?? '-' }}</td>
                    </tr>
                @empty
                    <tr style="width: 100%;">
                        <td colspan="5" class="text-center text-muted border" ">Tidak ada riwayat PAD.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>