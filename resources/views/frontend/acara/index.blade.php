@extends('frontend.main.index')

@section('content')
<div class="container event-wrapper">
    <div class="event-hero shadow-lg">
        <div class="event-hero-circle"></div>
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="fw-800 display-5 mb-3">Agenda & Acara UMKM</h1>
                <p class="lead opacity-90 mb-0">Temukan pameran, bazar, dan festival UMKM terbaik di seluruh wilayah Kabupaten Tangerang.</p>
            </div>
            <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                <!-- <button class="btn btn-white bg-white text-primary rounded-pill px-4 py-3 fw-bold">Daftarkan Acara Anda</button> -->
            </div>
        </div>
    </div>

    <div class="row mb-5 g-3">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3"><i data-lucide="search" size="18" class="text-muted"></i></span>
                <input type="text" class="form-control border-start-0 rounded-end-pill py-3" placeholder="Cari nama acara...">
            </div>
        </div>
        <div class="col-md-8">
            <div class="d-flex gap-2 overflow-auto pb-2 justify-content-md-end">
                <button style="background-color: #7728a8; color: white;" class="btn rounded-pill px-4">Semua</button>
                <button class="btn btn-outline-secondary bg-white rounded-pill px-4 text-nowrap">Bazar & Expo</button>
                <button class="btn btn-outline-secondary bg-white rounded-pill px-4 text-nowrap">Workshop</button>
                <button class="btn btn-outline-secondary bg-white rounded-pill px-4 text-nowrap">Festival Kuliner</button>
            </div>
        </div>
    </div>

    <div class="row g-4">

        @foreach($acaras as $acara)
        <div class="col-md-6 col-lg-4">
            <div class="event-card shadow-sm">
                <div class="event-img-wrapper">
                    <!-- <img src="{{ Storage::url($acara->gambar) }}" class="event-img" alt="Bazar"> -->
                    <img src="{{ route('showFoto.acara.private', $acara->gambar) }}" class="event-img" alt="Bazar">
                    <div class="event-date-badge">
                        <span class="date-day">{{ \Carbon\Carbon::parse($acara->tanggal_acara)->format('d') }}</span>
                        <span class="date-month">{{ \Carbon\Carbon::parse($acara->tanggal_acara)->format('M') }}</span>
                    </div>
                </div>
                <div class="event-body">
                    <span class="event-category">{{ $acara->kategori_acara->name }}</span>
                    <h5 class="event-title">{{ $acara->judul }}</h5>
                    <div class="event-meta">
                        <i data-lucide="map-pin" size="14"></i> {{ $acara->lokasi }}
                    </div>
                    <div class="event-meta">
                        <i data-lucide="clock" size="14"></i> {{ \Carbon\Carbon::parse($acara->jam_acara)->format('H:i') }} - {{ \Carbon\Carbon::parse($acara->jam_selesai)->format('H:i') }} WIB
                    </div>
                    <a href="{{ route('frontend.acara.detail', $acara->id) }}" class="btn-event-detail">Lihat Detail Acara</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- <div class="mt-5 d-flex justify-content-center">
        <nav>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link rounded-start-pill px-3" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link px-3" href="#">1</a></li>
                <li class="page-item"><a class="page-link px-3" href="#">2</a></li>
                <li class="page-item"><a class="page-link rounded-end-pill px-3" href="#">Next</a></li>
            </ul>
        </nav>
    </div> -->
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection