<div class="col-lg-12 px-2">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class=" text-white">
                <tr class="">
                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Aksi</th>
                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">No</th>
                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Nama Usaha
                    </th>
                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Skala Usaha
                    </th>
                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Provinsi</th>
                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Kab/Kot</th>
                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Kelurahan
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $umkm)
                    <tr>
                        <td class="text-center"><a href="{{ route('admin.umkm.detail', $umkm->id_badan_usaha) }}" class="fs-3 text-dark text-decoration-none">:</a></td>
                        <td class="">{{ $loop->iteration }}</td>
                        <td class="">{{ $umkm->identitasUsaha->nama_lengkap_usaha }}</td>

                        <td class="text-center">
                             @if ($umkm->skala_usaha === 'mikro')
                                <div
                                    class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                    <p class="text-warning my-auto">Usaha Mikro</p>
                                </div>
                            @elseif($umkm->skala_usaha === 'kecil')
                                <div
                                    class="d-flex mb-3 px-3 py-2 bg-primary bg-opacity-10 border border-primary rounded-2">
                                    <p class="text-primary my-auto">Usaha Kecil</p>
                                </div>
                            @elseif ($umkm->skala_usaha === 'menengah')
                                <div
                                    class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                    <p class="text-danger my-auto">Usaha Menengah</p>
                                </div>
                            @endif
                        </td>

                        <td class="text-center">
                            {{ preg_replace('/^[0-9.]+\s+/', '', $umkm->identitasUsaha->provinsi ?? '') }}</td>
                        <td class="text-center">
                            {{ preg_replace('/^[0-9.]+\s+/', '', $umkm->identitasUsaha->kabupaten ?? '') }}</td>
                        <td class="text-center">
                            {{ preg_replace('/^[0-9.]+\s+/', '', $umkm->identitasUsaha->kelurahan ?? '') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        {{ $data->links() }}
    </div>
</div>
