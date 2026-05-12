@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Daftar Pengajuan</a></li>
                        <li class="breadcrumb-item active">Detail Verifikasi</li>
                    </ol>
                </nav>
                <h4 style="color: #a82282;" class="fw-800 mb-0">Verifikasi Berkas: {{ $vendor->shop_name }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.daftar.umkm') }}" class="btn btn-white border rounded-3 px-4 fw-bold">
                    <i data-lucide="chevron-left" size="18" class="me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-800 mb-4 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="user" class="text-primary" size="20"></i> Informasi Pemilik Usaha
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Nama Lengkap</label>
                        <p class="fw-bold text-dark">{{ $vendor->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">NIK (Nomor Induk Kependudukan)</label>
                        <p class="fw-bold text-dark">{{ $vendor->identity_number }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Nomor WhatsApp</label>
                        <p class="fw-bold text-success">
                            <i data-lucide="phone" size="14" class="me-1"></i> {{ $vendor->phone }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-800 mb-4 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="briefcase" class="text-primary" size="20"></i> Profil Bisnis & Lokasi
                </h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Nama Brand / Toko</label>
                        <p class="fw-bold text-dark">{{ $vendor->shop_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Kategori Usaha</label>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-2 fw-bold">
                            {{ $vendor->category->name ?? 'Kategori' }}
                        </span>
                    </div>
                </div>
                <hr class="opacity-50">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Provinsi</label>
                        <p class="fw-bold text-dark mb-0">{{ $vendor->provinsi }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Kabupaten / Kota</label>
                        <p class="fw-bold text-dark mb-0">{{ $vendor->kab_kota }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Kecamatan / Kelurahan</label>
                        <p class="fw-bold text-dark mb-0">{{ $vendor->kecamatan }}, {{ $vendor->kelurahan }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Kode Pos</label>
                        <p class="fw-bold text-dark mb-0">{{ $vendor->kode_pos }}</p>
                    </div>
                    <div class="col-12">
                        <label class="smaller text-muted d-block">Alamat Lengkap</label>
                        <p class="fw-bold text-dark">{{ $vendor->shop_address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4 text-center">
                <h6 class="fw-800 mb-3 text-start smaller text-muted text-uppercase tracking-wider">Foto Toko/Produk Unggulan</h6>
                <img src="{{ route('show.icon.produk.private', $vendor->store_photo) }}" class="img-fluid rounded-3 shadow-sm border" style="max-height: 250px; width: 100%; object-fit: cover;">
                <!-- <img src="{{ asset('storage/' . $vendor->store_photo) }}" class="img-fluid rounded-3 shadow-sm border" style="max-height: 250px; width: 100%; object-fit: cover;"> -->
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4 text-center">
                <h6 class="fw-800 mb-3 text-start smaller text-muted text-uppercase tracking-wider">Foto KTP Pemilik</h6>
                <div class="position-relative group-hover">
                    <img src="{{ route('show.icon.produk.private', $vendor->identity_photo) }}" class="img-fluid rounded-3 border" style="max-height: 200px; width: 100%; object-fit: cover;">
                    <!-- <img src="{{ route('show.ktp.private', $vendor->identity_photo) }}" class="img-fluid rounded-3 border" style="max-height: 200px; width: 100%; object-fit: cover;"> -->
                    <a href="{{ route('show.icon.produk.private', $vendor->identity_photo) }}" target="_blank" class="btn btn-dark btn-sm rounded-pill px-3 position-absolute top-50 start-50 translate-middle opacity-0 hover-opacity-100">
                        <i data-lucide="maximize" size="14" class="me-1"></i> Perbesar KTP
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 overflow-hidden border-top border-5 border-primary">
                <div class="card-body p-4">
                    <h6 class="fw-800 mb-2">Tentukan Keputusan</h6>
                    <p class="smaller text-muted mb-4">Pastikan semua data dan foto dokumen telah sesuai dengan persyaratan.</p>
                    
                    <div class="d-grid gap-2">
                        <!-- <form action="#" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 rounded-3 fw-bold py-2 mb-2 shadow-sm">
                                <i data-lucide="check-circle" size="18" class="me-2"></i> Setujui Pengajuan
                            </button>
                        </form>
                        
                        <button type="button" class="btn btn-outline-danger w-100 rounded-3 fw-bold py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTolak">
                            <i data-lucide="x-circle" size="18" class="me-2"></i> Tolak Pengajuan
                        </button> -->
                         @if($vendor->status_store === 0)
                                <form style="width: 50%;" action="{{ route('admin.update.status.pengajuan', $vendor->id) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" value="1" name="success">
                                    <button style="width: 100%;" class="btn btn-success btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Setujui
                                    </button>
                                </form>
                                <form style="width: 50%;" action="{{ route('admin.update.status.pengajuan', $vendor->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" value="3" name="failed">
                                    <button style="width: 100%;" class="btn btn-danger btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Tolak
                                    </button>
                                </form>
                            @elseif($vendor->status_store === 1)
                                <button class="btn btn-success btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Disetujui
                                </button>
                            @else
                                <button class="btn btn-danger btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Ditola
                                </button>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0">
                <h5 class="fw-bold">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body py-0">
                    <textarea name="alasan" class="form-control rounded-3 border-2" rows="4" placeholder="Sebutkan alasan penolakan (contoh: Foto KTP tidak jelas)..." required></textarea>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .btn-white { background: white; }
    .tracking-wider { letter-spacing: 1px; }
    
    /* Image Hover Effect */
    .group-hover:hover .hover-opacity-100 {
        opacity: 1 !important;
    }
    .hover-opacity-100 {
        transition: opacity 0.3s ease;
    }
</style>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection