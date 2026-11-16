@extends('frontend.main.index')

@section('content')


<style>
    :root {
        --primary-blue: #4361ee;
        --soft-bg: #f8fafc;
    }

    body { background-color: var(--soft-bg); }

    /* Header Profil Toko */
    .shop-header {
        margin-top: 100px;
        background: white;
        border-radius: 30px;
        overflow: hidden;
        border: 1px solid #edf2f7;
    }
    
    .shop-banner {
        height: 200px;
        background: linear-gradient(45deg, #4361ee, #4cc9f0);
        position: relative;
    }

    .shop-profile-content {
        padding: 0 40px 40px 40px;
        margin-top: -60px;
        position: relative;
    }

    .shop-logo-container {
        width: 120px;
        height: 120px;
        background: white;
        padding: 5px;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .shop-logo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }

    /* Statistik Toko */
    .shop-stat {
        display: flex;
        gap: 30px;
        margin-top: 20px;
        padding: 20px 0;
        border-top: 1px solid #f1f5f9;
    }

    .stat-item { text-align: center; }
    .stat-value { font-weight: 800; font-size: 1.1rem; display: block; color: #1e293b; }
    .stat-label { font-size: 0.8rem; color: #64748b; }

    /* Product Card Modern */
    .product-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        transition: 0.3s;
        height: 100%;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }
    .product-img {
        height: 200px;
        object-fit: cover;
        border-radius: 20px 20px 0 0;
    }
    .price-text {
        font-weight: 800;
        color: var(--primary-blue);
        font-size: 1.1rem;
    }

    /* Filter Sidebar */
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #f1f5f9;
        position: sticky;
        top: 100px;
    }
</style>


<div class="container mb-5">
    <div class="shop-header shadow-sm mb-5">
        <div class="shop-banner d-flex align-items-center justify-content-center">
            <h2 class="text-white opacity-25 fw-800">Cintailah Produk Lokal</h2>
        </div>
        <div class="shop-profile-content">
            <div class="d-md-flex align-items-end justify-content-between">
                <div class="d-md-flex align-items-end gap-4">
                    <!-- LOGO VENDOR -->
                    <div class="shop-logo-container">
                        @if(!empty($vendor->store_photo))
                            <img src="{{ route('show.thumbnail.produk.private', $vendor->store_photo) }}" alt="{{ $vendor->nama_vendor }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($vendor->nama_vendor ?? $vendor->name ?? 'UMKM') }}&background=4361ee&color=fff" alt="Logo UMKM">
                        @endif
                    </div>
                    <!-- NAMA & ALAMAT TOKO -->
                    <div class="mt-3 mt-md-0">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="fw-800 m-0">{{ $vendor->nama_vendor ?? $vendor->name ?? 'Toko UMKM' }}</h3>
                            <i data-lucide="check-circle" class="text-primary" size="20"></i>
                        </div>
                        <p class="text-muted m-0">
                            <i data-lucide="map-pin" size="14"></i> 
                            Kec. {{ $vendor->kecamatan ?? 'Tangerang' }}, Kabupaten Tangerang
                        </p>
                    </div>
                </div>

                <!-- TOMBOL HUBUNGI VENDOR -->
                <div class="mt-4 mt-md-0 d-flex gap-2">
                    @php
                        $phone = $vendor->phone ?? '628123456789';
                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                        $textWa = rawurlencode("Halo {$vendor->nama_vendor}, saya tertarik dengan produk di toko Anda.");
                    @endphp
                    <a href="https://wa.me/{{ $phone }}?text={{ $textWa }}" target="_blank" class="btn btn-success rounded-pill px-4 fw-bold">
                        <i data-lucide="message-circle" class="me-2" size="18"></i> Hubungi Penjual
                    </a>
                </div>
            </div>

            <!-- STATISTIK TOKO -->
            <div class="shop-stat mt-4">
                <div class="stat-item">
                    <span class="stat-value">5.0</span>
                    <span class="stat-label">Rating Toko</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $totalProduk ?? count($produks) }}</span>
                    <span class="stat-label">Total Produk</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">Mitra UMKM</span>
                    <span class="stat-label">Status Toko</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- SIDEBAR FILTER / KATEGORI -->
        <div class="col-lg-3 d-none d-lg-block">
            <div class="filter-card">
                <h6 class="fw-800 mb-3">Kategori Produk</h6>
                <div class="list-group list-group-flush small">
                    <a href="{{ route('frontend.toko', $vendor->id) }}" class="list-group-item list-group-item-action border-0 px-0 fw-bold {{ !request('kategori') ? 'text-primary' : '' }}">
                        Semua Produk
                    </a>
                    @if(isset($kategories) && count($kategories) > 0)
                        @foreach($kategories as $kat)
                            <a href="{{ route('frontend.toko', ['id' => $vendor->id, 'kategori' => $kat->id]) }}" class="list-group-item list-group-item-action border-0 px-0 {{ request('kategori') == $kat->id ? 'text-primary fw-bold' : '' }}">
                                {{ $kat->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
                <hr>
                <h6 class="fw-800 mb-3">Urutkan</h6>
                <form action="{{ route('frontend.toko', $vendor->id) }}" method="GET" id="sortForm">
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <select name="sort" class="form-select border-0 bg-light rounded-3" onchange="document.getElementById('sortForm').submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- LIST KATALOG PRODUK -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-800 m-0">Katalog Produk Toko</h5>
                <p class="text-muted small m-0">Menampilkan {{ $produks->total() ?? count($produks) }} Produk</p>
            </div>
            
            <div class="row g-3">
                @forelse($produks as $item)
                <div class="col-md-4 col-6">
                    <div class="product-card shadow-sm d-flex flex-column">
                        <img src="{{ route('show.thumbnail.produk.private', $item->produk_thumbnail) }}" class="product-img w-100" alt="{{ $item->nama_produk }}">
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <span class="text-muted smaller">{{ $item->kategori->name ?? 'UMKM' }}</span>
                            <h6 class="fw-bold text-dark mt-1 text-truncate" title="{{ $item->nama_produk }}">
                                {{ $item->nama_produk }}
                            </h6>
                            <p class="price-text mb-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            
                            <div class="mt-auto pt-2">
                                <a href="{{ route('frontend.eCommerce.detail', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-bold">
                                    Detail Produk
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-4 border">
                        <i data-lucide="package-open" size="48" class="text-muted mb-3"></i>
                        <h5 class="fw-bold text-dark mb-1">Belum Ada Produk</h5>
                        <p class="text-muted small mb-0">Toko ini belum menambahkan produk pada kategori ini.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- PAGINASI DINAMIS -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $produks->withQueryString()->links() }}
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