@extends('frontend.main.index')

@section('content')

<style>
    body { background-color: #f8fafc; }

    /* Store Header & Banner */
    .store-banner {
        height: 240px;
        background: linear-gradient(135deg, #7728a8 0%, #4a156b 100%);
        border-radius: 0 0 30px 30px;
        position: relative;
    }
    
    .store-profile-wrapper {
        margin-top: -80px;
        position: relative;
        z-index: 10;
    }

    .store-card {
        background: white;
        border-radius: 24px;
        border: 1px solid #edf2f7;
    }

    .store-avatar {
        width: 110px;
        height: 110px;
        border-radius: 20px;
        object-fit: cover;
        border: 4px solid #ffffff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .store-avatar-placeholder {
        width: 110px;
        height: 110px;
        border-radius: 20px;
        background: #f1f5f9;
        border: 4px solid #ffffff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .badge-location {
        background: #f1f5f9;
        color: #475569;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
    }

    /* Product Card Modern */
    .product-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
        border-color: rgba(119, 40, 168, 0.2);
    }

    .product-img-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
        background-color: #f8fafc;
    }

    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img-wrapper img {
        transform: scale(1.06);
    }

    .badge-category {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        color: #7728a8;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 50px;
    }

    .btn-wa-store {
        background-color: #25d366;
        color: white;
        font-weight: 700;
        border-radius: 12px;
        padding: 10px 20px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-wa-store:hover {
        background-color: #128c7e;
        color: white;
        transform: translateY(-2px);
    }
</style>


<!-- BANNER ATAS -->
<div class="store-banner"></div>

<div class="container mb-5">
    <!-- KARTU PROFIL TOKO (FLOATING) -->
    <div class="store-profile-wrapper mb-5">
        <div class="store-card p-4 p-md-5 shadow-sm">
            <div class="row align-items-center gy-4">
                <div class="col-md-8">
                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start text-center text-sm-start gap-4">
                        <!-- LOGO/AVATAR VENDOR -->
                        @if(!empty($vendor->logo))
                            <img src="{{ route('show.thumbnail.produk.private', $vendor->logo) }}" class="store-avatar" alt="{{ $vendor->nama_vendor }}">
                        @else
                            <div class="store-avatar-placeholder d-flex align-items-center justify-content-center">
                                <i data-lucide="store" size="48" class="text-primary"></i>
                            </div>
                        @endif

                        <!-- INFORMASI TOKO -->
                        <div>
                            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-sm-start gap-2 mb-2">
                                <h2 class="fw-bold text-dark mb-0">{{ $vendor->nama_vendor ?? $vendor->name ?? 'Toko UMKM' }}</h2>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 text-xs fw-bold">
                                    <i data-lucide="check-circle-2" size="13" class="me-1"></i> Terverifikasi
                                </span>
                            </div>

                            <p class="text-muted small mb-3">
                                {{ $vendor->deskripsi_toko ?? 'Mitra UMKM Unggulan Kabupaten Tangerang.' }}
                            </p>

                            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start gap-2 align-items-center">
                                <span class="badge-location d-flex align-items-center gap-1">
                                    <i data-lucide="map-pin" size="14" class="text-danger"></i>
                                    Kec. {{ $vendor->kecamatan ?? 'Tangerang' }}
                                </span>
                                <span class="badge-location d-flex align-items-center gap-1">
                                    <i data-lucide="package" size="14" class="text-primary"></i>
                                    {{ $totalProduk }} Produk
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL KONTAK VENDOR -->
                <div class="col-md-4 text-center text-md-end border-top border-md-0 pt-3 pt-md-0">
                    @php
                        $phone = $vendor->phone ?? '628123456789';
                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                        $textWa = rawurlencode("Halo {$vendor->nama_vendor}, saya ingin bertanya mengenai produk yang Anda jual di Portal UMKM.");
                    @endphp
                    <a href="https://wa.me/{{ $phone }}?text={{ $textWa }}" target="_blank" class="btn btn-wa-store d-inline-flex align-items-center justify-content-center gap-2 w-100 w-sm-auto shadow-sm">
                        <i data-lucide="message-circle" size="20"></i> Hubungi Toko
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER DAFTAR PRODUK TOKO -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Produk dari {{ $vendor->nama_vendor ?? 'Toko Ini' }}</h4>
            <p class="text-muted small mb-0">Menampilkan seluruh koleksi produk buatan lokal</p>
        </div>
    </div>

    <!-- GRID PRODUK -->
    <div class="row g-4">
        @forelse($produks as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card h-100 d-flex flex-column">
                    <!-- GAMBAR PRODUK -->
                    <div class="product-img-wrapper">
                        <span class="badge-category">{{ $item->kategori->name ?? 'UMKM' }}</span>
                        <a href="{{ route('frontend.eCommerce.detail', $item->id) }}">
                            <img src="{{ route('show.thumbnail.produk.private', $item->produk_thumbnail) }}" alt="{{ $item->nama_produk }}">
                        </a>
                    </div>

                    <!-- KONTEN PRODUK -->
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <h6 class="fw-bold text-dark text-truncate mb-2" title="{{ $item->nama_produk }}">
                            <a href="{{ route('frontend.eCommerce.detail', $item->id) }}" class="text-dark text-decoration-none">
                                {{ $item->nama_produk }}
                            </a>
                        </h6>
                        
                        <div class="mt-auto">
                            <div class="fw-extrabold fs-5 text-dark mb-3">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('frontend.eCommerce.detail', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-3 w-100 fw-bold py-2">
                                    Detail
                                </a>
                                <form action="{{ route('frontend.cart.store') }}" method="POST" class="w-100">
                                    @csrf
                                    <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold py-2" title="Tambah ke Keranjang">
                                        <i data-lucide="shopping-cart" size="16"></i> +Beli
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-4 border">
                    <i data-lucide="package-open" size="48" class="text-muted mb-3"></i>
                    <h5 class="fw-bold text-dark mb-1">Belum Ada Produk</h5>
                    <p class="text-muted small">Toko ini belum menambahkan produk ke katalog marketplace.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- PAGINASI -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $produks->links() }}
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection