@extends('frontend.main.index')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-800 {
        font-weight: 800;
    }

    .smaller {
        font-size: 0.72rem;
        letter-spacing: 0.05rem;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #7728a8 0%, #a82282 100%);
    }

    .bg-gradient-secondary {
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
    }

    .category-modern-card {
        border-radius: 16px;
        background: white;
        transition: all 0.2s ease;
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-card {
        background: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-img {
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.06);
    }

    .wishlist-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
        background: white;
        color: #64748b;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .wishlist-btn:hover {
        color: #ef4444;
        background: #fee2e2;
    }

    .badge-location {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        color: #1e293b;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
    }

    .price-text {
        font-size: 1.1rem;
    }

    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.06) !important;
    }

    .page-link {
        color: #475569;
        padding: 10px 16px;
    }

    .page-item.active .page-link {
        background-color: #7728a8;
    }

    .filter-sidebar .form-control,
    .filter-sidebar .form-select {
        border-color: #f1f5f9;
        padding: 10px 12px;
        font-size: 0.85rem;
    }

    .filter-sidebar .form-control:focus,
    .filter-sidebar .form-select:focus {
        background-color: #fff;
        border-color: #7728a8;
        box-shadow: none;
    }

    .filter-sidebar .input-group-text {
        padding-left: 12px;
    }

    .filter-sidebar input[type=number]::-webkit-inner-spin-button,
    .filter-sidebar input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .remove-wishlist-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 10;
        background: white;
        color: #64748b;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .remove-wishlist-btn:hover {
        color: #ffffff;
        background: #ef4444;
    }
</style>
<div id="promoCarousel" class="carousel slide shadow-sm mb-5" data-bs-ride="carousel" style="margin-top: 90px;">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1"></button>
    </div>
    <div class="carousel-inner rounded-4 container">
        <div class="carousel-item active" data-bs-interval="4000">
            <div class="slider-bg-wrapper bg-gradient-primary d-flex align-items-center px-5 rounded-4" style="height: 380px;">
                <div class="row w-100 align-items-center">
                    <div class="col-md-6 text-white animate-fade-in">
                        <span class="badge bg-white text-primary mb-2 fw-bold text-uppercase px-3 py-2 rounded-pill smaller">Gebyar UMKM Lokal</span>
                        <h2 class="display-6 fw-800 mb-3">Produk Otentik Unggulan Daerah</h2>
                        <p class="opacity-75 mb-4 small">Dukung pertumbuhan ekonomi kreatif lokal dengan membeli karya terbaik dari pengrajin terpercaya.</p>
                        <a href="#katalog-section" class="btn btn-light text-primary rounded-pill px-4 fw-bold shadow">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <div class="slider-bg-wrapper bg-gradient-secondary d-flex align-items-center px-5 rounded-4" style="height: 380px;">
                <div class="row w-100 align-items-center">
                    <div class="col-md-6 text-white">
                        <span class="badge bg-warning text-dark mb-2 fw-bold text-uppercase px-3 py-2 rounded-pill smaller">Diskon Terbatas</span>
                        <h2 class="display-6 fw-800 mb-3">Nikmati Cita Rasa Kuliner Pilihan</h2>
                        <p class="opacity-75 mb-4 small">Dapatkan promo gratis ongkir khusus untuk produk panganan khas bersertifikasi halal minggu ini.</p>
                        <a href="#katalog-section" class="btn btn-warning text-dark rounded-pill px-4 fw-bold shadow">Ambil Promo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TELUSURI KATEGORI -->
<div class="container mb-5">
    <h5 class="fw-800 text-dark mb-4 d-flex align-items-center gap-2">
        <i data-lucide="layout-grid" class="text-primary" size="20"></i> Telusuri Kategori
    </h5>
    <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-6">
        @foreach($categories as $cat)
        <div class="col">
            <!-- Menghubungkan klik kategori ke filter eCommerce -->
            <a href="{{ request()->fullUrlWithQuery(['kategori' => $cat->id]) }}#katalog-section" class="text-decoration-none">
                <div class="card category-modern-card border-0 text-center p-3 h-100 shadow-sm transition-hover {{ request('kategori') == $cat->id ? 'border border-primary border-2' : '' }}">
                    <div class="icon-circle mx-auto mb-2" style="background-color: rgba(99, 102, 241, 0.1); color: #6366f1;">
                        <img src="{{ route('show.thumbnail.produk.private', $cat->icon) }}" alt="" style="width: 22px; height: 22px;">
                    </div>
                    <span class="small fw-bold text-dark">{{ $cat->name }}</span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="container pb-5" id="katalog-section">
    <div class="row g-4">

        <!-- SIDEBAR FILTER -->
        <aside class="col-lg-3 d-none d-lg-block">
            <div class="filter-sidebar shadow-sm border-0 p-4 bg-white rounded-4 sticky-top" style="top: 110px;">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-2">
                    <h6 class="fw-800 text-dark mb-0 text-uppercase smaller tracking-wide">Filter Pencarian</h6>
                    <!-- Reset Filter -->
                    <a href="{{ url()->current() }}#katalog-section" class="text-decoration-none smaller fw-bold text-muted">Reset</a>
                </div>

                <!-- Form Filter dikirim ke URL yang sama via GET -->
                <form id="filterForm" action="{{ url()->current() }}#katalog-section" method="GET">

                    <!-- Keep nilai sorting jika ada -->
                    <input type="hidden" name="sort" value="{{ request('sort', 'terbaru') }}">

                    <!-- Filter Nama Produk -->
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Cari Produk</label>
                        <div class="input-group border-2 rounded-3 overflow-hidden bg-light">
                            <span class="input-group-text bg-light border-0 pe-1">
                                <i data-lucide="search" size="16" class="text-muted"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0 bg-light small" placeholder="Nama produk atau keyword...">
                        </div>
                    </div>

                    <!-- Filter Kategori -->
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Kategori</label>
                        <select name="kategori" class="form-select border-2 bg-light rounded-3 small fw-medium text-dark">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Kecamatan -->
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Wilayah Kecamatan</label>
                        <select name="kecamatan" class="form-select border-2 bg-light rounded-3 small fw-medium text-dark">
                            <option value="">Semua Kecamatan</option>
                            <option value="Tigaraksa" {{ request('kecamatan') == 'Tigaraksa' ? 'selected' : '' }}>Tigaraksa</option>
                            <option value="Cikupa" {{ request('kecamatan') == 'Cikupa' ? 'selected' : '' }}>Cikupa</option>
                            <option value="Kelapa Dua" {{ request('kecamatan') == 'Kelapa Dua' ? 'selected' : '' }}>Kelapa Dua</option>
                        </select>
                    </div>

                    <!-- Filter Harga -->
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2">Filter Harga (Rp)</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="harga_min" value="{{ request('harga_min') }}" class="form-control border-2 bg-light rounded-3 small" placeholder="Min">
                            </div>
                            <div class="col-6">
                                <input type="number" name="harga_max" value="{{ request('harga_max') }}" class="form-control border-2 bg-light rounded-3 small" placeholder="Maks">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-2 shadow-sm mt-2">
                        <i data-lucide="sliders-horizontal" size="14" class="me-2"></i> Terapkan Filter
                    </button>
                </form>
            </div>
        </aside>

        <!-- LIST PRODUK -->
        <div class="col-lg-9">
            <div class="market-toolbar d-flex justify-content-between align-items-center gap-3 bg-white p-3 rounded-4 shadow-sm mb-4">
                <span class="text-muted small fw-medium">
                    Menampilkan <span class="text-dark fw-bold">{{ $produks->firstItem() ?? 0 }}-{{ $produks->lastItem() ?? 0 }}</span> dari {{ $produks->total() }} produk
                </span>

                <!-- Dropdown Sorting -->
                <select id="sortSelect" onchange="applySort(this.value)" class="form-select border-0 bg-light rounded-3 small fw-bold text-muted" style="width: auto;">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                    <option value="harga_low" {{ request('sort') == 'harga_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="harga_high" {{ request('sort') == 'harga_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                </select>
            </div>

            <div class="row g-4">
                @forelse ($produks as $produk)
                <div class="col-md-4 col-sm-6">
                    <div class="card product-card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative transition-hover">
                        <a href="{{ route('frontend.eCommerce.detail', $produk->id) }}" class="text-decoration-none text-dark">
                            <div class="product-img-wrapper position-relative overflow-hidden">
                                <img src="{{ route('show.thumbnail.produk.private', $produk->produk_thumbnail) }}"
                                    class="w-100 product-img" alt="{{ $produk->nama_produk }}" style="height: 220px; object-fit: cover;">
                                <span class="badge-location position-absolute bottom-0 start-0 m-3">
                                    <i data-lucide="map-pin" size="12" class="me-1"></i>{{ $produk->vendor->kecamatan ?? 'Tangerang' }}
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <p class="smaller text-muted text-uppercase fw-bold mb-1">{{ $produk->nama_produk }}</p>
                                <h6 class="fw-bold text-dark text-truncate mb-2">{!! strip_tags($produk->produk_deskripsi) !!}</h6>
                                <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3">
                                    <div>
                                        <span class="smaller text-muted d-block">Harga</span>
                                        <span class="price-text fw-800 text-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    </div>

                                    <form action="{{ route('frontend.cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $produk->id }}" name="produk_id">
                                        <button class="btn btn-primary rounded-3 p-2 shadow-sm" title="Tambah ke Keranjang">
                                            <i data-lucide="shopping-cart" size="16"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i data-lucide="package-x" size="48" class="text-muted mb-3 opacity-50"></i>
                    <h6 class="fw-bold text-muted">Produk tidak ditemukan</h6>
                    <p class="small text-muted mb-0">Coba ubah kata kunci atau kata filter Anda.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $produks->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    // Fungsi untuk memperbarui parameter 'sort' di URL dan melakukan submit/reload
    function applySort(sortValue) {
        let url = new URL(window.location.href);
        url.searchParams.set('sort', sortValue);
        url.hash = 'katalog-section';
        window.location.href = url.toString();
    }
</script>
@endsection