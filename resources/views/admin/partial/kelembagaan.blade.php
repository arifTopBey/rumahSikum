<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table  table-striped table-hover align-middle">
            <thead  class="text-center text-white">
                <tr  class="bg-primary">
                    <th style="background-color: #00997a; color: white;">Tahun Lembaga</th>
                    <th style="background-color: #00997a; color: white;">Anggota Pria</th>
                    <th style="background-color: #00997a; color: white;">Anggota Wanita</th>
                    <th style="background-color: #00997a; color: white;">Jumlah Anggota</th>
                    <th style="background-color: #00997a; color: white;">Karyawan Pria</th>
                    <th style="background-color: #00997a; color: white;">Karyawan Wanita</th>
                    <th style="background-color: #00997a; color: white;">Jumlah Karyawan</th>
                    <th style="background-color: #00997a; color: white;">Manajer Wanita</th>
                    <th style="background-color: #00997a; color: white;">Manajer Pria</th>
                    <th style="background-color: #00997a; color: white;">Jumlah Manajer</th>

                </tr>
            </thead>
            <tbody>
                @forelse($koperasi['IndikatorLembaga'] ?? [] as $pad)
                <tr>
                    <td class="text-center">{{ $pad['TahunLembaga'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['AnggotaPria'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['AnggotaWanita'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['JumlahAnggota'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['KaryawanPria'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['KaryawanWanita'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['JumlahKaryawan'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['ManajerWanita'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['ManajerPria'] ?? 0 }}</td>
                    <td class="text-center">{{ $pad['JumlahManajer'] ?? 0 }}</td>

                </tr>
                @empty
                <tr style="width: 100%;">
                    <td colspan="12" class="text-center text-muted">Tidak ada data kelembagaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
