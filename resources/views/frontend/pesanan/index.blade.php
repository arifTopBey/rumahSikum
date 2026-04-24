@extends('frontend.main.index')

@section('content')

<div class="container order-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="fw-800 mb-4">Pesanan Saya</h3>

            <ul class="nav nav-pills nav-order shadow-sm mb-4 d-flex justify-content-between" id="pills-tab" role="tablist">
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link active w-100" data-bs-toggle="pill">Semua</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" data-bs-toggle="pill">Belum Bayar</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" data-bs-toggle="pill">Dikemas</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" data-bs-toggle="pill">Dikirim</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" data-bs-toggle="pill">Selesai</button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- <div class="order-card shadow-sm">
                    <div class="order-header">
                        <div class="d-flex align-items-center gap-3">
                            <i data-lucide="shopping-bag" class="text-primary"></i>
                            <div>
                                <span class="small text-muted">No. Pesanan: <b>INV/20240328/RS/001</b></span>
                                <p class="small m-0 text-muted">28 Maret 2024</p>
                            </div>
                        </div>
                        <span class="status-badge status-shipping">Sedang Dikirim</span>
                    </div>
                    
                    <div class="d-flex gap-4">
                        <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?w=200" class="product-img-order" alt="Product">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Sepatu Batik Tangerang Premium</h6>
                            <p class="small text-muted mb-0">1 Barang x Rp 245.000</p>
                            <p class="small text-muted">+ 1 produk lainnya</p>
                        </div>
                        <div class="text-end border-start ps-4">
                            <p class="small text-muted mb-1">Total Belanja</p>
                            <h5 class="fw-800 text-dark">Rp 335.000</h5>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('frontend.transaksi.detail') }}" class="btn-detail-order">Detail Transaksi</a>
                        <button class="btn btn-primary rounded-pill px-4 fw-bold">Lacak Paket</button>
                    </div>
                </div>

                <div class="order-card shadow-sm">
                    <div class="order-header">
                        <div class="d-flex align-items-center gap-3">
                            <i data-lucide="shopping-bag" class="text-muted"></i>
                            <div>
                                <span class="small text-muted">No. Pesanan: <b>INV/20240315/RS/098</b></span>
                                <p class="small m-0 text-muted">15 Maret 2024</p>
                            </div>
                        </div>
                        <span class="status-badge status-done">Selesai</span>
                    </div>
                    
                    <div class="d-flex gap-4">
                        <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?w=200" class="product-img-order" alt="Product">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Kopi Arabika Mix Robusta</h6>
                            <p class="small text-muted mb-0">2 Barang x Rp 45.000</p>
                        </div>
                        <div class="text-end border-start ps-4">
                            <p class="small text-muted mb-1">Total Belanja</p>
                            <h5 class="fw-800 text-dark">Rp 90.000</h5>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button class="btn-detail-order">Beli Lagi</button>
                        <a href="{{ route('frontend.ulasan') }}" class="btn btn-outline-warning rounded-pill px-4 fw-bold">Beri Ulasan</a>
                    </div>
                </div>

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