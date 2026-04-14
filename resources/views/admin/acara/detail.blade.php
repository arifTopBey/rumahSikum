@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5">
        <div class="col-md-12 mb-4 d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.acara.index') }}" class="text-decoration-none">Daftar Acara</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Acara</li>
                </ol>
            </nav>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.acara.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
                <a href="{{ route('admin.acara.edit', $acara->id) }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                    <i data-lucide="edit-3" size="18" class="me-1"></i> Edit Acara
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="position-relative">
                        <img src="{{ route('showFoto.acara.private', $acara->gambar) }}" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;" alt="{{ $acara->judul }}">
                        <!-- <img src="{{ Storage::url($acara->gambar) }}" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;" alt="{{ $acara->judul }}"> -->
                        <div class="position-absolute top-0 start-0 m-4">
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm fw-bold">
                                {{ $acara->kategori_acara->name }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-5 bg-white">
                        <h2 class="fw-800 text-dark mb-4">{{ $acara->judul }}</h2>
                        
                        <div class="event-description text-muted lh-lg fs-6">
                            {!! $acara->deskripsi !!}
                        </div>
                    </div>
                </div>

                <!-- <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-800 mb-0">Peserta Terdaftar</h6>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Semua Peserta</a>
                    </div>
                    <div class="text-center py-4">
                        <i data-lucide="users" size="40" class="text-muted mb-2"></i>
                        <p class="text-muted small">Detail manajemen pendaftaran peserta tersedia di modul terpisah.</p>
                    </div>
                </div> -->
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h6 class="fw-800 text-dark mb-4 border-bottom pb-2">Detail Pelaksanaan</h6>
                    
                    <div class="d-flex gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-4 text-primary d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            <i data-lucide="calendar" size="28"></i>
                        </div>
                        <div>
                            <p class="text-muted smaller mb-0">Tanggal</p>
                            <p class="fw-bold text-dark mb-0">{{ \Carbon\Carbon::parse($acara->tanggal_acara)->format('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-4 text-primary d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            <i data-lucide="clock" size="28"></i>
                        </div>
                        <div>
                            <p class="text-muted smaller mb-0">Waktu</p>
                            <p class="fw-bold text-dark mb-0">{{ $acara->waktu_acara_mulai }} - {{ $acara->waktu_acara_selesai }} WIB</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-4 text-primary d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            <i data-lucide="map-pin" size="28"></i>
                        </div>
                        <div>
                            <p class="text-muted smaller mb-0">Lokasi / Venue</p>
                            <p class="fw-bold text-dark mb-0">{{ $acara->lokasi }}</p>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="mb-4">
                        <label class="text-muted smaller d-block mb-2">Kapasitas Peserta</label>
                        <div class="d-flex justify-content-between align-items-end mb-1">
                            <h4 class="fw-800 mb-0">45 <small class="text-muted fw-normal" style="font-size: 1rem;">/ {{ $acara->kuota }}</small></h4>
                            <span class="text-primary fw-bold small">45% Terisi</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    @php
                        $now = \Carbon\Carbon::now();
                        $mulai = \Carbon\Carbon::parse($acara->tanggal_acara . ' ' . $acara->waktu_acara_mulai);
                        $selesai = \Carbon\Carbon::parse($acara->tanggal_acara . ' ' . $acara->waktu_acara_selesai);

                        if ($now->lt($mulai)) {
                            $status = 'Mendatang';
                            $badge = 'bg-primary text-white';
                        } elseif ($now->between($mulai, $selesai)) {
                            $status = 'Berlangsung';
                            $badge = 'bg-warning text-dark';
                        } else {
                            $status = 'Selesai';
                            $badge = 'bg-success text-white';
                        }
                    @endphp
                    <div class="p-3 {{ $badge }} bg-opacity-10 border rounded-3 text-center fw-bold">
                        Status Acara: {{ $status }}
                    </div>
                </div>

                <!-- <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center">
                    <h6 class="fw-800 text-dark mb-3 text-start">Absensi Digital</h6>
                    <div class="bg-light p-4 rounded-4 mb-3 d-inline-block mx-auto">
                         <i data-lucide="qr-code" size="120" class="text-muted"></i>
                    </div>
                    <p class="smaller text-muted">Gunakan kode ini untuk scan pendaftaran di lokasi acara.</p>
                    <button class="btn btn-sm btn-light border w-100 rounded-pill">Unduh QR Code</button>
                </div> -->
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .event-description p { margin-bottom: 1.5rem; }
    .event-description img { max-width: 100%; border-radius: 15px; }
</style>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection