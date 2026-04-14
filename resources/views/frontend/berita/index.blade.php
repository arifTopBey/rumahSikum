@extends('frontend.main.index')

@section('content')

<div class="container news-wrapper">
    <div class="row mb-5 align-items-end">
        <div class="col-md-7">
            <h1 class="fw-800 display-5 text-dark mb-0">Berita & Informasi</h1>
            <p class="text-muted lead">Update terkini seputar dunia UMKM dan ekonomi kreatif.</p>
        </div>
        <div class="col-md-5 text-md-end">
            <div class="d-inline-flex gap-2 p-1 bg-light rounded-pill">
                <button class="btn btn-primary rounded-pill px-4">Terbaru</button>
                <button class="btn btn-light rounded-pill px-4">Populer</button>
            </div>
        </div>
    </div>

    <!-- <div class="featured-news-card shadow-lg">
        <img src="https://images.unsplash.com/photo-1542744094-24638eff58bb?w=1200" class="featured-news-img" alt="Main News">
        <div class="featured-news-overlay">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">Kebijakan</span>
            <h2 class="fw-800 display-6 mb-3">Bupati Tangerang Resmikan Program Digitalisasi 1.000 UMKM Lokal</h2>
            <p class="opacity-75 mb-0 w-75 d-none d-md-block">Langkah strategis pemerintah untuk mendorong pelaku usaha kecil agar mampu bersaing di pasar global melalui platform e-commerce dan pembayaran digital.</p>
            <div class="mt-4 d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-2 small"><i data-lucide="calendar" size="16"></i> 02 April 2026</div>
                <div class="d-flex align-items-center gap-2 small"><i data-lucide="user" size="16"></i> Admin RumahSikum</div>
            </div>
        </div>
    </div> -->

    <div class="row g-4">
       
    @foreach ($beritas as $berita)
        <div class="col-md-6 col-lg-4">
            <div class="news-card">
                <div class="news-img-wrapper shadow-sm">
                    <img src="{{ route('showFoto.berita.private', ['path' => $berita->gambar]) }}" class="news-img" alt="News">
                    <!-- <img src="{{ Storage::url($berita->gambar) }}" class="news-img" alt="News"> -->
                </div>
                <span class="category-pill">Tips Bisnis</span>
                <a href="{{ route('frontend.berita.detail', $berita->id) }}" class="text-decoration-none"><h5 class="news-title">{{ $berita->judul }}</h5></a>
                <p class="text-muted small">{!! $berita->deskripsi !!}</p>
                <div class="text-muted smaller d-flex gap-3">
                    <span><i data-lucide="calendar" size="12"></i> {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}</span>
                    <span><i data-lucide="eye" size="12"></i> {{ $berita->views }} Baca</span>
                </div>
            </div>
        </div>
    @endforeach

        <!-- <div class="col-md-6 col-lg-4">
            <div class="news-card">
                <div class="news-img-wrapper shadow-sm">
                    <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?w=600" class="news-img" alt="News">
                </div>
                <span class="category-pill">Event</span>
                <a href="{{ route('frontend.berita.detail') }}" class="text-decoration-none"><h5 class="news-title">Persiapan Bazar Ramadhan 2026 Sudah Mencapai 90%</h5></a>
                <p class="text-muted small">Pendaftaran booth bagi pelaku UMKM kuliner takjil telah dibuka. Segera amankan slot lokasi strategis Anda...</p>
                <div class="text-muted smaller d-flex gap-3">
                    <span><i data-lucide="calendar" size="12"></i> 28 Maret 2026</span>
                    <span><i data-lucide="eye" size="12"></i> 890 Baca</span>
                </div>
            </div>
        </div> -->
    </div>

    <div class="mt-5 d-flex justify-content-center">
        <nav>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link rounded-start-pill px-3" href="#">Prev</a></li>
                <li class="page-item active"><a class="page-link px-3" href="#">1</a></li>
                <li class="page-item"><a class="page-link px-3" href="#">2</a></li>
                <li class="page-item"><a class="page-link rounded-end-pill px-3" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection