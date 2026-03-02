@extends('admin.main.main')

@section('content')
    <div class="">
        <div class="container px-5 bg-white ">
            <div class="row py-5">
                <div class="col-md-12 mx-auto  border-warning bg-warning bg-opacity-10 rounded-2  py-2 mb-3">
                    <p class="fw-bold fs-5 text-primary">Data UMKM By Name By Address</p>
                    <p class="text-muted">Ringkasan data berisikan informasi data umkm yang bersifat umum</p>
                </div>
                <div class="col-lg-12 px-2">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-center text-white">
                                <tr  class="">
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Aksi</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">No</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Nama Usaha</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Skala Usaha</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Provinsi</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Kab/Kot</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $umkm )
                                <tr>
                                    <td class="text-center"><a href="" class="fs-3 text-dark text-decoration-none">:</a></td>
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td class="">{{ $umkm->nama_lengkap_usaha ??$umkm->$nama_lengkap_usaha ?? '-' }}</td>
                                    
                                        <td class="text-center">
                                             @if( $umkm->laporanKeuangan->omzet_usaha <= 2000000)
                                            <div
                                                class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                                <p class="text-warning my-auto">Usaha Mikro</p>
                                            </div>
                                            @endif

                                            @if( $umkm->laporanKeuangan->omzet_usaha > 2000000 && $umkm->laporanKeuangan->omzet_usaha <= 15000000)
                                            <div
                                                class="d-flex mb-3 px-3 py-2 bg-primary bg-opacity-10 border border-primary rounded-2">
                                                <p class="text-primary my-auto">Usaha Kecil</p>
                                            </div>
                                            @endif

                                            @if ($umkm->laporanKeuangan->omzet_usaha > 15000000 && $umkm->laporanKeuangan->omzet_usaha <= 50000000)
                                            <div
                                                class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                                <p class="text-danger my-auto">Usaha Menengah</p>
                                            </div>
                                            @endif
                                        </td>
                                    <!-- <td class="text-center">
                                        <div
                                            class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                            <p class="text-warning my-auto">Usaha Mikro</p>
                                        </div>
                                    </td> -->
                                    <td class="text-center">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm->provinsi ?? '') }}</td>
                                    <td class="text-center">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm->kabupaten?? '') }}</td>
                                    <td class="text-center">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm->kecamatan ?? '') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <div>
                        {{ $data->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
