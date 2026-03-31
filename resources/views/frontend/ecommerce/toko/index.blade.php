@extends('frontend.main.index')

@section('content')
@push('styles')
<style>
    :root {
        --primary-blue: #4361ee;
        --soft-bg: #f8fafc;
    }

    body { background-color: var(--soft-bg); }

    /* Header Profil Toko */
    .shop-header {
        margin-top: 100px;
        background: white;
        border-radius: 30px;
        overflow: hidden;
        border: 1px solid #edf2f7;
    }
    
    .shop-banner {
        height: 200px;
        background: linear-gradient(45deg, #4361ee, #4cc9f0);
        position: relative;
    }

    .shop-profile-content {
        padding: 0 40px 40px 40px;
        margin-top: -60px;
        position: relative;
    }

    .shop-logo-container {
        width: 120px;
        height: 120px;
        background: white;
        padding: 5px;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .shop-logo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }

    /* Statistik Toko */
    .shop-stat {
        display: flex;
        gap: 30px;
        margin-top: 20px;
        padding: 20px 0;
        border-top: 1px solid #f1f5f9;
    }

    .stat-item { text-align: center; }
    .stat-value { font-weight: 800; font-size: 1.1rem; display: block; color: #1e293b; }
    .stat-label { font-size: 0.8rem; color: #64748b; }

    /* Product Card Modern */
    .product-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        transition: 0.3s;
        height: 100%;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }
    .product-img {
        height: 200px;
        object-fit: cover;
        border-radius: 20px 20px 0 0;
    }
    .price-text {
        font-weight: 800;
        color: var(--primary-blue);
        font-size: 1.1rem;
    }

    /* Filter Sidebar */
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #f1f5f9;
        position: sticky;
        top: 100px;
    }
</style>
@endpush

<div class="container mb-5">
    <div class="shop-header shadow-sm mb-5">
        <div class="shop-banner d-flex align-items-center justify-content-center">
            <h2 class="text-white opacity-25 fw-800">Cintailah Produk Lokal</h2>
        </div>
        <div class="shop-profile-content">
            <div class="d-md-flex align-items-end justify-content-between">
                <div class="d-md-flex align-items-end gap-4">
                    <div class="shop-logo-container">
                        <img src="https://i.pravatar.cc/150?u=umkm1" alt="Logo UMKM">
                    </div>
                    <div class="mt-3 mt-md-0">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="fw-800 m-0">UMKM Batik Tangerang Sejahtera</h3>
                            <i data-lucide="check-circle" class="text-primary" size="20"></i>
                        </div>
                        <p class="text-muted m-0"><i data-lucide="map-pin" size="14"></i> Tigaraksa, Kabupaten Tangerang</p>
                    </div>
                </div>
                <div class="mt-4 mt-md-0 d-flex gap-2">
                    <a href="https://wa.me/628123456789" class="btn btn-success rounded-pill px-4 fw-bold">
                        <i data-lucide="message-circle" class="me-2" size="18"></i> Hubungi Penjual
                    </a>
                    <button class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                        <i data-lucide="share-2" size="18"></i>
                    </button>
                </div>
            </div>

            <div class="shop-stat mt-4">
                <div class="stat-item">
                    <span class="stat-value">4.9</span>
                    <span class="stat-label">Rating Toko</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">150+</span>
                    <span class="stat-label">Produk Terjual</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">24</span>
                    <span class="stat-label">Total Produk</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">15 Menit</span>
                    <span class="stat-label">Respon Chat</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="filter-card">
                <h6 class="fw-800 mb-3">Kategori Produk</h6>
                <div class="list-group list-group-flush small">
                    <a href="#" class="list-group-item list-group-item-action border-0 px-0 fw-bold text-primary">Semua Produk</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 px-0">Pakaian Pria</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 px-0">Pakaian Wanita</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 px-0">Aksesoris Batik</a>
                </div>
                <hr>
                <h6 class="fw-800 mb-3">Urutkan</h6>
                <select class="form-select border-0 bg-light rounded-3">
                    <option>Terbaru</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                </select>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-800 m-0">Katalog Produk Toko</h5>
                <p class="text-muted small m-0">Menampilkan 24 Produk</p>
            </div>
            
            <div class="row g-3">
                @for($i=1; $i<=6; $i++)
                <div class="col-md-4 col-6">
                    <div class="product-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?w=400" class="product-img w-100" alt="Produk">
                        <div class="p-3">
                            <span class="text-muted smaller">Fashion</span>
                            <h6 class="fw-bold text-dark mt-1 text-truncate">Sepatu Batik Premium v{{ $i }}</h6>
                            <p class="price-text mb-2">Rp 245.000</p>
                            <div class="d-flex align-items-center gap-1 text-warning small mb-3">
                                <i data-lucide="star" fill="currentColor" size="12"></i>
                                <span class="text-muted smaller fw-bold">4.8 | Terjual 20+</span>
                            </div>
                            <button class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-bold">Detail Produk</button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <div class="mt-5 d-flex justify-content-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link rounded-start-pill" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link rounded-end-pill" href="#">Next</a></li>
                    </ul>
                </nav>
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