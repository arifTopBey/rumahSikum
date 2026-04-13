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
               <div class="col-md-10 mx-auto position-relative shadow-lg rounded-2 mb-3 py-2">

                <!-- tombol kiri -->
                <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y z-3"
                    onclick="scrollNav(-200)">
                    ◀
                </button>

                 <!-- nav scroll -->
                <div class="overflow-auto px-5" id="navWrapper" style="white-space: nowrap;">
                    <ul class="nav nav-tabs flex-nowrap" id="myTab" role="tablist">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ringkasan">Ringkasan Data</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#identitasUsaha">1. Identitas Usaha</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#karakteristik">2. Karakteristik Usaha</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pengusaha">3. Identitas Pengusaha</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#izin">4. Izin & Standarisasi</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#penghargaan">5. Penghargaan</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bahan">6. Bahan Baku/Penolong</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#produksi">7. Produksi & Pemasaran</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tenagaKerja">8. Tenaga Kerja</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#proses">9. Proses Produksi</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kemitraan">10. Kemitraan</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#keuangan">11. Laporan Keuangan</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pembinaan">12. Pembinaan</button>
                        </li>

                        <li class="nav-item me-5">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#catatan">13. Catatan</button>
                        </li>
                        </ul>
                </div>

                <!-- tombol kanan -->
                    <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y z-3"
                        onclick="scrollNav(200)">
                        ▶
                    </button>

                </div>

                <div class="col-md-10 mx-auto  border-warning bg-warning bg-opacity-10 rounded-2  py-2">
                    <p class="fw-bold fs-5 text-primary">RINGKASAN DATA</p>
                    <p class="text-muted">Ringkasan data berisikan informasi data umkm yang bersifat umum</p>
                </div>


                <div class="tab-content">

                    <div id="ringkasan" class="tab-pane active">
    
                        <div class=" col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
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
                                    <p class="fw-bold">{{ $data->usahaKarakteristik->produk_utama ?? '-' }}</p>
                                </div>
                                <div class="col-md-3" >
                                    <p class="text-muted">Produk Usaha</p>
                                </div>
                                <div class="col-md-9">
                                    <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
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
                                    @if($data->usahaProduksiPemasaran->pemasaran_toko_sendiri === 1 && $data->usahaProduksiPemasaran->pemasaran_toko_sendiri != null)
                                        <p class="fw-bold badge rounded-pill text-bg-secondary">Digital (E-Commerce)*</p>
                                    @endif
                                    @if($data->usahaProduksiPemasaran->pemasaran_titip_jual === 1 && $data->usahaProduksiPemasaran->pemasaran_titip_jual != null)
                                        <p class="fw-bold badge rounded-pill text-bg-secondary">Non Digital (Pasar)*</p>
                                    @endif
                                    @if($data->usahaProduksiPemasaran->pemasaran_reseller === 1 && $data->usahaProduksiPemasaran->pemasaran_reseller != null)
                                        <p class="fw-bold badge rounded-pill text-bg-secondary">Perantara* </p>
                                    @endif
                                    @if($data->usahaProduksiPemasaran->pemasaran_distributor === 1 && $data->usahaProduksiPemasaran->pemasaran_distributor != null)
                                        <p class="fw-bold badge rounded-pill text-bg-secondary">Vendor Pemerintah Pusat*</p>
                                    @endif
                                    @if($data->usahaProduksiPemasaran->pemasaran_marketplace === 1 && $data->usahaProduksiPemasaran->pemasaran_marketplace != null)
                                        <p class="fw-bold badge rounded-pill text-bg-secondary">Vendor Pemerintah Provinsi*</p>
                                    @endif
                                    @if($data->usahaProduksiPemasaran->pemasaran_media_sosial === 1 && $data->usahaProduksiPemasaran->pemasaran_media_sosial != null)
                                        <p class="fw-bold badge rounded-pill text-bg-secondary">Vendor Pemerintah Kabupaten/Kota*</p>
                                    @endif
                                    @if($data->usahaProduksiPemasaran->pemasaran_lainnya === 1 && $data->usahaProduksiPemasaran->pemasaran_lainnya != null)
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

                    <!-- 1. Identitas Usaha -->
                    <div id="identitasUsaha" class="tab-pane">
                       @include('admin.umkm.detail.identitas_usaha')
                    </div>
                    <div id="karakteristik" class="tab-pane">
                       @include('admin.umkm.detail.karakterisitikUsaha')
                    </div>
                    <div id="pengusaha" class="tab-pane">
                       @include('admin.umkm.detail.identitasPengusha')
                    </div>
                    <div id="bahan" class="tab-pane">
                       @include('admin.umkm.detail.bahan_baku')
                    </div>
                    <div id="produksi" class="tab-pane">
                       @include('admin.umkm.detail.produksi_pemasaran')
                    </div>

                </div>
              
        </div>
    </div>
</div>

<script>
function scrollNav(value) {
    document.getElementById('navWrapper').scrollLeft += value;
}
</script>
@endsection
