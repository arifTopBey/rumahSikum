@extends('admin.main.main') 

@section('content')

<style>
    body { background-color: #f4f7fe; }

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

    .btn-back {
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
    .btn-back:hover { background: #f8fafc; color: #1e293b; }

    .proof-img {
        max-height: 280px;
        width: 100%;
        object-fit: contain;
        border-radius: 15px;
        background: #f8fafc;
    }

    .info-box {
        background: #f8fafc;
        border-radius: 15px;
        padding: 15px 20px;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11">

            <!-- HEADER / BACK BUTTON -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('vendor.orders.index') }}" class="btn-back shadow-sm">
                    <i data-lucide="arrow-left" size="16"></i> Kembali ke Daftar Pesanan
                </a>

                <!-- BADGE STATUS -->
                @if($order->payment_status == 'pending')
                    <span class="status-badge status-pending">Menunggu Pembayaran</span>
                @elseif($order->payment_status == 'waiting_verification')
                    <span class="status-badge status-process">Verifikasi Pembayaran</span>
                @elseif($order->order_status == 'diproses')
                    <span class="status-badge status-process">Sedang Dikemas</span>
                @elseif($order->order_status == 'dikirim')
                    <span class="status-badge status-shipping">Sedang Dikirim</span>
                @elseif($order->order_status == 'selesai')
                    <span class="status-badge status-done">Pesanan Selesai</span>
                @elseif($order->order_status == 'batal')
                    <span class="status-badge status-cancel">Pesanan Dibatalkan</span>
                @endif
            </div>

            <div class="row g-4">

                <!-- KOLOM KIRI: BUKTI PENERIMAAN BARANG & BUKTI BAYAR -->
                <div class="col-lg-6">

                    <!-- CARD BUKTI PENERIMAAN BARANG -->
                    <div class="detail-card shadow-sm border-start border-4 border-success">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-800 text-dark mb-0 d-flex align-items-center gap-2">
                                <i data-lucide="package-check" class="text-success"></i> Bukti Penerimaan Barang
                            </h6>
                            @if($order->received_at)
                                <span class="badge bg-success-subtle text-success border border-success fw-bold px-2 py-1 rounded-2 smaller">
                                    Diterima {{ \Carbon\Carbon::parse($order->received_at)->translatedFormat('d M Y, H:i') }}
                                </span>
                            @endif
                        </div>

                        @if($order->bukti_penerimaan)
                            <div class="text-center">
                                <a href="{{ route('show.thumbnail.produk.private', $order->bukti_penerimaan) }}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="{{ route('show.thumbnail.produk.private', $order->bukti_penerimaan) }}" class="proof-img border p-2 mb-2 shadow-sm" alt="Bukti Penerimaan Barang">
                                    <!-- <img src="{{ asset('storage/' . $order->bukti_penerimaan) }}" class="proof-img border p-2 mb-2 shadow-sm" alt="Bukti Penerimaan Barang"> -->
                                </a>
                                <p class="small text-muted mb-0">Klik pada foto untuk melihat gambar ukuran penuh dalam tab baru.</p>
                            </div>
                        @else
                            <div class="info-box text-center py-4">
                                <i data-lucide="image-off" size="36" class="text-muted opacity-50 mb-2"></i>
                                <p class="small text-muted mb-0">Pembeli belum/tidak mengunggah foto bukti penerimaan barang.</p>
                            </div>
                        @endif
                    </div>

                    <!-- CARD BUKTI PEMBAYARAN -->
                    <div class="detail-card shadow-sm">
                        <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2">
                            <i data-lucide="receipt" class="text-primary"></i> Bukti Pembayaran Transfer
                        </h6>

                        @if($order->bukti_pembayaran)
                            <div class="text-center">
                                <a href="{{ asset('storage/' . $order->bukti_pembayaran) }}" target="_blank" title="Klik untuk memperbesar">
                                    <!-- <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" class="proof-img border p-2 mb-2 shadow-sm" alt="Bukti Transfer Pembeli"> -->
                                    <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" class="proof-img border p-2 mb-2 shadow-sm" alt="Bukti Transfer Pembeli">
                                </a>
                                <p class="small text-muted mb-0">Metode Bayar: <b class="text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</b></p>
                            </div>
                        @else
                            <div class="info-box text-center py-4">
                                <p class="small text-muted mb-0">Bukti pembayaran belum diunggah.</p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- KOLOM KANAN: RINCIAN PESANAN & PEMBELI -->
                <div class="col-lg-6">

                    <!-- RINCIAN TRANSAKSI -->
                    <div class="detail-card shadow-sm">
                        <div class="border-bottom pb-3 mb-3">
                            <span class="small text-muted d-block">No. Invoice</span>
                            <h5 class="fw-800 text-primary mb-1">{{ $order->invoice_number }}</h5>
                            <span class="small text-muted">{{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                        </div>

                        <!-- PRODUK YANG DIPESAN -->
                        <h6 class="fw-800 text-dark mb-3">Produk Dipesan</h6>
                        <div class="d-flex flex-column gap-3 mb-4">
                            @foreach($order->details as $detail)
                                <div class="d-flex align-items-center justify-content-between py-2 border-bottom {{ $loop->last ? 'border-0 pb-0' : '' }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ route('show.thumbnail.produk.private', $detail->produk->produk_thumbnail) }}" 
                                             class="product-img-detail border" 
                                             alt="{{ $detail->produk->nama_produk }}">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1 text-truncate" style="max-width: 220px;">{{ $detail->produk->nama_produk }}</h6>
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

                        <hr class="opacity-50 my-3">

                        <!-- TOTAL PEMBAYARAN -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small text-muted">Subtotal Produk</span>
                            <span class="small fw-bold text-dark">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small text-muted">Ongkos Kirim</span>
                            <span class="small fw-bold text-dark">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="fw-800 text-dark">Total Transaksi</span>
                            <h5 class="fw-800 text-primary mb-0">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</h5>
                        </div>
                    </div>

                    <!-- INFORMASI PEMBELI & PENGIRIMAN -->
                    <div class="detail-card shadow-sm">
                        <h6 class="fw-800 text-dark mb-3">Informasi Pembeli & Pengiriman</h6>
                        
                        <div class="info-box mb-3">
                            <!-- <p class="smaller text-muted fw-bold d-block text-uppercase mb-1">Nomor Telepon:</p> -->
                            <span class="smaller text-muted fw-bold d-block text-uppercase mb-1">Nama Pembeli:</span>
                            <h6 class="fw-bold text-dark mb-1 small mt-1 ms-2 d-block">{{ $order->user->name ?? 'Pembeli' }}</h6><br>
                           
                             <!-- <h6 class="fw-bold text-dark mb-1 small mt-1 ms-2">{{ $order->user->no_hp ?? '-' }}</h6> -->
                            <!-- <p class="text-muted small mb-0"><br><i data-lucide="phone" size="12" class="me-1"></i> {{ $order->user->no_hp ?? '-' }}</p> -->
                        </div>
                        <div class="info-box mb-3">
                            <p class="smaller text-muted fw-bold d-block text-uppercase mb-1">Nomor Telepon:</p>
                           
                             <h6 class="fw-bold text-dark mb-1 small mt-1 ms-2">{{ $order->user->address->first()->phone ?? '-' }}</h6>
                            <!-- <p class="text-muted small mb-0"><br><i data-lucide="phone" size="12" class="me-1"></i> {{ $order->user->no_hp ?? '-' }}</p> -->
                        </div>

                        <div class="info-box mb-3">
                            <span class="smaller text-muted fw-bold d-block text-uppercase mb-1">Metode & Alamat Pengiriman:</span>
                            <p class="text-muted small mb-0">{{ $order->user->address->first()->address ?? 'Alamat pengiriman tidak diisi.' }}</p>
                            <span class="badge bg-light text-dark border fw-bold px-2 py-1 rounded-2 smaller mb-2 d-inline-block">
                            {{ $order->shipping_method == 'ditoko' ? 'Ambil Sendiri di Toko' : 'Dikirim Kebeli' }}
                            </span>
                        </div>

                        @if($order->user && isset($order->user->no_hp))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->no_hp) }}?text=Halo%20{{ urlencode($order->user->name) }},%20mengenai%20pesanan%20{{ $order->invoice_number }}" 
                               target="_blank" 
                               class="btn btn-outline-success w-100 rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i data-lucide="message-circle" size="16"></i> Hubungi Pembeli via WhatsApp
                            </a>
                        @endif
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