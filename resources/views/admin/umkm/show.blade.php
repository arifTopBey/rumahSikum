@extends('admin.main.main')



@section('content')
    <div class="">
        <div class="container px-2 bg-white shadow-lg mt-3 rounded-2">
            <div class="row mb-3">

                <div class="col-md-12 mb-4  px-3 py-2">
                    <a style="width: 150px" href="{{ route('admin.ukmkm.list') }}"
                        class="ms-3 px-3 d-block fw-bold py-2 border border-secondary rounded-2 text-decoration-none text-primary">Kembali
                    </a>
                    <p class="text-center fs-5 fw-semibold mt-3 mb-3">Detail UMKM</p>
                </div>
                <div style="background-image: linear-gradient(to right, white 60%, #9CDDF7); min-height: 150px;"
                    class="col-md-10 mx-auto shadow-lg border py-2 rounded-2 d-flex justify-content-between">
                    <div class="d-flex flex-column justify-content-center">

                         @if( $data->laporanKeuangan->omzet_usaha <= 2000000)
                            <div
                                class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                <p class="text-warning my-auto">Usaha Mikro</p>
                            </div>


                        @elseif( $data->laporanKeuangan->omzet_usaha > 2000000 && $data->laporanKeuangan->omzet_usaha <= 15000000)
                            <div class="d-flex mb-3 px-3 py-2 bg-primary bg-opacity-10 border border-primary rounded-2">
                                <p class="text-primary my-auto">Usaha Kecil</p>
                            </div>

                        @else
                            <div
                                class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                <p class="text-danger my-auto">Usaha Menengah</p>
                            </div>
                        @endif
                       
                        <div class="">
                            <h5>{{ $data->nama_lengkap_usaha }}</h5>
                            <p>{{ $data->nama_lengkap_usaha }} {{ $data->telepon }}</p>
                            <p>Sumber Data web</p>
                        </div>

                    </div>
                    <div class="flex justify-content-end border">
                        <img height="200" width="200" class="rounded"
                            src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto shadow-lg rounded-2 mb-3">
                    list navbar
                </div>

                <div class="col-md-10 mx-auto  border-warning bg-warning bg-opacity-10 rounded-2  py-2">
                    <p class="fw-bold fs-5 text-primary">RINGKASAN DATA</p>
                    <p class="text-muted">Ringkasan data berisikan informasi data umkm yang bersifat umum</p>
                </div>

                <div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                    <p class="fw-bold fs-5">Informasi Usaha </p>

                    <div class="row ">
                        <div class="col-md-3">
                            <p class="text-muted">NIB</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">{{ $data->id_badan_usaha }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Produk Utama</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">{{ $data->{'106'} }}</p>
                        </div>
                        <div class="col-md-3" >
                            <p class="text-muted">Produk Usaha</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">{{ $data->{'201'} }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                    <p class="fw-bold fs-5">Nilai Usaha</p>

                    <div class="row ">
                        <div class="col-md-3">
                            <p class="text-muted">Aset Usaha</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Omset Usaha</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                    <p class="fw-bold fs-5">Izin dan Standarisasi</p>

                    <div class="row ">
                        <div class="col-md-3">
                            <p class="text-muted">Izin Yang dimiliki</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401c'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Izin Lainnya</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401b'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Standarisasi yang dimiliki</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold badge rounded-pill text-bg-secondary"> {{ $data->{'401j'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Standarisasi Lainnya</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401j'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                    <p class="fw-bold fs-5">Produksi dan Pemasaran</p>

                    <div class="row ">
                        <div class="col-md-3">
                            <p class="text-muted">Proses Produksi </p>
                        </div>
                        <div class="col-md-9 d-flex gap-2">
                            @if($data->{'901a'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Manual</p>
                            @endif
                            @if($data->{'901b'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Mekanik</p>
                            @endif
                            @if($data->{'901c'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Elektronik</p>
                            @endif
                            @if($data->{'901d'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Digital</p>
                            @endif
                            @if($data->{'901e'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Artifcial Intelligence</p>
                            @endif

                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Sarana Produksi</p>
                        </div>
                        <div class="col-md-9 d-flex gap-2">
                            <p class="fw-bold badge rounded-pill text-bg-secondary">Gedung/Tempat Usaha</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Metode Pemasaran</p>
                        </div>
                        <div class="col-md-9 d-flex gap-2">
                            @if($data->{'707a'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Digital (E-Commerce)*</p>
                            @endif
                            @if($data->{'707b'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Non Digital (Pasar)*</p>
                            @endif
                            @if($data->{'707c'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Perantara* </p>
                            @endif
                            @if($data->{'707d'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Vendor Pemerintah Pusat*</p>
                            @endif
                            @if($data->{'707e'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Vendor Pemerintah Provinsi*</p>
                            @endif
                            @if($data->{'707f'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Vendor Pemerintah Kabupaten/Kota*</p>
                            @endif
                            @if($data->{'707g'} === 1)
                                <p class="fw-bold badge rounded-pill text-bg-secondary">Lainnya*</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                    <p class="fw-bold fs-5">Alamat Usaha</p>

                    <div class="row ">
                        <div class="col-md-3">
                            <p class="text-muted">Provinsi</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">{{ preg_replace('/^[0-9.]+\s+/', '', $data->provinsi ?? '') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Kabupaten</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">{{ preg_replace('/^[0-9.]+\s+/', '', $data->kabupaten ?? '') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Kelurahan</p>
                        </div>
                        <div class="col-md-9">
                            {{-- 308d --}}
                            <p class="fw-bold">{{ preg_replace('/^[0-9.]+\s+/', '', $data->kelurahan ?? '') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Alamat Lengkap</p>
                        </div>
                        <div class="col-md-9">
                            <p class="fw-bold">{{ preg_replace('/^[0-9.]+\s+/', '', $data->alamat_lengkap?? '') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Geotaging</p>
                        </div>
                        <div class="col-md-9 d-flex gap-2">
                            <a href="" class="btn btn-primary text-white">Lihat Foto Geotaging</a>
                            <a href="" class="btn border border-primary text-primary">Buka Di Google Maps</a>
                            <a href="" class="text-primary">Salin Link</a>
                        </div>
                        <div class="col-md-12 mt-2">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15864.653262998923!2d106.5961809871582!3d-6.2421958999999765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fc12f9d25279%3A0xdd4d63daf684f253!2sGOR%20Cibogo%20Jaya!5e0!3m2!1sid!2sid!4v1771838394224!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                    </div>
                </div>


                </div>
            </div>
        </div>
    </div>
@endsection
