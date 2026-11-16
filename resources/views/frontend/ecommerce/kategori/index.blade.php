
@extends('frontend.main.index')

@section('content')
<div class="container pb-5" style="margin-top: 110px;">
    
    <div class="card border-0 rounded-4 bg-gradient-category text-white p-4 p-md-5 mb-4 shadow-sm">
        <div class="d-flex align-items-center gap-4">
            <div class="icon-box-big bg-white bg-opacity-20 rounded-4 d-none d-sm-flex">
                <i data-lucide="utensils" size="40"></i> 
            </div>
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 smaller text-white-50">
                        <li class="breadcrumb-item"><a href="#" class="text-white opacity-75 text-decoration-none">E-Commerce</a></li>
                        <li class="breadcrumb-item active text-white fw-bold">Kategori</li>
                    </ol>
                </nav>
                <h2 class="fw-800 mb-1">Kuliner & Makanan Khas</h2> <p class="mb-0 small opacity-75">Menampilkan produk panganan otentik berkualitas dari para pelaku UMKM terbaik.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
        <form action="#" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group border-2 rounded-3 overflow-hidden bg-light">
                    <span class="input-group-text bg-light border-0 pe-1"><i data-lucide="search" size="16" class="text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-light small text-dark" placeholder="Cari di kategori ini...">
                </div>
            </div>

            <div class="col-md-3">
                <select name="kecamatan" class="form-select border-2 bg-light rounded-3 small fw-semibold text-muted">
                    <option value="">Semua Kecamatan</option>
                    <option value="tigaraksa">Tigaraksa</option>
                    <option value="cikupa">Cikupa</option>
                    <option value="kelapa-dua">Kelapa Dua</option>
                </select>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <input type="number" name="harga_min" class="form-control border-2 bg-light rounded-3 small text-center" placeholder="Harga Min">
                    <span class="input-group-text bg-transparent border-0 small text-muted">-</span>
                    <input type="number" name="harga_max" class="form-control border-2 bg-light rounded-3 small text-center" placeholder="Harga Maks">
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-2 small shadow-sm">
                    <i data-lucide="sliders-horizontal" size="14" class="me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <span class="text-muted small fw-medium">Menampilkan <span class="text-dark fw-bold">1-12</span> dari 84 Produk Kuliner</span>
        <select class="form-select border-0 bg-transparent small fw-bold text-muted p-0" style="width: auto; cursor: pointer;">
            <option>Urutan: Paling Sesuai</option>
            <option>Harga: Terendah</option>
            <option>Harga: Tertinggi</option>
            <option>Produk Terbaru</option>
        </select>
    </div>

    <div class="row g-4">
        <div class="col-md-3 col-sm-6"> <div class="card product-card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative transition-hover">
                <button class="wishlist-btn border-0 shadow-sm" title="Tambah ke Wishlist"><i data-lucide="heart" size="16"></i></button>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="product-img-wrapper position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500&auto=format&fit=crop"
                            class="w-100 product-img" alt="Kripik" style="height: 200px; object-fit: cover;">
                        <span class="badge-location position-absolute bottom-0 start-0 m-3"><i data-lucide="map-pin" size="12" class="me-1"></i>Cikupa</span>
                    </div>
                    <div class="card-body p-3">
                        <p class="smaller text-muted text-uppercase fw-bold mb-1">Snack Jaya Mandiri</p>
                        <h6 class="fw-bold text-dark text-truncate mb-2">Keripik Pisang Lumer Cokelat</h6>
                        <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-2">
                            <div>
                                <span class="smaller text-muted d-block">Harga</span>
                                <span class="price-text fw-800 text-primary">Rp 18.000</span>
                            </div>
                            <button class="btn btn-primary rounded-3 p-2 shadow-sm">
                                <i data-lucide="shopping-cart" size="16"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        </div>

    <nav class="mt-5">
        <ul class="pagination justify-content-center gap-2">
            <li class="page-item disabled"><a class="page-link border-0 rounded-3 shadow-sm" href="#"><i data-lucide="chevron-left" size="18"></i></a></li>
            <li class="page-item active"><a class="page-link border-0 rounded-3 shadow-sm" href="#">1</a></li>
            <li class="page-item"><a class="page-link border-0 rounded-3 shadow-sm" href="#">2</a></li>
            <li class="page-item"><a class="page-link border-0 rounded-3 shadow-sm" href="#"><i data-lucide="chevron-right" size="18"></i></a></li>
        </ul>
    </nav>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.72rem; letter-spacing: 0.05rem; }

    /* Banner Gradasi Kategori (Bisa kamu buat dinamis warnanya nanti) */
    .bg-gradient-category { background: linear-gradient(135deg, #7728a8 0%, #a82282 100%); }

    .icon-box-big {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Style Form Filter */
    .card .form-control, .card .form-select {
        border-color: #f1f5f9;
        font-size: 0.85rem;
        padding: 10px;
    }
    .card .form-control:focus, .card .form-select:focus {
        background-color: #fff;
        border-color: #7728a8;
        box-shadow: none;
    }

    /* Hilangkan tombol spinner input number */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }

    /* Animasi Hover Kartu Produk */
    .product-card { background: white; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .product-img { transition: transform 0.5s ease; }
    .product-card:hover .product-img { transform: scale(1.06); }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 12px 20px rgba(0,0,0,0.06) !important; }

    /* Tombol Wishlist */
    .wishlist-btn {
        position: absolute; top: 12px; right: 12px; z-index: 10;
        background: white; color: #64748b; width: 32px; height: 32px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .wishlist-btn:hover { color: #ef4444; background: #fee2e2; }

    /* Badge Wilayah */
    .badge-location {
        background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(4px);
        color: #1e293b; padding: 4px 10px; border-radius: 6px;
        font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center;
    }

    .price-text { font-size: 1rem; }
    .page-link { color: #475569; padding: 10px 16px; }
    .page-item.active .page-link { background-color: #7728a8; }
</style>

<script>
    lucide.createIcons();
</script>
@endsection