@extends('admin.main.main')

@section('content')

<style>
     body { background-color: #f4f7fe; }
    .order-wrapper { margin-top: 120px; margin-bottom: 100px; }

    /* Tab Status Styling */
    .nav-order {
        background: white;
        border-radius: 20px;
        padding: 10px;
        border: 1px solid #edf2f7;
    }
    .nav-order .nav-link {
        border: none;
        color: #64748b;
        font-weight: 700;
        border-radius: 15px;
        padding: 12px 25px;
        transition: 0.3s;
    }
    .nav-order .nav-link.active {
        background: #4361ee;
        color: white;
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
    }

    /* Order Card */
    .order-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        border: 1px solid #edf2f7;
        margin-top: 20px;
        transition: 0.3s;
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 1px dashed #e2e8f0;
        margin-bottom: 15px;
    }

    .status-badge {
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .status-shipping { background: #e0e7ff; color: #4361ee; }
    .status-process { background: #fef3c7; color: #d97706; }
    .status-done { background: #dcfce7; color: #15803d; }

    .product-img-order {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 15px;
    }

    .btn-detail-order {
        background: #f8fafc;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 700;
        font-size: 0.9rem;
    }
    .btn-detail-order:hover { background: #f1f5f9; }
</style>

<div class="container">
    <div class="row justify-content-center mt-3">
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
                <div class="order-card shadow-sm">
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