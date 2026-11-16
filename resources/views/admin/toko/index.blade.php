@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <!-- Header Section -->
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-primary mb-1">Manajemen Mitra UMKM</h4>
                <p class="text-muted small mb-0">Total Ditemukan: <b>{{ $vendors->total() }}</b> toko mitra dalam sistem.</p>
            </div>
            
            <!-- Form Pencarian (GET) -->
            <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">
                <div class="input-group" style="width: 350px;">
                    <span class="input-group-text bg-white border-end-0 rounded-start-3"><i data-lucide="search" size="18" class="text-muted"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 ps-0" placeholder="Cari nama toko, pemilik, atau no HP...">
                    <button class="btn btn-outline-primary px-3" type="submit">Cari</button>
                    @if(request('search'))
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary px-3" title="Reset Pencarian">
                            <i data-lucide="x" size="16"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- List Toko -->
    <div class="row g-3">
        @forelse ($vendors as $vendor)
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden transition-hover">
                <div class="row g-0 align-items-center">
                    
                    <div class="col-md-1">
                        <div class="p-3">
                            @if (empty($vendor->store_photo))
                                <img src="https://via.placeholder.com/80x80?text=No+Image" class="rounded-3 border shadow-sm" style="width: 80px; height: 80px; object-fit: cover;" alt="Default Logo">
                            @else
                                <img src="{{ route('show.thumbnail.produk.private', $vendor->store_photo) }}" 
                                    class="rounded-3 border shadow-sm" 
                                    style="width: 80px; height: 80px; object-fit: cover;" 
                                    alt="Logo Toko">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3 px-3">
                        <h6 class="fw-bold text-dark mb-1">{{ $vendor->shop_name }}</h6>
                        <div class="d-flex align-items-center gap-2">
                            <span class="smaller text-muted fw-bold text-uppercase">{{ $vendor->name }}</span>
                            <span class="text-muted">•</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary smaller px-2">{{ $vendor->kategori->name ?? 'UMKM' }}</span>
                        </div>
                    </div>

                    <div class="col-md-4 border-start px-4">
                        <div class="py-2">
                            <p class="text-muted smaller mb-1 text-truncate">
                                <i data-lucide="map-pin" size="14" class="text-danger me-1"></i>
                                {{ $vendor->kecamatan }}, {{ $vendor->kab_kota }}
                            </p>
                            <p class="small fw-bold mb-0">
                                <i data-lucide="phone" size="14" class="text-success me-1"></i>
                                {{ $vendor->phone }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-2 border-start text-center">
                        <div class="py-2">
                            <span class="smaller text-muted d-block">Total Produk</span>
                            <h5 class="fw-800 mb-0">{{ $vendor->produk->count() ?? 0 }}</h5>
                        </div>
                    </div>

                    <div class="col-md-2 border-start bg-light bg-opacity-50 px-3 text-end">
                        <div class="py-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.list.toko.detail', $vendor->id) }}" class="btn btn-outline-dark btn-sm rounded-2 fw-bold px-3">
                                <i data-lucide="layout-dashboard" size="14" class="me-1"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 bg-white rounded-3 shadow-sm border">
            <i data-lucide="store" size="48" class="text-muted mb-3 mx-auto"></i>
            <h5 class="text-muted">Tidak ada data mitra UMKM yang ditemukan</h5>
            @if(request('search'))
                <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-primary mt-2">Reset Pencarian</a>
            @endif
        </div>
        @endforelse
    </div>

    <!-- Paginasi Link -->
    @if ($vendors->hasPages())
    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $vendors->withQueryString()->links() }}
        </div>
    </div>
    @endif
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .transition-hover {
        transition: all 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.05) !important;
    }
    .rounded-3 { border-radius: 10px !important; }
    .btn { border-radius: 6px !important; }
    .bg-light { background-color: #f9fbff !important; }
</style>

@push('scripts')
<script>
    lucide.createIcons();
    
    function confirmDelete(id) {
        if(confirm('Apakah Anda yakin ingin menghapus mitra ini? Semua produk mitra tersebut juga akan dihapus.')) {
        }
    }
</script>
@endpush
@endsection