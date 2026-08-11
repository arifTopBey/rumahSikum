@extends('admin.main.main')

@section('content')

<style>
    body { background-color: #f4f7fe; }
    .order-wrapper { margin-top: 60px; margin-bottom: 100px; }

    .detail-card {
        background: white;
        border-radius: 25px;
        padding: 30px;
        border: 1px solid #edf2f7;
        margin-bottom: 25px;
    }

    .status-badge {
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .status-pending { background: #fee2e2; color: #dc2626; }
    .status-process { background: #fef3c7; color: #d97706; }
    .status-shipping { background: #e0e7ff; color: #4361ee; }
    .status-done { background: #dcfce7; color: #15803d; }
    .status-cancel { background: #f3f4f6; color: #4b5563; }

    .product-img-detail {
        width: 75px;
        height: 75px;
        object-fit: cover;
        border-radius: 15px;
    }

    .btn-back-order {
        background: white;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 18px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back-order:hover { background: #f8fafc; color: #1e293b; }

    .info-box {
        background: #f8fafc;
        border-radius: 15px;
        padding: 15px 20px;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="container order-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <!-- HEADER / BACK BUTTON -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('user.orders.index') }}" class="btn-back-order shadow-sm">
                    <i data-lucide="arrow-left" size="16"></i> Kembali ke Pesanan Saya
                </a>

                <!-- BADGE STATUS -->
                @if($order->payment_status == 'pending')
                    <span class="status-badge status-pending">Belum Bayar</span>
                @elseif($order->payment_status == 'waiting_verification')
                    <span class="status-badge status-process">Menunggu Konfirmasi Penjual</span>
                @elseif($order->order_status == 'diproses')
                    <span class="status-badge status-process">Sedang Dikemas</span>
                @elseif($order->order_status == 'dikirim')
                    <span class="status-badge status-shipping">Sedang Dikirim</span>
                @elseif($order->order_status == 'selesai')
                    <span class="status-badge status-done">Selesai</span>
                @elseif($order->order_status == 'batal')
                    <span class="status-badge status-cancel">Pesanan Dibatalkan</span>
                @endif
            </div>

            <div class="row g-4">
                <!-- KOLOM KIRI: RINCIAN ITEM & PENGIRIMAN -->
                <div class="col-lg-7">

                    <!-- INFORMASI INVOICE & PROSES -->
                    <div class="detail-card shadow-sm">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <div>
                                <span class="small text-muted d-block">No. Invoice</span>
                                <h6 class="fw-800 text-dark mb-0">{{ $order->invoice_number }}</h6>
                            </div>
                            <div class="text-end">
                                <span class="small text-muted d-block">Tanggal Transaksi</span>
                                <span class="small fw-bold text-dark">{{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                            </div>
                        </div>

                        <!-- RINCIAN PRODUK -->
                        <h6 class="fw-800 text-dark mb-3">Produk Dipesan ({{ $order->details->count() }})</h6>
                        <div class="d-flex flex-column gap-3">
                            @foreach($order->details as $detail)
                                <div class="d-flex align-items-center justify-content-between py-2 border-bottom {{ $loop->last ? 'border-0 pb-0' : '' }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ route('show.thumbnail.produk.private', $detail->produk->produk_thumbnail) }}" 
                                             class="product-img-detail border" 
                                             alt="{{ $detail->produk->nama_produk }}">
                                        <div>
                                            <span class="badge bg-light text-primary border fw-bold px-2 py-1 rounded-2 smaller mb-1 d-inline-block">
                                                <i data-lucide="store" size="10" class="me-1"></i> {{ $detail->vendor->nama_toko ?? 'UMKM' }}
                                            </span>
                                            <h6 class="fw-bold text-dark mb-1 text-truncate" style="max-width: 260px;">{{ $detail->produk->nama_produk }}</h6>
                                            <span class="small text-muted">{{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-800 text-dark">
                                            Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- INFORMASI ALAMAT & PENGIRIMAN -->
                    <div class="detail-card shadow-sm">
                        <h6 class="fw-800 text-dark mb-3">Informasi Pengiriman</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <span class="small text-muted d-block mb-1">Metode Pengiriman</span>
                                <span class="badge bg-light text-dark border fw-bold px-3 py-2 rounded-3 small">
                                    <i data-lucide="truck" size="14" class="text-primary me-1"></i> 
                                    {{ $order->shipping_method == 'ditoko' ? 'Ambil Sendiri di Toko' : 'Dikirim Ke Alamat' }}
                                </span>
                            </div>
                            <div class="col-md-6">
                                <span class="small text-muted d-block mb-1">Metode Pembayaran</span>
                                <span class="fw-bold text-dark text-uppercase small">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                            </div>
                            <div class="col-12 pt-2">
                                <span class="small text-muted d-block mb-1">Alamat Penerima</span>
                                <div class="info-box">
                                    <h6 class="fw-bold text-dark mb-1 small">{{ $order->user->name ?? 'Pembeli' }} ({{ $order->user->no_hp ?? '-' }})</h6>
                                    <p class="text-muted small mb-0">{{ $order->user->alamat ?? 'Alamat pengiriman belum diisi.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BUKTI PEMBAYARAN -->
                    <div class="detail-card shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-800 text-dark mb-0">Bukti Pembayaran</h6>
                            @if(!$order->bukti_pembayaran && $order->payment_status == 'pending')
                                <a href="{{ route('frontend.payment.instruction', $order->invoice_number) }}" class="btn btn-sm btn-warning fw-bold rounded-pill px-3">
                                    Upload Bukti
                                </a>
                            @endif
                        </div>

                        @if($order->bukti_pembayaran)
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('show.thumbnail.produk.private', $order->bukti_pembayaran) }}" target="_blank">
                                    <img src="{{ route('show.thumbnail.produk.private', $order->bukti_pembayaran) }}" class="rounded-3 border" style="width: 100px; height: 100px; object-fit: cover;">
                                </a>
                                <div>
                                    <span class="badge bg-success-subtle text-success border border-success fw-bold px-2 py-1 rounded-2 smaller mb-1">Sudah Diunggah</span>
                                    <p class="small text-muted mb-0">Klik pada gambar untuk melihat bukti transfer dalam ukuran penuh.</p>
                                </div>
                            </div>
                        @else
                            <div class="info-box text-center py-3">
                                <p class="small text-muted mb-0">Anda belum mengunggah foto bukti pembayaran.</p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- KOLOM KANAN: RINGKASAN TAGIHAN & AKSI -->
                <div class="col-lg-5">
                    <div class="detail-card shadow-sm sticky-top" style="top: 110px;">
                        <h6 class="fw-800 text-dark mb-3 border-bottom pb-3">Ringkasan Pembayaran</h6>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small text-muted">Subtotal Produk</span>
                            <span class="small fw-bold text-dark">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small text-muted">Ongkos Kirim</span>
                            <span class="small fw-bold text-dark">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>

                        <hr class="opacity-50 my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-800 text-dark">Total Pembayaran</span>
                            <h5 class="fw-800 text-primary mb-0">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</h5>
                        </div>

                        <!-- TOMBOL AKSI BERDASARKAN STATUS -->
                        <div class="d-grid gap-2">
                            @if($order->payment_status == 'pending')
                                <a href="{{ route('frontend.payment.instruction', $order->invoice_number) }}" class="btn btn-warning rounded-pill py-2 fw-bold text-dark">
                                    <i data-lucide="upload-cloud" size="16" class="me-1"></i> Bayar & Upload Bukti
                                </a>
                            @elseif($order->order_status == 'dikirim')
                                <button class="btn btn-primary rounded-pill py-2 fw-bold">
                                    <i data-lucide="truck" size="16" class="me-1"></i> Lacak Pengiriman
                                </button>
                            @elseif($order->order_status == 'selesai')
                                @if($order->review->first()->order_id == $order->id)
                                    <button class="btn btn-outline-warning rounded-pill py-2 fw-bold" disabled>
                                        <i data-lucide="star-check" size="16" class="me-1"></i> Ulasan Sudah Diberikan
                                    </button>
                                @else
                                    <a href="{{ route('frontend.ulasan', [$order->id, $order->details->first()->produk_id]) ?? '#' }}" class="btn btn-outline-warning rounded-pill py-2 fw-bold">
                                        <i data-lucide="star" size="16" class="me-1"></i> Beri Ulasan Produk
                                    </a>
                                @endif
                            @endif

                            @php
                                $vendor = $order->details->first()->vendor ?? null;
                            @endphp
                            @if($vendor && isset($vendor->no_hp))
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $vendor->no_hp) }}?text=Halo%20{{ urlencode($vendor->nama_toko) }},%20saya%20inik%20menanyakan%20status%20order%20{{ $order->invoice_number }}" 
                                   target="_blank" 
                                   class="btn btn-outline-success rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                    <i data-lucide="message-circle" size="16"></i> Hubungi Penjual
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endpush