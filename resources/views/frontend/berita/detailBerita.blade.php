@extends('frontend.main.index')

@section('content')

<div class="container news-detail-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/berita" class="text-decoration-none">Berita</a></li>
                    <li class="breadcrumb-item active">Kebijakan</li>
                </ol>
            </nav>

            <header class="article-header">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">Kebijakan</span>
                <h1 class="mb-3">{{ $berita->judul }}</h1>
                
                <div class="article-meta d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-2"><i data-lucide="user" size="16"></i> Admin RumahSikum</div>
                    <div class="d-flex align-items-center gap-2"><i data-lucide="calendar" size="16"></i> {{ $berita->created_at->translatedFormat('d F Y') }}</div>
                    <!-- <div class="d-flex align-items-center gap-2"><i data-lucide="message-square" size="16"></i> 12 Komentar</div> -->
                </div>
            </header>

            <div class="featured-img-frame">
                <img src="{{ route('showFoto.berita.private', $berita->gambar) }}" class="w-100" alt="News Image">
            </div>

            <article class="article-body">
                {!! $berita->deskripsi !!}
            </article>

            <!-- <div class="d-flex align-items-center justify-content-between mt-5 pt-4 border-top">
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-bold small text-muted">Bagikan:</span>
                    <a href="#" class="share-btn"><i data-lucide="facebook" size="18"></i></a>
                    <a href="#" class="share-btn"><i data-lucide="instagram" size="18"></i></a>
                    <a href="#" class="share-btn"><i data-lucide="link" size="18"></i></a>
                </div>
                <div class="text-muted small">
                    <i data-lucide="tag" size="14"></i> UMKM, Digitalisasi, Tangerang
                </div>
            </div> -->
        </div>

        <div class="col-lg-4 ps-lg-5">
            <div class="widget-card shadow-sm mt-5 mt-lg-0">
                <h5 class="fw-800 mb-4">Berita Terpopuler</h5>
                
                <a href="#" class="popular-item">
                    <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=100" class="popular-img">
                    <div>
                        <h6 class="popular-title">Produk Kriya Tangerang Tembus Pasar Eropa</h6>
                        <span class="smaller text-muted">2 Jam yang lalu</span>
                    </div>
                </a>

                <a href="#" class="popular-item">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=100" class="popular-img">
                    <div>
                        <h6 class="popular-title">Tips Branding Murah untuk UMKM Baru</h6>
                        <span class="smaller text-muted">5 Jam yang lalu</span>
                    </div>
                </a>

                <a href="#" class="popular-item">
                    <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?w=100" class="popular-img">
                    <div>
                        <h6 class="popular-title">Persiapan Bazar Ramadhan Capai 90%</h6>
                        <span class="smaller text-muted">1 Hari yang lalu</span>
                    </div>
                </a>
            </div>
            <!-- <div class="bg-primary rounded-4 p-4 text-white text-center shadow-lg">
                <i data-lucide="trending-up" size="50" class="mb-3 opacity-50"></i>
                <h5 class="fw-bold">Ingin Produk Anda Masuk Berita?</h5>
                <p class="small opacity-75 mb-4">Daftarkan kisah sukses usaha Anda untuk kami liput secara gratis!</p>
                <button class="btn btn-white bg-white text-primary rounded-pill w-100 fw-bold">Hubungi Redaksi</button>
            </div> -->
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection