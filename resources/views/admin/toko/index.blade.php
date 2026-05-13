@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <!-- Header Section -->
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-primary mb-1">Manajemen Mitra UMKM</h4>
                <p class="text-muted small mb-0">Kelola dan pantau seluruh data toko mitra yang terdaftar dalam sistem.</p>
            </div>
            <div class="d-flex gap-3">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-white border-end-0 rounded-3"><i data-lucide="search" size="18" class="text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 rounded-3 ps-0" placeholder="Cari toko atau pemilik...">
                </div>
            </div>
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
                            <img src="{{ route('show.thumbnail.produk.private', $vendor->store_photo) }}" 
                                 class="rounded-3 border shadow-sm" 
                                 style="width: 80px; height: 80px; object-fit: cover;" 
                                 alt="Logo Toko">
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
                            <h5 class="fw-800 mb-0">{{ $vendor->produk->count()?? 0 }}</h5>
                        </div>
                    </div>

                   
                    <div class="col-md-2 border-start bg-light bg-opacity-50 px-3 text-end">
                        <div class="py-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.list.toko.detail', $vendor->id) }}" class="btn btn-outline-dark btn-sm rounded-2 fw-bold px-3">
                                <i data-lucide="layout-dashboard" size="14" class="me-1"></i> Detail
                            </a>
                            <!-- <button class="btn btn-danger btn-sm rounded-2 px-3" onclick="confirmDelete('{{ $vendor->id }}')">
                                <i data-lucide="trash-2" size="14"></i>
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 bg-white rounded-3 shadow-sm border">
            <i data-lucide="store" size="48" class="text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada mitra UMKM yang terdaftar</h5>
        </div>
        @endforelse
    </div>
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