<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Usaha</th>
            <th>Skala</th>
            <th>Provinsi</th>
            <th>Kab/Kot</th>
            <th>Kecamatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $umkm)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $umkm->identitasUsaha->nama_lengkap_usaha }}</td>
                <td>
                    @if ($umkm->omzet_usaha <= 2000000)
                        Mikro
                    @elseif($umkm->omzet_usaha <= 15000000)
                        Kecil
                    @else
                        Menengah
                    @endif
                </td>
                <td>{{ $umkm->identitasUsaha->provinsi }}</td>
                <td>{{ $umkm->identitasUsaha->kabupaten }}</td>
                <td>{{ $umkm->identitasUsaha->kecamatan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>