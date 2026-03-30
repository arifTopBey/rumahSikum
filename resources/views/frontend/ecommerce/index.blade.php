@extends('frontend.main.index')

@section('content')
    <main class="container shadow-none" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="row g-4">

            <aside class="col-lg-3 d-none d-lg-block">
                <div class="filter-sidebar shadow-sm">
                    <h5 class="fw-bold mb-4">Filter Produk</h5>

                    <div class="mb-4">
                        <label class="fw-semibold mb-2">Kategori</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="cat1" checked>
                            <label class="form-check-label small" for="cat1">Kuliner & Makanan</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="cat2">
                            <label class="form-check-label small" for="cat2">Fashion & Aksesoris</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="cat3">
                            <label class="form-check-label small" for="cat3">Kerajinan Tangan</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold mb-2">Kecamatan</label>
                        <select class="form-select form-select-sm border-0 bg-light">
                            <option>Semua Kecamatan</option>
                            <option>Tigaraksa</option>
                            <option>Cikupa</option>
                            <option>Kelapa Dua</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold mb-2">Rentang Harga</label>
                        <input type="range" class="form-range" min="0" max="1000000">
                        <div class="d-flex justify-content-between small text-muted">
                            <span>Rp 0</span>
                            <span>Rp 1jt+</span>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 rounded-pill">Terapkan Filter</button>
                </div>
            </aside>

            <div class="col-lg-9">

                <div class="market-toolbar d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted small">Menampilkan 1-12 dari 240 produk</span>
                    </div>
                    <div class="d-flex gap-2">
                        <select class="form-select border-0 bg-light rounded-pill px-3" style="width: auto;">
                            <option>Terbaru</option>
                            <option>Harga Terendah</option>
                            <option>Paling Laris</option>
                        </select>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4 col-sm-6">
                    <a href="{{ route('frontend.eCommerce.detail') }}" class="text-decoration-none">
                        <div class="card product-card shadow-sm h-100">
                            <button class="wishlist-btn"><i data-lucide="heart" size="18"></i></button>
                            <div class="product-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?auto=format&fit=crop&w=500&q=80"
                                    class="card-img-top product-img" alt="Sepatu Batik">
                            </div>
                            <div class="card-body pt-0 px-4 pb-4">
                                <div class="mb-2">
                                    <span class="badge-location"><i data-lucide="map-pin" size="10" class="me-1"></i>Kelapa
                                        Dua</span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Sepatu Motif Batik Tangerang</h6>
                                <p class="small text-muted mb-3">Langkah Kreatif UMKM</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-text">Rp 245.000</span>
                                    <button class="btn btn-outline-primary btn-sm rounded-circle"><i
                                            data-lucide="shopping-cart" size="16"></i></button>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="card product-card shadow-sm h-100">
                            <button class="wishlist-btn"><i data-lucide="heart" size="18"></i></button>
                            <div class="product-img-wrapper">
                                <img src="https://plus.unsplash.com/premium_photo-1723478443774-19ead8ee7ce2?q=80&w=500&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="card-img-top product-img" alt="Kopi">
                            </div>
                            <div class="card-body pt-0 px-4 pb-4">
                                <div class="mb-2">
                                    <span class="badge-location"><i data-lucide="map-pin" size="10"
                                            class="me-1"></i>Tigaraksa</span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Kopi Arabika Robusta Mix</h6>
                                <p class="small text-muted mb-3">Kopi Cap Benteng</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-text">Rp 45.000</span>
                                    <button class="btn btn-outline-primary btn-sm rounded-circle"><i
                                            data-lucide="shopping-cart" size="16"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="card product-card shadow-sm h-100">
                            <button class="wishlist-btn"><i data-lucide="heart" size="18"></i></button>
                            <div class="product-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?auto=format&fit=crop&w=500&q=80"
                                    class="card-img-top product-img" alt="Produk">
                            </div>
                            <div class="card-body pt-0 px-4 pb-4">
                                <div class="mb-2">
                                    <span class="badge-location"><i data-lucide="map-pin" size="10"
                                            class="me-1"></i>Cikupa</span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Tas Anyaman Modern Eco</h6>
                                <p class="small text-muted mb-3">Handmade Craft</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-text">Rp 120.000</span>
                                    <button class="btn btn-outline-primary btn-sm rounded-circle"><i
                                            data-lucide="shopping-cart" size="16"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link shadow-sm" href="#"><i
                                    data-lucide="chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link shadow-sm" href="#">1</a></li>
                        <li class="page-item"><a class="page-link shadow-sm" href="#">2</a></li>
                        <li class="page-item"><a class="page-link shadow-sm" href="#">3</a></li>
                        <li class="page-item"><a class="page-link shadow-sm" href="#"><i
                                    data-lucide="chevron-right"></i></a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </main>
@endsection