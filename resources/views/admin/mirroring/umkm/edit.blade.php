@extends('admin.main.main')

@section('content')
<div class="container-fluid px-3 py-4">
    <!-- Header Page -->
    <div class="card border-0 shadow-sm mb-4 rounded-3">


@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



        <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 fs-7">
                        <li class="breadcrumb-item"><a href="{{ route('admin.ukmkm.list') }}" class="text-decoration-none">UMKM</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                    </ol>
                </nav>
                <h4 class="mb-0 fw-bold text-dark">Edit Data UMKM: <span class="text-primary">{{ $data->nama_lengkap_usaha }}</span></h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.ukmkm.list') }}" class="btn btn-outline-secondary px-4 fw-medium rounded-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" form="formEditUmkm" style="color:white; background-color: #a8226c; padding: 6px 24px;" class="px-4 fw-medium rounded-2">
                    <i class="bi bi-save me-1"></i> Simpan Semua Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <form id="formEditUmkm" action="{{ route('admin.mirroring.umkm.update', $data->id_badan_usaha) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Sticky / Horizontal Scroll Tab Navigation -->
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-2 position-relative">
                        <button type="button" class="btn btn-light btn-sm position-absolute top-50 start-0 translate-middle-y z-3 shadow-sm ms-1 rounded-circle d-none d-md-block" onclick="scrollNav(-200)">
                            &#10094;
                        </button>

                        <div class="overflow-auto px-md-4 py-1" id="navWrapper" style="white-space: nowrap; scroll-behavior: smooth;">
                            <ul class="nav nav-pills flex-nowrap gap-1" id="editTab" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#identitasUsaha" type="button">1. Identitas Usaha</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#karakteristik" type="button">2. Karakteristik Usaha</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#pengusaha" type="button">3. Identitas Pengusaha</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#izin" type="button">4. Izin & Standarisasi</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#penghargaan" type="button">5. Penghargaan</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#bahan" type="button">6. Bahan Baku/Penolong</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#produksi" type="button">7. Produksi & Pemasaran</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#tenagaKerja" type="button">8. Tenaga Kerja</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#proses" type="button">9. Proses Produksi</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#kemitraan" type="button">10. Kemitraan</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#keuangan" type="button">11. Laporan Keuangan</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#pembinaan" type="button">12. Pembinaan</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-medium fs-7" data-bs-toggle="pill" data-bs-target="#catatan" type="button">13. Catatan</button>
                                </li>
                            </ul>
                        </div>

                        <button type="button" class="btn btn-light btn-sm position-absolute top-50 end-0 translate-middle-y z-3 shadow-sm me-1 rounded-circle d-none d-md-block" onclick="scrollNav(200)">
                            &#10095;
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tab Content Area -->
            <div class="col-12">
                <div class="tab-content">

                    <!-- TAB 1: IDENTITAS USAHA -->
                    <div class="tab-pane fade show active" id="identitasUsaha" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-building me-2"></i>1. Identitas Usaha</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nama_lengkap_usaha" class="form-label fw-semibold">Nama Lengkap Usaha <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2 @error('nama_lengkap_usaha') is-invalid @enderror" id="nama_lengkap_usaha" name="nama_lengkap_usaha" value="{{ old('nama_lengkap_usaha', $data->nama_lengkap_usaha) }}" required>
                                        @error('nama_lengkap_usaha')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telpon" class="form-label fw-semibold">Nomor Telepon/HP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2 @error('telpon') is-invalid @enderror" id="telpon" name="telpon" value="{{ old('telpon', $data->telpon) }}" required>
                                        @error('telpon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="provinsi" class="form-label fw-semibold">Provinsi</label>
                                        <input type="text" class="form-control rounded-2" id="provinsi" name="provinsi" value="{{ old('provinsi', $data->provinsi) }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="kabupaten" class="form-label fw-semibold">Kabupaten / Kota</label>
                                        <input type="text" class="form-control rounded-2" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $data->kabupaten) }}">
                                    </div>

                                     <div class="col-md-3">
                                        <label for="kecamatan" class="form-label fw-semibold">Kecamatan</label>
                                        <input type="text" class="form-control rounded-2" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $data->kecamatan) }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="kelurahan" class="form-label fw-semibold">Kelurahan / Desa</label>
                                        <input type="text" class="form-control rounded-2" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $data->kelurahan) }}">
                                    </div>

                                    <div class="col-12">
                                        <label for="alamat_lengkap" class="form-label fw-semibold">Alamat Lengkap</label>
                                        <textarea class="form-control rounded-2" id="alamat_lengkap" name="alamat_lengkap" rows="3">{{ old('alamat_lengkap', $data->alamat_lengkap) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: KARAKTERISTIK USAHA -->
                    <div class="tab-pane fade" id="karakteristik" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-tags me-2"></i>2. Karakteristik Usaha</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="nomor_induk_berusaha" class="form-label fw-semibold">Nomor Induk Berusaha (NIB)</label>
                                        <input type="text" class="form-control rounded-2" id="nomor_induk_berusaha" name="nomor_induk_berusaha" value="{{ old('nomor_induk_berusaha', $data->usahaKarakteristik->nomor_induk_berusaha ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="npwp" class="form-label fw-semibold">NPWP </label>
                                        <input type="text" class="form-control rounded-2" id="npwp" name="npwp_usaha" value="{{ old('npwp_usaha', $data->usahaKarakteristik->npwp_usaha ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bulan_mulai_operasi" class="form-label fw-semibold">Bulan Mulai Operasi </label>
                                        <input type="number" min="0" max="12" class="form-control rounded-2" id="bulan_mulai_operasi" name="bulan_mulai_operasi" value="{{ old('bulan_mulai_operasi', $data->usahaKarakteristik->bulan_mulai_operasi ?? '') }}">
                                    </div>
                                     <div class="col-md-3">
                                        <label for="tahun_mulai_operasi" class="form-label fw-semibold">Tahun Mulai Operasi</label>
                                        <input type="number" min="0" max="2023" class="form-control rounded-2" id="tahun_mulai_operasi" name="tahun_mulai_operasi" value="{{ old('tahun_mulai_operasi', $data->usahaKarakteristik->tahun_mulai_operasi ?? '') }}">
                                    </div>

                                     <div class="col-md-6">
                                        <label for="kategori_kbli" class="form-label fw-semibold">Kategori KBLI</label>
                                        <input type="number" min="0" max="2023" class="form-control rounded-2" id="kategori_kbli" name="kategori_kbli" value="{{ old('kategori_kbli', $data->usahaKarakteristik->kategori_kbli ?? '') }}">
                                    </div>
                                      <div class="col-md-6">
                                        <label for="kode_kbli" class="form-label fw-semibold">Kode KBLI</label>
                                        <input type="number" min="0" max="9999999" class="form-control rounded-2" id="kode_kbli" name="kode_kbli" value="{{ old('kode_kbli', $data->usahaKarakteristik->kode_kbli ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="produk_utama" class="form-label fw-semibold">Produk Utama</label>
                                        <input type="text" class="form-control rounded-2" id="produk_utama" name="produk_utama" value="{{ old('produk_utama', $data->usahaKarakteristik->produk_utama ?? '') }}">
                                    </div>

                                    <div class="col-6">
                                        <label for="kegiatan_utama" class="form-label fw-semibold">Kegiatan Utama Usaha</label>
                                        <input type="text" class="form-control rounded-2" id="kegiatan_utama" name="kegiatan_utama" value="{{ old('kegiatan_utama', $data->usahaKarakteristik->kegiatan_utama ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: IDENTITAS PENGUSAHA -->
                    <div class="tab-pane fade" id="pengusaha" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-person-badge me-2"></i>3. Identitas Pengusaha</h5>
                            </div>
                            <div class="card-body p-4">
                                {{-- Jika ada partial view untuk form edit --}}
                                <!-- @if(View::exists('admin.umkm.edit.identitasPengusha'))
                                    @include('admin.umkm.edit.identitasPengusha')
                                @else
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nama Pemilik / Pengusaha</label>
                                            <input type="text" class="form-control rounded-2" name="nama_pemilik" value="{{ old('nama_pemilik', $data->nama_pemilik ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">NIK Pemilik</label>
                                            <input type="text" class="form-control rounded-2" name="nik_pemilik" value="{{ old('nik_pemilik', $data->nik_pemilik ?? '') }}">
                                        </div>
                                    </div>
                                @endif -->
                               
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Nama Pemilik / Pengusaha</label>
                                            <input type="text" class="form-control rounded-2" name="nama_pengusaha" value="{{ old('nama_pengusaha', $data->identitasPengusaha->nama_pengusaha ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">NIK Pemilik</label>
                                            <input type="text" class="form-control rounded-2" name="nik_pengusaha" value="{{ old('nik_pengusaha', $data->identitasPengusaha->nik_pengusaha ?? '') }}">
                                        </div>
                                         <div class="col-md-4">
                                            <label class="form-label fw-semibold">Nomor WhatsApp Pengusaha</label>
                                            <input type="text" class="form-control rounded-2" name="nomor_whatsapp" value="{{ old('nomor_whatsapp', $data->identitasPengusaha->nomor_whatsapp ?? '') }}">
                                        </div>
                                         <div class="col-md-3">
                                            <label for="provinsi" class="form-label fw-semibold">Provinsi</label>
                                            <input type="text" class="form-control rounded-2" id="provinsi" name="provinsi_pengusaha" value="{{ old('provinsi_pengusaha', $data->identitasPengusaha->provinsi_pengusaha ?? '') }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="kabupaten" class="form-label fw-semibold">Kabupaten / Kota</label>
                                            <input type="text" class="form-control rounded-2" id="kabupaten" name="kabupaten_pengusaha" value="{{ old('kabupaten_pengusaha', $data->identitasPengusaha->kabupaten_pengusaha ?? '') }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="kecamatan" class="form-label fw-semibold">Kecamatan</label>
                                            <input type="text" class="form-control rounded-2" id="kecamatan" name="kecamatan_pengusaha" value="{{ old('kecamatan_pengusaha', $data->identitasPengusaha->kecamatan_pengusaha ?? '') }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="desa_pengusaha" class="form-label fw-semibold">Kelurahan / Desa</label>
                                            <input type="text" class="form-control rounded-2" id="desa_pengusaha" name="desa_pengusaha" value="{{ old('desa_pengusaha', $data->identitasPengusaha->desa_pengusaha ?? '') }}">
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: IZIN & STANDARISASI -->
                    <div class="tab-pane fade" id="izin" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-shield-check me-2"></i>4. Izin & Standarisasi</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <!-- <div class="col-md-6">
                                        <label class="form-label fw-semibold">Izin Usaha Utama</label>
                                        <select class="form-select rounded-2" name="401c">
                                            <option value="1" {{ ($data->{'401c'} ?? null) == 1 ? 'selected' : '' }}>Ada</option>
                                            <option value="2" {{ ($data->{'401c'} ?? null) == 2 ? 'selected' : '' }}>Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Izin Lainnya</label>
                                        <select class="form-select rounded-2" name="401b">
                                            <option value="1" {{ ($data->{'401b'} ?? null) == 1 ? 'selected' : '' }}>Ada</option>
                                            <option value="2" {{ ($data->{'401b'} ?? null) == 2 ? 'selected' : '' }}>Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Standarisasi Usaha</label>
                                        <select class="form-select rounded-2" name="401j">
                                            <option value="1" {{ ($data->{'401j'} ?? null) == 1 ? 'selected' : '' }}>Ada</option>
                                            <option value="2" {{ ($data->{'401j'} ?? null) == 2 ? 'selected' : '' }}>Tidak Ada</option>
                                        </select>
                                    </div> -->
                                     <div class="col-md-6">
                                        <label class="form-label fw-semibold">Izin Pangan Industri Rumah Tangga (PIRT)</label>
                                        <select class="form-select rounded-2" name="memiliki_pirt">
                                            <option value="1" {{ ($data->usahaPerizinan->memiliki_pirt ?? null) == 1 ? 'selected' : '' }}>Ada</option>
                                            <option value="2" {{ ($data->usahaPerizinan->memiliki_pirt ?? null) == 2 ? 'selected' : '' }}>Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Izin BD/BPOM</label>
                                        <select class="form-select rounded-2" name="memiliki_bpom">
                                            <option value="1" {{ ($data->usahaPerizinan->memiliki_bpom ?? null) == 1 ? 'selected' : '' }}>Ada</option>
                                            <option value="2" {{ ($data->usahaPerizinan->memiliki_bpom ?? null) == 2 ? 'selected' : '' }}>Tidak Ada</option>
                                        </select>
                                    </div>
                                     <div class="col-md-6">
                                        <label class="form-label fw-semibold">Izin Tanda Daftar Perusahaan (TDP)</label>
                                        <select class="form-select rounded-2" name="memiliki_tdp">
                                            <option value="1" {{ ($data->usahaPerizinan->memiliki_tdp ?? null) == 1 ? 'selected' : '' }}>Ada</option>
                                            <option value="2" {{ ($data->usahaPerizinan->memiliki_tdp ?? null) == 2 ? 'selected' : '' }}>Tidak Ada</option>
                                        </select>
                                    </div>
                                     <div class="col-md-6">
                                        <label class="form-label fw-semibold">Izin Standarisasi Halal</label>
                                        <select class="form-select rounded-2" name="memiliki_sertifikat_halal">
                                            <option value="1" {{ ($data->usahaPerizinan->memiliki_sertifikat_halal ?? null) == 1 ? 'selected' : '' }}>Ada</option>
                                            <option value="2" {{ ($data->usahaPerizinan->memiliki_sertifikat_halal ?? null) == 2 ? 'selected' : '' }}>Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: PENGHARGAAN -->
                    <div class="tab-pane fade" id="penghargaan" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-award me-2"></i>5. Penghargaan</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted">Form masukan penghargaan usaha dapat disesuaikan di sini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 6: BAHAN BAKU -->
                    <div class="tab-pane fade" id="bahan" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-box-seam me-2"></i>6. Bahan Baku / Penolong</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted">Form masukan bahan baku dan penolong.</p>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 7: PRODUKSI & PEMASARAN -->
                    <div class="tab-pane fade" id="produksi" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-shop me-2"></i>7. Produksi & Pemasaran</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="pemasaran_toko_sendiri" name="pemasaran_toko_sendiri" value="1" {{ old('pemasaran_toko_sendiri', $data->usahaProduksiPemasaran->pemasaran_toko_sendiri ?? 0) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label fw-medium" for="pemasaran_toko_sendiri">Pemasaran Toko Sendiri (E-Commerce)</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="pemasaran_titip_jual" name="pemasaran_titip_jual" value="1" {{ old('pemasaran_titip_jual', $data->usahaProduksiPemasaran->pemasaran_titip_jual ?? 0) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label fw-medium" for="pemasaran_titip_jual">Titip Jual (Pasar / Off-line)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="pemasaran_reseller" name="pemasaran_reseller" value="1" {{ old('pemasaran_reseller', $data->usahaProduksiPemasaran->pemasaran_reseller ?? 0) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label fw-medium" for="pemasaran_reseller">Melalui Reseller / Perantara</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 8: TENAGA KERJA -->
                    <div class="tab-pane fade" id="tenagaKerja" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-people me-2"></i>8. Tenaga Kerja</h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- <p class="text-muted">Form masukan jumlah dan detail tenaga kerja.</p> -->
                                 <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="total_tenaga_kerja" class="form-label fw-semibold">Jumlah Tenaga Kerja</label>
                                        <input type="text" class="form-control rounded-2" id="total_tenaga_kerja" name="total_tenaga_kerja" value="{{ old('total_tenaga_kerja', $data->tenagaKerja->total_tenaga_kerja ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="total_pembayaran_upah" class="form-label fw-semibold">Total Pembayaran Upah</label>
                                        <input type="text" class="form-control rounded-2" id="total_pembayaran_upah" name="total_pembayaran_upah" value="{{ old('total_pembayaran_upah', $data->tenagaKerja->total_pembayaran_upah ?? '') }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 9: PROSES PRODUKSI -->
                    <div class="tab-pane fade" id="proses" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-gear-wide-connected me-2"></i>9. Proses Produksi</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="901a" value="1" id="proc_a" {{ ($data->{'901a'} ?? null) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="proc_a">Manual</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="901b" value="1" id="proc_b" {{ ($data->{'901b'} ?? null) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="proc_b">Mekanik</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="901c" value="1" id="proc_c" {{ ($data->{'901c'} ?? null) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="proc_c">Elektronik</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="901d" value="1" id="proc_d" {{ ($data->{'901d'} ?? null) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="proc_d">Digital</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="901e" value="1" id="proc_e" {{ ($data->{'901e'} ?? null) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="proc_e">Artificial Intelligence</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 10: KEMITRAAN -->
                    <div class="tab-pane fade" id="kemitraan" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-handbag me-2"></i>10. Kemitraan</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted">Form masukan detail kemitraan usaha.</p>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 11: LAPORAN KEUANGAN -->
                    <div class="tab-pane fade" id="keuangan" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-currency-dollar me-2"></i>11. Laporan Keuangan</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="omzet_usaha" class="form-label fw-semibold">Omset Usaha (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input type="number" step="any" class="form-control rounded-end" id="omzet_usaha" name="omzet_usaha" value="{{ old('omzet_usaha', $data->laporanKeuangan->omzet_usaha ?? 0) }}">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="pendapatan_lain" class="form-label fw-semibold">Pendapatan Lainnya (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input type="number" step="any" class="form-control rounded-end" id="pendapatan_lain" name="pendapatan_lain" value="{{ old('pendapatan_lain', $data->laporanKeuangan->pendapatan_lain ?? 0) }}">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <label for="subsidi_bantuan" class="form-label fw-semibold">Subsidi Bantuan (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input type="number" step="any" class="form-control rounded-end" id="subsidi_bantuan" name="subsidi_bantuan" value="{{ old('subsidi_bantuan', $data->laporanKeuangan->subsidi_bantuan ?? 0) }}">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <label for="pinjaman_diterima" class="form-label fw-semibold">Pinjaman Diterima (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input type="number" step="any" class="form-control rounded-end" id="pinjaman_diterima" name="pinjaman_diterima" value="{{ old('pinjaman_diterima', $data->laporanKeuangan->pinjaman_diterima ?? 0) }}">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <label for="sumber_lainnya" class="form-label fw-semibold">Sumber Lainnya (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input type="number" step="any" class="form-control rounded-end" id="sumber_lainnya" name="sumber_lain" value="{{ old('sumber_lain', $data->laporanKeuangan->sumber_lain ?? 0) }}">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="biaya_bahan_baku" class="form-label fw-semibold">Biaya Bahan Baku (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input type="number" step="any" class="form-control rounded-end" id="biaya_bahan_baku" name="biaya_bahan_baku" value="{{ old('biaya_bahan_baku', $data->laporanKeuangan->biaya_bahan_baku ?? 0) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="biaya_tenaga_kerja" class="form-label fw-semibold">Biaya Tenaga Kerja (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input type="number" step="any" class="form-control rounded-end" id="biaya_tenaga_kerja" name="biaya_tenaga_kerja" value="{{ old('biaya_tenaga_kerja', $data->laporanKeuangan->biaya_tenaga_kerja ?? 0) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 12: PEMBINAAN -->
                    <div class="tab-pane fade" id="pembinaan" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-journal-bookmark me-2"></i>12. Pembinaan</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted">Form histori atau rencana pembinaan UMKM.</p>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 13: CATATAN -->
                    <div class="tab-pane fade" id="catatan" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3 border-0 border-bottom">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-sticky me-2"></i>13. Catatan Tambahan</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="col-12">
                                    <label for="catatan_admin" class="form-label fw-semibold">Catatan</label>
                                    <textarea class="form-control rounded-2" id="catatan_admin" name="catatan_admin" rows="4" placeholder="Tambahkan catatan khusus mengenai UMKM ini...">{{ old('catatan_admin', $data->catatan_admin ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>
</div>

<!-- Extra Styling Custom -->
<style>
    /* Styling Nav Pills Modern */
    #editTab .nav-link {
        color: #495057;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease-in-out;
    }
    #editTab .nav-link.active {
        color: #fff;
        background-color: #a8226c;
        border-color: #a8226c;
        /* background-color: #0d6efd;
        border-color: #0d6efd; */
        box-shadow: 0 4px 6px rgba(13, 110, 253, 0.25);
    }
    #editTab .nav-link:hover:not(.active) {
        background-color: #e9ecef;
    }
    .fs-7 {
        font-size: 0.875rem;
    }
    body {
        padding-bottom: 60px; /* Space agar tidak tertutup sticky bar */
    }
</style>

<!-- Script Scroll Navigation -->
<script>
    function scrollNav(value) {
        document.getElementById('navWrapper').scrollLeft += value;
    }
</script>
@endsection