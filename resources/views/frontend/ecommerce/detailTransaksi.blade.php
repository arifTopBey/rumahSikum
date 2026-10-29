@extends('frontend.main.index')

@section('content')

<div class="container detail-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="" class="btn btn-light rounded-circle p-2 shadow-sm">
                    <i data-lucide="arrow-left" size="20"></i>
                </a>
                <h3 class="fw-800 m-0">Detail Transaksi</h3>
            </div>

            <div class="card-detail shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <span class="info-label">Nomor Invoice</span>
                        <h5 class="fw-800 text-primary mb-0">INV/20260330/RS/8821</h5>
                        <p class="text-muted small">Dibeli pada 30 Mar 2026, 14:20 WIB</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold">Sedang Dikirim</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="card-detail shadow-sm">
                        <h6 class="fw-800 mb-3">Daftar Produk</h6>
                        <div class="product-row">
                            <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?w=200">
                            <div class="flex-grow-1">
                                <p class="info-value mb-0">Sepatu Batik Tangerang Premium</p>
                                <span class="small text-muted">1 Barang x Rp 245.000</span>
                            </div>
                            <div class="text-end">
                                <p class="info-value mb-0">Rp 245.000</p>
                            </div>
                        </div>
                        <div class="product-row">
                            <img src="https://images.unsplash.com/photo-1544473244-f6895a69ad41?w=200">
                            <div class="flex-grow-1">
                                <p class="info-value mb-0">Kopi Arabika Mix</p>
                                <span class="small text-muted">2 Barang x Rp 45.000</span>
                            </div>
                            <div class="text-end">
                                <p class="info-value mb-0">Rp 90.000</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-detail shadow-sm">
                        <h6 class="fw-800 mb-4">Informasi Pengiriman</h6>
                        <div class="mb-4">
                            <span class="info-label">Kurir & No. Resi</span>
                            <div class="d-flex align-items-center gap-2">
                                <p class="info-value mb-0">J&T Express - JP882910221</p>
                                <button class="btn btn-sm btn-light py-0 px-2 text-primary fw-bold" style="font-size: 10px;">SALIN</button>
                            </div>
                        </div>
                        <div class="mb-0">
                            <span class="info-label">Alamat Pengiriman</span>
                            <p class="info-value mb-1">Budi Santoso</p>
                            <p class="small text-muted mb-0">Jl. Raya Tigaraksa No. 12, Kec. Tigaraksa, Kabupaten Tangerang, 15720 (0812-3456-7890)</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card-detail shadow-sm">
                        <h6 class="fw-800 mb-4">Status Pesanan</h6>
                        <div class="timeline-wrapper">
                            <div class="timeline-item active">
                                <p class="info-value mb-0 small">Pesanan Sedang Dikirim</p>
                                <span class="smaller text-muted">31 Mar 2026, 10:00 WIB</span>
                            </div>
                            <div class="timeline-item">
                                <p class="info-value mb-0 small">Pesanan Diproses Penjual</p>
                                <span class="smaller text-muted">30 Mar 2026, 16:00 WIB</span>
                            </div>
                            <div class="timeline-item">
                                <p class="info-value mb-0 small">Pembayaran Terverifikasi</p>
                                <span class="smaller text-muted">30 Mar 2026, 14:25 WIB</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-detail shadow-sm">
                        <h6 class="fw-800 mb-4">Rincian Pembayaran</h6>
                        <div class="payment-summary-row">
                            <span class="text-muted">Metode Pembayaran</span>
                            <span class="fw-bold">BCA Transfer</span>
                        </div>
                        <hr class="my-3 opacity-50">
                        <div class="payment-summary-row">
                            <span class="text-muted">Total Harga</span>
                            <span>Rp 335.000</span>
                        </div>
                        <div class="payment-summary-row">
                            <span class="text-muted">Total Ongkos Kirim</span>
                            <span>Rp 15.000</span>
                        </div>
                        <div class="payment-summary-row">
                            <span class="text-muted">Diskon Voucher</span>
                            <span class="text-success">- Rp 10.000</span>
                        </div>
                        <div class="payment-summary-row mt-3">
                            <span class="fw-800 fs-5">Total Bayar</span>
                            <span class="fw-800 fs-5 text-primary">Rp 340.000</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary rounded-pill fw-bold py-2 shadow-sm">Bantuan</button>
                        <button class="btn btn-primary rounded-pill fw-bold py-2 shadow">Cetak Invoice</button>
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