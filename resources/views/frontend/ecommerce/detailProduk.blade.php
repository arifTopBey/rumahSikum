@extends('frontend.main.index')

@section('content')
@push('styles')
<style>
    body { background-color: #f8fafc; }
    
    /* Product Gallery */
    .main-img-container {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #edf2f7;
    }
    .thumb-img {
        width: 80px; height: 80px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: 0.3s;
    }
    .thumb-img:hover, .thumb-img.active { border-color: #0d6efd; opacity: 0.8; }

    /* Product Info */
    .product-sticky-top { position: sticky; top: 100px; }
    .badge-umkm {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        font-weight: 700;
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
    }
    .price-tag { font-size: 2.5rem; font-weight: 800; color: #1e293b; }

    /* Action Buttons */
    .btn-cart {
        border-radius: 15px;
        padding: 15px;
        font-weight: 700;
        transition: 0.3s;
    }
    .btn-wa {
        background-color: #25d366;
        color: white;
        border: none;
    }
    .btn-wa:hover { background-color: #128c7e; color: white; transform: translateY(-3px); }

    /* Tabs Styling */
    .nav-tabs-custom .nav-link {
        border: none;
        color: #64748b;
        font-weight: 600;
        padding: 15px 25px;
    }
    .nav-tabs-custom .nav-link.active {
        color: #0d6efd;
        border-bottom: 3px solid #0d6efd;
        background: none;
    }

    /* Seller Card */
    .seller-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #edf2f7;
    }
</style>
@endpush

<div class="container mb-5" style="margin-top: 120px;">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Marketplace</a></li>
            <li class="breadcrumb-item active">Detail Produk</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-6">
            <div class="main-img-container mb-3 shadow-sm text-center p-2">
                <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?auto=format&fit=crop&w=800&q=80" id="mainImg" class="img-fluid rounded-4" alt="Product Image">
            </div>
            <div class="d-flex gap-2 overflow-auto pb-2">
                <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?auto=format&fit=crop&w=200&q=80" class="thumb-img active" onclick="changeImg(this.src)">
                <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?auto=format&fit=crop&w=200&q=80" class="thumb-img active" onclick="changeImg(this.src)">
                <img src="https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?auto=format&fit=crop&w=200&q=80" class="thumb-img" onclick="changeImg(this.src)">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="product-sticky-top">
                <div class="mb-2">
                    <span class="badge-umkm">Produk Unggulan Tangerang</span>
                </div>
                <h1 class="fw-800 text-dark mb-1">Sepatu Motif Batik Premium Tangerang</h1>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="text-warning">
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star-half" fill="currentColor" size="18"></i>
                    </div>
                    <span class="text-muted small">(42 Ulasan Pelanggan)</span>
                </div>

                <div class="mb-4">
                    <h2 class="price-tag mb-0">Rp 245.000</h2>
                    <p class="text-success small fw-bold"><i data-lucide="check-circle" size="14"></i> Stok Tersedia</p>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Pilih Ukuran:</label>
                    <div class="d-flex gap-2">
                        @foreach(['39', '40', '41', '42'] as $size)
                        <button class="btn btn-outline-secondary rounded-3 px-3">{{ $size }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="row g-2 mb-5">
                    <div class="col-md-8">
                        <a href="https://wa.me/628123456789" target="_blank" class="btn btn-wa btn-cart w-100 d-flex align-items-center justify-content-center">
                            <!-- <i data-lucide="message-circle" class="me-2"></i> Tanya Penjual (WhatsApp) -->
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-primary btn-cart w-100">
                            <i data-lucide="shopping-cart"></i>
                        </button>
                    </div>
                </div>

                <div class="seller-card d-flex align-items-center shadow-sm">
                    <img src="https://i.pravatar.cc/100?u=umkm1" class="rounded-circle me-3" width="60" alt="UMKM Logo">
                    <div>
                        <h6 class="fw-bold mb-0">UMKM Batik Tangerang Sejahtera</h6>
                        <p class="text-muted small mb-1"><i data-lucide="map-pin" size="12"></i> Kec. Kelapa Dua, Tangerang</p>
<<<<<<< HEAD
                        <a href="{{ route('frontend.toko') }}" class="text-primary text-decoration-none fw-bold small">Kunjungi Toko &rarr;</a>
=======
                        <a href="#" class="text-primary text-decoration-none fw-bold small">Kunjungi Toko &rarr;</a>
>>>>>>> 501705a6b2991e5e8265c1a4070acd87d8b9c04a
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-5">
        <ul class="nav nav-tabs nav-tabs-custom mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">Deskripsi Produk</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#spec">Informasi Tambahan</button>
            </li>
        </ul>
        <div class="tab-content bg-white p-4 rounded-4 shadow-sm border">
            <div class="tab-pane fade show active" id="desc">
                <p class="text-muted lh-lg">
                    Sepatu batik ini merupakan perpaduan antara kenyamanan modern dan warisan budaya lokal Kabupaten Tangerang. Dibuat dengan bahan kanvas berkualitas tinggi dan motif batik tulis khas Tangerang yang eksklusif.<br><br>
                    - Bahan: Kanvas Premium & Batik Tulis<br>
                    - Insole: Empuk & Nyaman dipakai seharian<br>
                    - Outsole: Karet Anti Selip<br>
                    - Cocok untuk acara formal maupun casual.
                </p>
            </div>
            <div class="tab-pane fade" id="spec">
                <table class="table table-borderless">
                    <tr><td class="fw-bold text-muted" width="200">Berat</td><td>500 Gram</td></tr>
                    <tr><td class="fw-bold text-muted">Dimensi</td><td>30 x 15 x 10 cm</td></tr>
                    <tr><td class="fw-bold text-muted">Metode Kirim</td><td>JNE, J&T, Sicepat, Grab/Gojek</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeImg(src) {
        document.getElementById('mainImg').src = src;
        // Logic untuk ganti class active pada thumbnail bisa ditambahkan di sini
    }
    
    lucide.createIcons();
</script>
@endpush
@endsection