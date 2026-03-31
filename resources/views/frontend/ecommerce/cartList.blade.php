@extends('frontend.main.index')

@section('content')
@push('styles')
<style>
    body { background-color: #f8fafc; }
    
    .cart-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        overflow: hidden;
    }

    .cart-item {
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        transition: 0.3s;
    }
    .cart-item:last-child { border-bottom: none; }
    .cart-item:hover { background-color: #fcfdfe; }

    .product-img-cart {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 15px;
    }

    /* Quantity Toggle */
    .qty-input {
        display: flex;
        align-items: center;
        background: #f1f5f9;
        border-radius: 10px;
        width: fit-content;
        padding: 5px;
    }
    .btn-qty {
        background: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: 0.2s;
    }
    .btn-qty:hover { background: var(--bs-primary); color: white; }

    /* Summary Card */
    .summary-card {
        background: white;
        border-radius: 24px;
        padding: 25px;
        border: 1px solid #edf2f7;
        position: sticky;
        top: 100px;
    }

    .promo-code {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 15px;
        background: #f8fafc;
    }
</style>
@endpush

<div class="container mb-5 " style="margin-top: 120px;">
    <h3 class="fw-800 mb-4">Keranjang Belanja <span class="text-muted fw-normal fs-5">(3 Produk)</span></h3>

    <div class="row g-4">
        <div class="col-lg-8 shadow px-2 py-2">
            <div class="cart-card shadow-sm px-3 py-2">
                <div class="d-none d-md-flex p-3 bg-light border-bottom small fw-bold text-muted">
                    <div class="col-6">PRODUK</div>
                    <div class="col-3 text-center">JUMLAH</div>
                    <div class="col-3 text-end">SUBTOTAL</div>
                </div>

                <div class="cart-item mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-12 mb-3 mb-md-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                                <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?auto=format&fit=crop&w=200&q=80" class="product-img-cart rounded-3" alt="Produk">
                                <div>
                                    <h6 class="fw-bold mb-1">Sepatu Motif Batik Premium</h6>
                                    <p class="small text-muted mb-0">Ukuran: 42</p>
                                    <button class="btn btn-link p-0 text-danger text-decoration-none small mt-2">
                                        <i data-lucide="trash-2" size="14"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 d-flex justify-content-center">
                            <div class="qty-input">
                                <button class="btn-qty"><i data-lucide="minus" size="14"></i></button>
                                <span class="px-3 fw-bold">1</span>
                                <button class="btn-qty"><i data-lucide="plus" size="14"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 text-end">
                            <span class="fw-800 text-dark">Rp 245.000</span>
                        </div>
                    </div>
                </div>

                <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-12 mb-3 mb-md-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                                <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?auto=format&fit=crop&w=200&q=80" class="product-img-cart rounded-3" alt="Produk">
                                <div>
                                    <h6 class="fw-bold mb-1">Kopi Arabika Robusta Mix</h6>
                                    <p class="small text-muted mb-0">Berat: 250gr</p>
                                    <button class="btn btn-link p-0 text-danger text-decoration-none small mt-2">
                                        <i data-lucide="trash-2" size="14"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 d-flex justify-content-center">
                            <div class="qty-input">
                                <button class="btn-qty"><i data-lucide="minus" size="14"></i></button>
                                <span class="px-3 fw-bold">2</span>
                                <button class="btn-qty"><i data-lucide="plus" size="14"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 text-end">
                            <span class="fw-800 text-dark">Rp 90.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <a href="#" class="btn btn-link text-decoration-none mt-4 ps-0">
                <i data-lucide="arrow-left" size="18"></i> Lanjut Belanja
            </a>
        </div>

        <div class="col-lg-4 px-2 py-2 shadow rounded-2">
            <div class="summary-card px-2 py-2">
                <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>
                
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Harga (3 Barang)</span>
                    <span>Rp 335.000</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Diskon</span>
                    <span class="text-success">- Rp 15.000</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted">Biaya Pengiriman</span>
                    <span class="text-muted small italic text-end">Akan dihitung di tahap berikutnya</span>
                </div>

                <hr class="mb-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fw-bold fs-5">Total Bayar</span>
                    <span class="fw-800 fs-4 text-primary">Rp 320.000</span>
                </div>
<!-- 
                <div class="promo-code mb-4">
                    <label class="small fw-bold text-muted mb-2 d-block">Punya Kode Promo?</label>
                    <div class="input-group">
                        <input type="text" class="form-control border-0 bg-transparent" placeholder="KODEPROMO">
                        <button class="btn btn-primary rounded-3 px-3">Pakai</button>
                    </div>
                </div> -->

<<<<<<< HEAD
                <a href="{{ route('frontend.checkout') }}" class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm mb-3">
                    Checkout Sekarang
                </a>
=======
                <button class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm mb-3">
                    Checkout Sekarang
                </button>
>>>>>>> 501705a6b2991e5e8265c1a4070acd87d8b9c04a
                
                <div class="text-center">
                    <small class="text-muted"><i data-lucide="shield-check" size="14"></i> Pembayaran Aman & Terverifikasi</small>
                </div>
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