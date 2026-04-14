@extends('frontend.main.index')

@section('content')

<style>
    body { background-color: #f8fafc; }
    .event-detail-wrapper { margin-top: 100px; margin-bottom: 100px; }
    
    .event-banner {
        height: 450px;
        border-radius: 40px;
        overflow: hidden;
        position: relative;
        margin-bottom: -100px;
        z-index: 1;
    }
    .event-banner img { width: 100%; height: 100%; object-fit: cover; }
    
    .content-card {
        background: white;
        border-radius: 35px;
        padding: 40px;
        position: relative;
        z-index: 2;
        border: 1px solid #edf2f7;
    }

    .sticky-sidebar {
        position: sticky;
        top: 120px;
    }

    .info-pill {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: #f8faff;
        border-radius: 20px;
        margin-bottom: 15px;
    }
    .pill-icon {
        width: 45px; height: 45px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4361ee;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    .rundown-item {
        border-left: 2px dashed #e2e8f0;
        padding-left: 25px;
        padding-bottom: 25px;
        position: relative;
    }
    .rundown-item::before {
        content: '';
        position: absolute;
        left: -7px; top: 0;
        width: 12px; height: 12px;
        background: #4361ee;
        border-radius: 50%;
    }

    .map-container {
        border-radius: 25px;
        overflow: hidden;
        height: 250px;
        border: 1px solid #edf2f7;
    }
</style>


<div class="container event-detail-wrapper">
    <div class="event-banner shadow-lg">
        <img src="{{ Storage::url($acara->gambar) }}" alt="Bazar Banner">
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="content-card shadow-sm mt-5 mt-lg-0">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2 fw-bold mb-3">{{ $acara->kategori_acara->name }}</span>
                        <h2 class="fw-800 display-6">{{ $acara->judul }}</h2>
                        <p class="text-muted"><i data-lucide="map-pin" size="18"></i> {{ $acara->lokasi }}</p>
                    </div>
                    <div class="text-center bg-light p-3 rounded-4">
                        <span class="d-block fw-800 fs-3 text-primary line-height-1">{{ \Carbon\Carbon::parse($acara->tanggal_acara)->format('d') }}</span>
                        <span class="small fw-bold text-muted">{{ \Carbon\Carbon::parse($acara->tanggal_acara)->format('M Y') }}</span>
                    </div>
                </div>

                <hr class="my-4 opacity-50">

                <h5 class="fw-800 mb-3">Tentang Acara</h5>
                <p class="text-muted mb-4">
                    {!! $acara->deskripsi !!}
                </p>
               

                <!-- <h5 class="fw-800 mb-4 mt-5">Jadwal Kegiatan (Rundown)</h5>
                <div class="rundown-list">
                    <div class="rundown-item">
                        <span class="fw-bold text-primary small">08:00 - 09:00</span>
                        <h6 class="fw-bold mb-1">Pembukaan & Sambutan Bupati</h6>
                        <p class="small text-muted">Main Stage - Area Alun-alun</p>
                    </div>
                    <div class="rundown-item">
                        <span class="fw-bold text-primary small">09:00 - 17:00</span>
                        <h6 class="fw-bold mb-1">Pameran & Bazaar UMKM</h6>
                        <p class="small text-muted">Booth Area A, B, dan C</p>
                    </div>
                    <div class="rundown-item">
                        <span class="fw-bold text-primary small">13:00 - 15:00</span>
                        <h6 class="fw-bold mb-1">Talkshow Digital Preneur</h6>
                        <p class="small text-muted">Mini Stage - Pojok Edukasi</p>
                    </div>
                    <div class="rundown-item border-0">
                        <span class="fw-bold text-primary small">19:00 - 21:00</span>
                        <h6 class="fw-bold mb-1">Hiburan Musik & Penutupan</h6>
                        <p class="small text-muted">Main Stage</p>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="col-lg-4 " style="margin-top: 130px;">
            <div class="sticky-sidebar mt-5 mt-lg-0">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-4">Waktu & Lokasi</h6>
                    
                    <div class="info-pill">
                        <div class="pill-icon"><i data-lucide="calendar"></i></div>
                        <div>
                            <span class="d-block smaller text-muted">Tanggal</span>
                            <span class="fw-bold small">{{ \Carbon\Carbon::parse($acara->tanggal_acara)->format('l, d M Y') }}</span>
                        </div>
                    </div>

                    <div class="info-pill">
                        <div class="pill-icon"><i data-lucide="clock"></i></div>
                        <div>
                            <span class="d-block smaller text-muted">Waktu</span>
                            <span class="fw-bold small">{{ \Carbon\Carbon::parse($acara->waktu_acara)->format('H:i') }} WIB</span>
                        </div>
                    </div>
                    <div class="info-pill">
                        <div class="pill-icon"><i data-lucide="map-pin"></i></div>
                        <div>
                            <span class="d-block smaller text-muted">Lokasi</span>
                            <span class="fw-bold small">{{ $acara->lokasi }}</span>
                        </div>
                    </div>

                    <!-- <div class="info-pill">
                        <div class="pill-icon"><i data-lucide="ticket"></i></div>
                        <div>
                            <span class="d-block smaller text-muted">Tiket Masuk</span>
                            <span class="fw-bold small text-success">Gratis / Free</span>
                        </div>
                    </div> -->

                    <!-- <div class="map-container mb-3 mt-3">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1!2d106.4!3d-6.3!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTgnMDAuMCJTIDEwNiwyNCcwMC4wIkU!5e0!3m2!1sen!2sid!4v123456789" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div> -->

                    <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow">
                        Daftar Sebagai Tenant
                    </button>
                    <!-- <button class="btn btn-outline-primary w-100 py-3 rounded-pill fw-bold mt-2">
                        Simpan ke Kalender
                    </button> -->
                </div>

                <!-- <div class="text-center">
                    <p class="small text-muted mb-2">Bagikan acara ini:</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-light rounded-circle p-2"><i data-lucide="facebook" size="18"></i></button>
                        <button class="btn btn-light rounded-circle p-2"><i data-lucide="instagram" size="18"></i></button>
                        <button class="btn btn-light rounded-circle p-2"><i data-lucide="send" size="18"></i></button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection