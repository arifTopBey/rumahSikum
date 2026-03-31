@extends('frontend.main.index')

@section('content')


<div class="container checkout-wrapper">
    <h3 class="fw-800 mb-4">Checkout</h3>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="checkout-card shadow-sm">
                <div class="section-title">
                    <i data-lucide="map-pin" class="text-primary"></i> Alamat Pengiriman
                </div>
                <div class="address-box selected">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary rounded-pill small">Utama</span>
                        <a href="" class="text-primary text-decoration-none small fw-bold">Ganti Alamat</a>
                    </div>
                    <h6 class="fw-bold mb-1">Budi Santoso (Rumah)</h6>
                    <p class="text-muted small mb-0">0812-3456-7890</p>
                    <p class="text-muted small mt-2 mb-0">Jl. Raya Tigaraksa No. 12, Kel. Tigaraksa, Kec. Tigaraksa, Kabupaten Tangerang, 15720</p>
                </div>
            </div>

            <div class="checkout-card shadow-sm">
                <div class="section-title">
                    <i data-lucide="package" class="text-primary"></i> Produk yang Dipesan
                </div>
                
                <div class="product-mini">
                    <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?w=200">
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-0">Sepatu Batik Tangerang</h6>
                        <p class="small text-muted">Ukuran: 42 | 1 Barang</p>
                        <p class="fw-bold text-dark mb-0">Rp 245.000</p>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="fw-bold small mb-2 d-block">Pilih Pengiriman:</label>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="shipping-option">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold small">Reguler (JNE/J&T)</span>
                                    <span class="fw-bold text-primary">Rp 12.000</span>
                                </div>
                                <span class="text-muted smaller">Estimasi 2-3 Hari</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shipping-option">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold small">Sameday (Grab/Gojek)</span>
                                    <span class="fw-bold text-primary">Rp 25.000</span>
                                </div>
                                <span class="text-muted smaller">Tiba Hari Ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-card shadow-sm">
                <div class="section-title">
                    <i data-lucide="credit-card" class="text-primary"></i> Metode Pembayaran
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="shipping-option text-center p-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" height="15" class="mb-2 d-block mx-auto">
                            <span class="small fw-bold">BCA Transfer</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shipping-option text-center p-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/BRI_Logo.svg" height="15" class="mb-2 d-block mx-auto">
                            <span class="small fw-bold">BRI Transfer</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shipping-option text-center p-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" height="15" class="mb-2 d-block mx-auto">
                            <span class="small fw-bold">DANA / QRIS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="summary-card shadow-sm">
                <h5 class="fw-800 mb-4">Ringkasan Bayar</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Harga (1 Barang)</span>
                    <span class="fw-bold">Rp 245.000</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Biaya Pengiriman</span>
                    <span class="fw-bold">Rp 12.000</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Biaya Layanan</span>
                    <span class="fw-bold">Rp 1.000</span>
                </div>
                <hr class="my-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fw-bold fs-5">Total Tagihan</span>
                    <span class="fw-800 fs-4 text-primary">Rp 258.000</span>
                </div>

                <button class="btn-pay shadow">
                    Bayar Sekarang <i data-lucide="chevron-right" class="ms-1" size="18"></i>
                </button>
                
                <p class="text-center mt-3 text-muted smaller">
                    Dengan menekan tombol, Anda menyetujui <a href="#" class="text-decoration-none">Syarat & Ketentuan</a> RumahSikum.
                </p>
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