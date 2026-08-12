@extends('frontend.main.index')

@section('content')

<style>
    body { background-color: #f8fafc; }

    /* Product Gallery */
    .main-img-container {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #edf2f7;
    }
    .thumb-img {
        width: 80px; height: 80px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        border: 2px solid #e2e8f0;
        transition: 0.3s;
    }
    .thumb-img:hover, .thumb-img.active { border-color: #7728a8; opacity: 0.8; }

    /* Product Info */
    .product-sticky-top { position: sticky; top: 110px; }
    .badge-umkm {
        background: rgba(119, 40, 168, 0.1);
        color: #7728a8;
        font-weight: 700;
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
    }
    .price-tag { font-size: 2.2rem; font-weight: 800; color: #1e293b; }

    /* Action Buttons */
    .btn-cart {
        border-radius: 15px;
        padding: 14px;
        font-weight: 700;
        transition: 0.3s;
    }
    .btn-wa {
        background-color: #25d366;
        color: white;
        border: none;
    }
    .btn-wa:hover { background-color: #128c7e; color: white; transform: translateY(-2px); }

    /* Tabs Styling */
    .nav-tabs-custom .nav-link {
        border: none;
        color: #64748b;
        font-weight: 600;
        padding: 15px 25px;
    }
    .nav-tabs-custom .nav-link.active {
        color: #7728a8;
        border-bottom: 3px solid #7728a8;
        background: none;
    }

    /* Seller Card */
    .seller-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #edf2f7;
    }
    
    .fw-800 { font-weight: 800; }
</style>


<div class="container mb-5" style="margin-top: 120px;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.eCommerce') }}" class="text-decoration-none">E-Commerce</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- GAMBAR PRODUK -->
        <div class="col-lg-6">
            <div class="main-img-container mb-3 shadow-sm text-center p-2">
                <img src="{{ route('show.thumbnail.produk.private', $produk->produk_thumbnail) }}" id="mainImg" class="img-fluid rounded-4 w-100" style="max-height: 480px; object-fit: cover;" alt="{{ $produk->nama_produk }}">
            </div>
        </div>

        <!-- INFORMASI PRODUK -->
        <div class="col-lg-6">
            <div class="product-sticky-top">
                <div class="mb-2">
                    <span class="badge-umkm">{{ $produk->kategori->name ?? 'Produk Unggulan UMKM' }}</span>
                </div>
                <h1 class="fw-800 text-dark mb-2">{{ $produk->nama_produk }}</h1>
                
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="text-warning">
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                        <i data-lucide="star" fill="currentColor" size="18"></i>
                    </div>
                    <span class="text-muted small fw-medium">(Produk Asli UMKM Tangerang)</span>
                </div>

                <div class="mb-4">
                    <h2 class="price-tag mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h2>
                    <p class="text-success small fw-bold d-flex align-items-center gap-1 mb-0">
                        <i data-lucide="check-circle" size="15"></i> Stok Tersedia
                    </p>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="row g-3 mb-5">
                    @php
                        // Format nomor telepon WhatsApp vendor (Ubah 08xx jadi 628xx)
                        $phone = $produk->vendor->phone ?? '628123456789';
                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                        $textWa = rawurlencode("Halo, saya tertarik dengan produk {$produk->nama_produk} yang ada di portal UMKM Tangerang.");
                    @endphp

                    <!-- Button Chat WA Vendor -->
                    <div class="col-md-7">
                        <a href="https://wa.me/{{ $phone }}?text={{ $textWa }}" target="_blank" class="btn btn-wa btn-cart w-100 d-flex align-items-center justify-content-center shadow-sm">
                            <i data-lucide="message-circle" class="me-2" size="20"></i> Tanya Penjual (WhatsApp)
                        </a>
                    </div>

                    <!-- Button Tambah ke Keranjang -->
                    <div class="col-md-5">
                        <form action="{{ route('frontend.cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <button type="submit" class="btn btn-primary btn-cart w-100 shadow-sm d-flex align-items-center justify-content-center gap-2" title="Tambah ke Keranjang">
                                <i data-lucide="shopping-cart" size="18"></i> Beli Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <!-- INFORMASI VENDOR / SELLER -->
                <div class="seller-card d-flex align-items-center justify-content-between shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center border" style="width: 55px; height: 55px; overflow: hidden;">
                            @if(!empty($produk->vendor->logo))
                                <img src="{{ route('show.thumbnail.produk.private', $produk->vendor->logo) }}" class="w-100 h-100 object-fit-cover" alt="Logo Vendor">
                            @else
                                <i data-lucide="store" size="26" class="text-primary"></i>
                            @endif
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark">{{ $produk->vendor->nama_vendor ?? $produk->vendor->name ?? 'UMKM Mitra Tangerang' }}</h6>
                            <p class="text-muted small mb-0 d-flex align-items-center gap-1">
                                <i data-lucide="map-pin" size="13"></i> Kec. {{ $produk->vendor->kecamatan ?? 'Tangerang' }}
                            </p>
                        </div>
                    </div>
                    <!-- Link Ke Halaman Toko Vendor jika ada -->
                    <a href="{{ route('frontend.toko', $produk->vendor_id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                        Kunjungi Toko &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- TABS DESKRIPSI & SPESIFIKASI -->
    <div class="mt-5 pt-4">
        <ul class="nav nav-tabs nav-tabs-custom mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">Deskripsi Produk</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#spec">Informasi Tambahan</button>
            </li>
        </ul>
        <div class="tab-content bg-white p-4 rounded-4 shadow-sm border">
            <!-- Deskripsi HTML Render -->
            <div class="tab-pane fade show active" id="desc">
                <div class="text-muted lh-lg">
                    {!! $produk->produk_deskripsi ?? 'Tidak ada deskripsi produk.' !!}
                </div>
            </div>
            
            <!-- Spesifikasi -->
            <div class="tab-pane fade" id="spec">
                <table class="table table-borderless">
                    <tr>
                        <td class="fw-bold text-muted" width="200">Kategori</td>
                        <td>{{ $produk->kategori->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Wilayah Produksi</td>
                        <td>Kec. {{ $produk->vendor->kecamatan ?? 'Kabupaten Tangerang' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Pengiriman</td>
                        <td>Dikirim langsung dari lokasi UMKM Mitra</td>
                    </tr>
                </table>
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