@extends('frontend.main.index')

@section('content')
<div class="container pb-5" style="margin-top: 110px;">
    
    <!-- HEADER KERANJANG -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-800 text-dark mb-1 d-flex align-items-center gap-2">
                <i data-lucide="shopping-bag" class="text-primary" size="28"></i> Keranjang Belanja
            </h4>
            <p class="text-muted small mb-0">Kelola item produk unggulan UMKM yang ingin Anda beli.</p>
        </div>
        <div>
            <a href="{{ route('frontend.eCommerce') }}" class="btn btn-white border rounded-pill px-3 fw-bold shadow-sm small text-dark d-flex align-items-center gap-1">
                <i data-lucide="arrow-left" size="16"></i> Lanjut Belanja
            </a>
        </div>
    </div>

    @if(isset($carts) && count($carts) > 0)
    <div class="row g-4">
        <!-- LIST ITEM KERANJANG (KOLOM KIRI) -->
        <div class="col-lg-8">
            
            <!-- TOOLBAR KONTROL SELURUH ITEM -->
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="form-check d-flex align-items-center mb-0">
                        <input class="form-check-input custom-checkbox me-2" type="checkbox" id="selectAll">
                        <label class="form-check-label small fw-bold text-dark cursor-pointer" for="selectAll">
                            Pilih Semua Item (<span id="total-selected-count">0</span>)
                        </label>
                    </div>
                    <!-- <button type="button" class="btn btn-link text-danger text-decoration-none p-0 border-0 small fw-bold d-flex align-items-center gap-1 opacity-75 hover-opacity-100" id="btnDeleteSelected">
                        <i data-lucide="trash-2" size="16"></i> Hapus Terpilih
                    </button> -->
                </div>
            </div>

            @foreach($carts as $item)
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-3 cart-item-card transition-hover">
                <!-- HEADER VENDOR -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <!-- DI SINI PERBAIKANNYA: data-price diganti dari $item->harga ke $item->produk->harga -->
                        <input class="form-check-input custom-checkbox item-checkbox" type="checkbox" name="cart_ids[]" value="{{ $item->id }}" data-price="{{ $item->produk->harga ?? 0 }}" data-qty="{{ $item->qty }}">
                        <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1 rounded-2 smaller">
                            <i data-lucide="store" size="12" class="me-1"></i> {{ $item->vendor->nama_toko ?? 'UMKM Lokal' }}
                        </span>
                        <span class="badge-location-sm"><i data-lucide="map-pin" size="11" class="me-1"></i>{{ $item->vendor->kecamatan ?? 'Tigaraksa' }}</span>
                    </div>
                    
                    <form action="{{ route('frontend.cart.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove-item border-0 bg-transparent text-muted p-1" title="Hapus Produk">
                            <i data-lucide="x" size="18"></i>
                        </button>
                    </form>
                </div>

                <!-- BODY DETAIL PRODUK -->
                <div class="row align-items-center g-3">
                    <div class="col-3 col-md-2">
                        <div class="product-img-wrapper rounded-3 overflow-hidden position-relative">
                            <img src="{{ route('show.thumbnail.produk.private', $item->produk->produk_thumbnail) }}" 
                                 class="w-100 object-fit-cover" 
                                 alt="{{ $item->produk->nama_produk }}" 
                                 style="height: 85px; width: 85px;">
                        </div>
                    </div>
                    <div class="col-9 col-md-5">
                        <span class="smaller text-muted text-uppercase fw-bold d-block mb-1">{{ $item->produk->kategori->nama ?? 'Produk' }}</span>
                        <h6 class="fw-bold text-dark text-truncate mb-1">{{ $item->produk->nama_produk }}</h6>
                        <span class="price-text fw-800 text-primary d-block">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-between justify-content-md-end gap-3 mt-3 mt-md-0">
                        <!-- QUANTITY COUNTER -->
                        <div class="quantity-counter d-flex align-items-center border rounded-3 p-1 bg-light">
                            <button type="button" class="btn btn-sm btn-counter border-0 p-1 d-flex align-items-center justify-content-center btn-minus" data-id="{{ $item->id }}">
                                <i data-lucide="minus" size="14"></i>
                            </button>
                            <input type="number" class="form-control border-0 bg-transparent text-center fw-bold small p-0 item-qty" value="{{ $item->qty }}" min="1" readonly style="width: 40px;">
                            <button type="button" class="btn btn-sm btn-counter border-0 p-1 d-flex align-items-center justify-content-center btn-plus" data-id="{{ $item->id }}">
                                <i data-lucide="plus" size="14"></i>
                            </button>
                        </div>
                        
                        <!-- TOTAL SUB HARGA PER ITEM -->
                        <div class="text-end" style="min-width: 100px;">
                            <span class="smaller text-muted d-block">Subtotal</span>
                            <span class="fw-800 text-dark subtotal-item-text" id="subtotal-item-{{ $item->id }}">
                                Rp {{ number_format(($item->produk->harga ?? 0) * $item->qty, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- RINGKASAN BELANJA / CHECKOUT CARD (KOLOM KANAN) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 110px;">
                <h6 class="fw-800 text-dark mb-3 border-bottom pb-3">Ringkasan Belanja</h6>
                
                <!-- DETAIL HARGA -->
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Total Harga (<span id="summary-qty">0</span> barang)</span>
                    <span class="small fw-bold text-dark" id="summary-raw-price">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="small text-muted">Estimasi Biaya Transaksi</span>
                    <span class="small fw-bold text-success">Gratis</span>
                </div>

                <hr class="opacity-50 my-3">

                <!-- TOTAL AKHIR -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="small fw-bold text-dark d-block">Total Pembayaran</span>
                        <span class="smaller text-muted">Belum termasuk ongkos kirim</span>
                    </div>
                    <span class="h5 fw-800 text-primary mb-0" id="summary-total-price">Rp 0</span>
                </div>

                <!-- FORM PEMBAYARAN / CHECKOUT -->
                <form action="{{ route('frontend.checkout.index') }}" method="GET" id="checkoutForm">
                    <input type="hidden" name="selected_items" id="selectedItemsInput">
                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center gap-2" id="btnCheckout" disabled>
                        Lanjut ke Pembayaran <i data-lucide="arrow-right" size="18"></i>
                    </button>
                </form>

                <div class="d-flex align-items-center justify-content-center gap-2 mt-3 text-muted">
                    <i data-lucide="shield-check" size="16" class="text-success"></i>
                    <span class="smaller fw-medium">Transaksi Diberdayakan & Aman</span>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- TAMPILAN JIKA KERANJANG KOSONG -->
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-4">
        <div class="py-4">
            <div class="icon-circle-lg mx-auto mb-3 bg-light text-muted d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px;">
                <i data-lucide="shopping-cart" size="40" class="opacity-50"></i>
            </div>
            <h5 class="fw-800 text-dark mb-2">Keranjang Belanja Anda Kosong</h5>
            <p class="text-muted small mb-4">Sepertinya Anda belum menambahkan produk UMKM apa pun ke dalam keranjang.</p>
            <a href="{{ route('frontend.eCommerce') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                Mulai Jelajahi Produk
            </a>
        </div>
    </div>
    @endif

</div>

<!-- STYLING CSS KHUSUS -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-800 { font-weight: 800; }
    
    .smaller {
        font-size: 0.72rem;
        letter-spacing: 0.03rem;
    }

    .btn-white { background: white; }

    .price-text { font-size: 1.05rem; }

    .bg-primary-subtle {
        background-color: #f3e8ff;
    }

    .badge-location-sm {
        background: #f1f5f9;
        color: #475569;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
    }

    .custom-checkbox {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .custom-checkbox:checked {
        background-color: #7728a8;
        border-color: #7728a8;
    }

    .cart-item-card {
        transition: all 0.2s ease-in-out;
    }

    .cart-item-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
    }

    .quantity-counter {
        width: fit-content;
    }

    .btn-counter {
        width: 26px;
        height: 26px;
        color: #475569;
        border-radius: 6px;
        background: #ffffff;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        transition: all 0.2s;
    }

    .btn-counter:hover {
        background: #7728a8;
        color: #ffffff;
    }

    .btn-remove-item {
        transition: color 0.2s ease;
    }

    .btn-remove-item:hover {
        color: #ef4444 !important;
    }

    /* Hilangkan panah spinner bawaan input number */
    input.item-qty::-webkit-outer-spin-button,
    input.item-qty::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<!-- JAVASCRIPT: LOGIKA SINKRONISASI CHECKBOX & SUBLAYOUT KERANJANG -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectAll = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const btnCheckout = document.getElementById('btnCheckout');
    const summaryQty = document.getElementById('summary-qty');
    const summaryRawPrice = document.getElementById('summary-raw-price');
    const summaryTotalPrice = document.getElementById('summary-total-price');
    const totalSelectedCount = document.getElementById('total-selected-count');
    const selectedItemsInput = document.getElementById('selectedItemsInput');

    // Helper format Rupiah
    function formatRupiah(number) {
        if (isNaN(number)) return 'Rp 0';
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    // Hitung Ulang Total Belanja Terpilih
    function calculateTotal() {
        let total = 0;
        let count = 0;
        let selectedIds = [];

        itemCheckboxes.forEach(cb => {
            if (cb.checked) {
                const card = cb.closest('.cart-item-card');
                const qtyInput = card.querySelector('.item-qty');
                const price = parseFloat(cb.getAttribute('data-price')) || 0;
                const qty = parseInt(qtyInput.value) || 0;

                total += price * qty;
                count += qty;
                selectedIds.push(cb.value);
            }
        });

        // Update tampilan DOM ringkasan
        summaryQty.innerText = count;
        summaryRawPrice.innerText = formatRupiah(total);
        summaryTotalPrice.innerText = formatRupiah(total);
        totalSelectedCount.innerText = selectedIds.length;
        selectedItemsInput.value = selectedIds.join(',');

        // Aktifkan / Nonaktifkan tombol checkout
        if (selectedIds.length > 0) {
            btnCheckout.removeAttribute('disabled');
        } else {
            btnCheckout.setAttribute('disabled', 'true');
        }
    }

    // Toggle Select All
    if(selectAll) {
        selectAll.addEventListener('change', function() {
            itemCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            calculateTotal();
        });
    }

    // Event listener per checkbox item
    itemCheckboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (!this.checked) {
                if(selectAll) selectAll.checked = false;
            } else {
                const allChecked = Array.from(itemCheckboxes).every(c => c.checked);
                if(selectAll) selectAll.checked = allChecked;
            }
            calculateTotal();
        });
    });

    // Plus Minus Quantity Handler
    document.querySelectorAll('.btn-plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.cart-item-card');
            const qtyInput = card.querySelector('.item-qty');
            const cb = card.querySelector('.item-checkbox');
            let currentQty = parseInt(qtyInput.value) || 1;
            
            qtyInput.value = currentQty + 1;
            updateSubtotalItem(card, cb, currentQty + 1);
        });
    });

    document.querySelectorAll('.btn-minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.cart-item-card');
            const qtyInput = card.querySelector('.item-qty');
            const cb = card.querySelector('.item-checkbox');
            let currentQty = parseInt(qtyInput.value) || 1;
            
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
                updateSubtotalItem(card, cb, currentQty - 1);
            }
        });
    });

    function updateSubtotalItem(card, cb, newQty) {
        const price = parseFloat(cb.getAttribute('data-price')) || 0;
        const subtotalText = card.querySelector('.subtotal-item-text');
        
        // Update Teks Subtotal per baris
        subtotalText.innerText = formatRupiah(price * newQty);
        
        // Recalculate Total Ringkasan jika item tersebut dicentang
        calculateTotal();
    }

    // Inisialisasi awal saat halaman dibuka
    calculateTotal();

    // Inisialisasi ikon Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection