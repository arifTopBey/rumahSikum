@extends('admin.main.main') 
@section('content')

<style>
    body { background-color: #f4f7fe; }
    
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
        text-decoration: none;
    }
    .nav-order .nav-link.active {
        background: #4361ee;
        color: white !important;
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
    .status-pending { background: #fee2e2; color: #dc2626; }
    .status-process { background: #fef3c7; color: #d97706; }
    .status-shipping { background: #e0e7ff; color: #4361ee; }
    .status-done { background: #dcfce7; color: #15803d; }
    .status-cancel { background: #f3f4f6; color: #4b5563; }

    .product-img-order {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 15px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <h4 class="fw-800 mb-4 text-dark">Kelola Pesanan Masuk</h4>

            <!-- FLASH MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <i data-lucide="check-circle" class="me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- TAB FILTER STATUS -->
            <ul class="nav nav-pills nav-order shadow-sm mb-4 d-flex justify-content-between">
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('vendor.orders.index', ['status' => 'semua']) }}" 
                       class="nav-link {{ $status == 'semua' ? 'active' : '' }}">Semua</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('vendor.orders.index', ['status' => 'perlu_dikirim']) }}" 
                       class="nav-link {{ $status == 'perlu_dikirim' ? 'active' : '' }}">Perlu Dikirim</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('vendor.orders.index', ['status' => 'dikirim']) }}" 
                       class="nav-link {{ $status == 'dikirim' ? 'active' : '' }}">Dalam Pengiriman</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('vendor.orders.index', ['status' => 'selesai']) }}" 
                       class="nav-link {{ $status == 'selesai' ? 'active' : '' }}">Selesai</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('vendor.orders.index', ['status' => 'batal']) }}" 
                       class="nav-link {{ $status == 'batal' ? 'active' : '' }}">Dibatalkan</a>
                </li>
            </ul>

            <!-- LIST DAFTAR PESANAN -->
            <div class="tab-content">
                @forelse($orders as $order)
                    <div class="order-card shadow-sm">
                        <!-- HEADER CARD -->
                        <div class="order-header">
                            <div class="d-flex align-items-center gap-3">
                                <i data-lucide="package" class="text-primary"></i>
                                <div>
                                    <span class="small text-muted">No. Invoice: <b>{{ $order->invoice_number }}</b></span>
                                    <p class="small m-0 text-muted">Pembeli: <b>{{ $order->user->name ?? 'Pembeli' }}</b> ({{ $order->user->no_hp ?? '-' }})</p>
                                </div>
                            </div>

                            <!-- BADGE STATUS -->
                            @if($order->payment_status == 'pending')
                                <span class="status-badge status-pending">Menunggu Pembayaran</span>
                            @elseif($order->payment_status == 'waiting_verification')
                                <span class="status-badge status-process">Verifikasi Pembayaran</span>
                            @elseif($order->order_status == 'diproses')
                                <span class="status-badge status-process">Perlu Dikemas / Dikirim</span>
                            @elseif($order->order_status == 'dikirim')
                                <span class="status-badge status-shipping">Sedang Dikirim</span>
                            @elseif($order->order_status == 'selesai')
                                <span class="status-badge status-done">Selesai</span>
                            @elseif($order->order_status == 'batal')
                                <span class="status-badge status-cancel">Batal / Ditolak</span>
                            @endif
                        </div>
                        
                        <!-- BODY CARD (ITEM PRODUK VENDOR) -->
                        <div class="row align-items-center g-3">
                            <div class="col-md-8">
                                @foreach($order->details as $detail)
                                    <div class="d-flex gap-3 align-items-center mb-2">
                                        <img src="{{ route('show.thumbnail.produk.private', $detail->produk->produk_thumbnail) }}" 
                                             class="product-img-order border" 
                                             alt="{{ $detail->produk->nama_produk }}">
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">{{ $detail->produk->nama_produk }}</h6>
                                            <span class="small text-muted">{{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-4 text-end border-start ps-4">
                                <span class="small text-muted d-block">Metode Pengiriman:</span>
                                <span class="badge bg-light text-dark border mb-2 fw-bold">{{ $order->shipping_method == 'ditoko' ? 'Ambil di Toko' : 'Dikirim Kebeli' }}</span>
                                <p class="small text-muted mb-1">Total Nilai Pesanan</p>
                                <h5 class="fw-800 text-primary mb-0">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</h5>
                            </div>
                        </div>

                        <!-- FOOTER CARD (AKSI UPDATE STATUS PENGIRIMAN) -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <span class="small text-muted">Tanggal Order: {{ $order->created_at->format('d M Y, H:i') }} WIB</span>

                            <div class="d-flex gap-2">
                                {{-- Jika Status 'diproses' dan sudah bayar, Munculkan Tombol Kirim Pesanan --}}
                                @if($order->payment_status == 'paid' && $order->order_status == 'diproses')
                                    <form action="{{ route('vendor.orders.update_status', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_status" value="dikirim">
                                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold" onclick="return confirm('Tandai pesanan ini sebagai Selesai Dikemas & Dikirim?')">
                                            <i data-lucide="truck" size="16" class="me-1"></i> Kirim Pesanan
                                        </button>
                                    </form>
                                @elseif($order->order_status == 'selesai')
                                    <!-- <form action="{{ route('vendor.orders.update_status', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_status" value="selesai">
                                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold" onclick="return confirm('Tandai pesanan ini telah Selesai diterima pelanggan?')">
                                            <i data-lucide="check-circle" size="16" class="me-1"></i> Selesaikan Pesanan
                                        </button>
                                    </form> -->
                                    <a href="{{ route('vendors.orders.show', $order->invoice_number) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1">
                                        <i data-lucide="eye" size="14"></i> Detail & Bukti Penerimaan
                                    </a>
                                @endif

                                @if( isset($order->user->no_hp))
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->no_hp) }}" target="_blank" class="btn btn-outline-success rounded-pill px-3 fw-bold">
                                        <i data-lucide="message-circle" size="16"></i> Hubungi Pembeli
                                    </a>
                              
                                    <!-- <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->no_hp) }}" target="_blank" class="btn btn-outline-success rounded-pill px-3 fw-bold">
                                        <i data-lucide="message-circle" size="16"></i> Hubungi Pembeli
                                    </a> -->
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="order-card shadow-sm text-center py-5">
                        <i data-lucide="package-open" size="48" class="text-muted opacity-50 mb-3 mx-auto"></i>
                        <h6 class="fw-bold text-dark mb-1">Belum ada pesanan</h6>
                        <p class="text-muted small mb-0">Tidak ada transaksi pesanan masuk pada filter status ini.</p>
                    </div>
                @endforelse

                <!-- PAGINATION -->
                <div class="mt-4">
                    {{ $orders->appends(['status' => $status])->links() }}
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