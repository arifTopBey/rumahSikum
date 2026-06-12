<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table  table-striped table-hover align-middle">
            <thead  class="text-center text-white">
                <tr class="bg-primary">
                    <th style="background-color: #00997a; color: white;">Tahun Usaha</th>
                    <th style="background-color: #00997a; color: white;">Modal Sendiri</th>
                    <th style="background-color: #00997a; color: white;">Modal Luar</th>
                    <th style="background-color: #00997a; color: white;">Aset</th>
                    <th style="background-color: #00997a; color: white;">Volume Usaha</th>
                    <th style="background-color: #00997a; color: white;">Sisa Hasil Usaha</th>
                </tr>
            </thead>
            <tbody>
             @forelse($koperasi['IndikatorUsaha'] ?? [] as $cert)
                <tr>
                    <td class="text-center">{{ number_format($cert['TahunUsaha'] ?? 0) }}</td>
                    <td class="text-center">{{ number_format($cert['ModalSendiri'] ?? 0) }}</td>
                    <td class="text-center">{{ number_format($cert['ModalLuar'] ?? 0) }}</td>
                    <td class="text-center">{{ number_format($cert['Aset'] ?? 0) }}</td>
                    <td class="text-center">{{ number_format($cert['VolumeUsaha'] ?? 0) }}</td>
                    <td class="text-center">{{ number_format($cert['SisaHasilUsaha'] ?? 0) }}</td>

                </tr>
                @empty
                <tr style="width: 100%;">
                    <td colspan="7" class="text-center text-muted">Tidak ada data usaha.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
