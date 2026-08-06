@extends('frontend.main.index')

@section('content')
<div class="container pb-5" style="margin-top: 110px;">
    
    <!-- HEADER CHECKOUT -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-800 text-dark mb-1 d-flex align-items-center gap-2">
                <i data-lucide="credit-card" class="text-primary" size="28"></i> Pengiriman & Pembayaran
            </h4>
            <p class="text-muted small mb-0">Lengkapi alamat pengiriman dan pilih metode pembayaran Anda.</p>
        </div>
        <div>
            <a href="javascript:history.back()" class="btn btn-white border rounded-pill px-3 fw-bold shadow-sm small text-dark d-flex align-items-center gap-1">
                <i data-lucide="arrow-left" size="16"></i> Kembali ke Keranjang
            </a>
        </div>
    </div>

    <form action="{{ route('frontend.checkout.process') }}" method="POST">
        @csrf
        <input type="hidden" name="selected_items" value="{{ $selectedIdsRaw }}">

        <div class="row g-4">
            <!-- KOLOM KIRI: FORM ALAMAT & ITEM PESANAN -->
            <div class="col-lg-8">
                
                @if(!$address)
                    <!-- 1. ALAMAT PENGIRIMAN -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                        <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2 border-bottom pb-3">
                            <i data-lucide="map-pin" class="text-primary" size="20"></i> Alamat Pengiriman
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Nama Penerima</label>
                                <input type="text" name="name" class="form-control form-control-custom" value="{{ Auth::user()->name ?? '' }}" placeholder="Masukkan nama penerima" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Label Alamat</label>
                                <input type="text" name="label_name" class="form-control form-control-custom" value="{{ Auth::user()->label_alamat ?? '' }}" placeholder="Contoh: Rumah, Kantor, dll" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Nomor WhatsApp / HP</label>
                                <input type="tel" name="phone" class="form-control form-control-custom" value="{{ Auth::user()->no_hp ?? '' }}" placeholder="Contoh: 08123456789" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Email</label>
                                <input type="email" name="email" class="form-control form-control-custom" value="{{ Auth::user()->email ?? '' }}" placeholder="Contoh: email@domain.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Alamat Lengkap</label>
                                <textarea name="address" class="form-control form-control-custom" rows="3" placeholder="Nama jalan, RT/RW, nomor rumah, atau patokan lokasi..." required>{{ Auth::user()->alamat ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control form-control-custom bg-light" placeholder="Masukan kecamatan">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Kode Pos</label>
                                <input type="text" name="zip" class="form-control form-control-custom" placeholder="Masukan kode pos">
                            </div>
                            <!-- <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Catatan Pengiriman (Opsional)</label>
                                <input type="text" name="catatan" class="form-control form-control-custom" placeholder="Contoh: Titip di pos satpam">
                            </div> -->
                        </div>
                    </div>
                @else
                 <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2 border-bottom pb-3">
                        <i data-lucide="map-pin" class="text-primary" size="20"></i> Alamat Pengiriman
                    </h6>
                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Alamat Anda</label>
                            <!-- <textarea name="alamat_lengkap" class="form-control form-control-custom" rows="3" placeholder="Nama jalan, RT/RW, nomor rumah, atau patokan lokasi..." required>{{ Auth::user()->alamat ?? '' }}</textarea> -->
                        <div class="form-control form-control-custom bg-light" style="height: auto;" readonly>
                               <p>{{ $address->label_name }} {{ $address->name }}, {{ $address->phone }}</p> 
                               <p>{{ $address->address }}, {{ $address->kecamatan }} {{ $address->zip }}</p>    
                        </div>

                    </div>

                </div>
                   
                @endif

                <!-- 2. DETAIL ITEM YANG DIBELI -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2 border-bottom pb-3">
                        <i data-lucide="package" class="text-primary" size="20"></i> Produk Yang Dipesan ({{ count($cartItems) }})
                    </h6>

                    <div class="checkout-items-list">
                        @foreach($cartItems as $item)
                        <div class="d-flex align-items-center justify-content-between py-3 border-bottom {{ $loop->last ? 'border-0 pb-0' : '' }}">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ route('show.thumbnail.produk.private', $item->produk->produk_thumbnail) }}" 
                                     class="rounded-3 object-fit-cover border" 
                                     width="65" height="65" 
                                     alt="{{ $item->produk->nama_produk }}">
                                <div>
                                    <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1 rounded-2 smaller mb-1 d-inline-block">
                                        <i data-lucide="store" size="10" class="me-1"></i> {{ $item->vendor->nama_toko ?? 'UMKM Lokal' }}
                                    </span>
                                    <h6 class="fw-bold text-dark mb-1 text-truncate" style="max-width: 280px;">{{ $item->produk->nama_produk }}</h6>
                                    <span class="small text-muted">{{ $item->qty }} x Rp {{ number_format($item->produk->harga ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="fw-800 text-dark">
                                    Rp {{ number_format(($item->produk->harga ?? 0) * $item->qty, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. METODE PEMBAYARAN -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-3">
                    <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2 border-bottom pb-3">
                        <i data-lucide="wallet" class="text-primary" size="20"></i> Pilih Metode Pembayaran
                    </h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="payment-option-card w-100 p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer">
                                <input type="radio" name="metode_bayar" value="qris" class="form-check-input my-0" checked>
                                <div>
                                    <span class="fw-bold text-dark d-block mb-0">QRIS / E-Wallet</span>
                                    <span class="smaller text-muted">GoPay, OVO, ShopeePay, Dana</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="payment-option-card w-100 p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer">
                                <input type="radio" name="metode_bayar" value="transfer_bank" class="form-check-input my-0">
                                <div>
                                    <span class="fw-bold text-dark d-block mb-0">Transfer Bank</span>
                                    <span class="smaller text-muted">BCA, Mandiri, BRI, BNI</span>
                                    <!-- <span class="fw-bold text-dark d-block mb-0">Transfer Bank / VA</span>
                                    <span class="smaller text-muted">BCA, Mandiri, BRI, BNI</span> -->
                                </div>
                            </label>
                        </div>
                        <!-- <div class="col-md-6">
                            <label class="payment-option-card w-100 p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer">
                                <input type="radio" name="metode_bayar" value="cod" class="form-check-input my-0">
                                <div>
                                    <span class="fw-bold text-dark d-block mb-0">Bayar di Tempat (COD)</span>
                                    <span class="smaller text-muted">Bayar langsung saat kurir sampai</span>
                                </div>
                            </label>
                        </div> -->
                    </div>
                </div>

                  <!-- 4. METODE PENGIRIMAN -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2 border-bottom pb-3">
                        <i data-lucide="package-check" class="text-primary" size="20"></i> Pilih Metode Pengiriman
                    </h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="payment-option-card w-100 p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer">
                                <input type="radio" name="metode_kirim" value="ditoko" class="form-check-input my-0" checked>
                                <div>
                                    <span class="fw-bold text-dark d-block mb-0">Ambil di Toko</span>
                                    <span class="smaller text-muted">Metode pengiriman yang memungkinkan Anda mengambil pesanan di toko penjual, pada alamat yang tertera pada toko</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="payment-option-card w-100 p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer">
                                <input type="radio" name="metode_kirim" value="dikirim" class="form-check-input my-0">
                                <div>
                                    <span class="fw-bold text-dark d-block mb-0">Dikirim</span>
                                    <span class="smaller text-muted">Metode Pengiriman ini dikirim oleh penjual, namun pembeli dikenakan biaya yang sudah disepakati dengan penjual</span>
                                    <!-- <span class="fw-bold text-dark d-block mb-0">Transfer Bank / VA</span>
                                    <span class="smaller text-muted">BCA, Mandiri, BRI, BNI</span> -->
                                </div>
                            </label>
                        </div>
                        <!-- <div class="col-md-6">
                            <label class="payment-option-card w-100 p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer">
                                <input type="radio" name="metode_bayar" value="cod" class="form-check-input my-0">
                                <div>
                                    <span class="fw-bold text-dark d-block mb-0">Bayar di Tempat (COD)</span>
                                    <span class="smaller text-muted">Bayar langsung saat kurir sampai</span>
                                </div>
                            </label>
                        </div> -->
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN: RINGKASAN & TOMBOL BUAT PESANAN -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 110px;">
                    <h6 class="fw-800 text-dark mb-3 border-bottom pb-3">Ringkasan Pembayaran</h6>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small text-muted">Total Harga Produk</span>
                        <span class="small fw-bold text-dark">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="small text-muted">Biaya Pengiriman</span>
                        <span class="small fw-bold text-dark">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                    </div> -->

                    <hr class="opacity-50 my-3">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="small fw-bold text-dark d-block">Total Tagihan</span>
                            <span class="smaller text-muted">Termasuk PPN jika ada</span>
                        </div>
                        <span class="h5 fw-800 text-primary mb-0">
                            Rp {{ number_format($totalPayment, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <i data-lucide="check-circle" size="18"></i> Buat Pesanan Sekarang
                    </button>

                    <div class="d-flex align-items-center justify-content-center gap-2 mt-3 text-muted">
                        <i data-lucide="shield-check" size="16" class="text-success"></i>
                        <span class="smaller fw-medium">Jaminan Keamanan 100% Transaksi</span>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.72rem; }
    .btn-white { background: white; }

    .bg-primary-subtle {
        background-color: #f3e8ff;
    }

    .form-control-custom {
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        border: 1px solid #e2e8f0;
        font-size: 0.875rem;
    }

    .form-control-custom:focus {
        border-color: #7728a8;
        box-shadow: 0 0 0 3px rgba(119, 40, 168, 0.15);
    }

    .payment-option-card {
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease-in-out;
    }

    .payment-option-card:hover {
        border-color: #7728a8;
        background-color: #fcf8ff;
    }

    .payment-option-card input[type="radio"]:checked + div {
        color: #7728a8;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection