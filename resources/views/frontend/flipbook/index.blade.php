@extends('frontend.main.index')

@section('content')
<div class="bg-light py-5 min-vh-100 mt-5">
    <div class="container py-3">

        {{-- Hero Header Banner --}}
        <div class="card border-0 rounded-4 p-4 p-md-5 mb-5 shadow-sm text-white position-relative overflow-hidden" 
             style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #e11d48 100%);">
            
            {{-- Background Decorative Shape --}}
            <div class="position-absolute end-0 bottom-0 opacity-10 pointer-events-none me-n5 mb-n5 d-none d-lg-block">
                <i data-lucide="book-open-check" style="width: 320px; height: 320px;"></i>
            </div>

            <div class="row align-items-center position-relative z-1">
                <div class="col-lg-8">
                    <span class="badge bg-white text-danger fw-bold px-3 py-2 rounded-pill smaller mb-3 shadow-sm d-inline-flex align-items-center gap-1.5">
                        <i data-lucide="sparkles" size="14"></i> Perpustakaan Digital & Katalog
                    </span>
                    <h1 class="fw-black display-5 mb-3">Jelajahi Flipbook Interaktif</h1>
                    <p class="text-white-50 lead fs-6 mb-4" style="max-width: 600px;">
                        Temukan berbagai modul pelatihan, katalog UMKM, dan panduan digital berkualitas dalam format flipbook yang nyaman dibaca di mana saja.
                    </p>

                    {{-- Search Input inside Hero --}}
                    <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2 bg-white p-2 rounded-4 shadow-lg" style="max-width: 520px;">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 text-muted ps-3">
                                <i data-lucide="search" size="18"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   class="form-control border-0 shadow-none smaller py-2" 
                                   placeholder="Cari buku, modul, atau katalog...">
                        </div>
                        <button type="submit" class="btn btn-danger rounded-3 px-4 fw-semibold border-0 d-flex align-items-center gap-1.5" style="background-color: #e11d48;">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Filter & Total Status --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">Daftar Katalog & Modul</h4>
                <p class="text-muted smaller mb-0">Menampilkan {{ count($flipbooks ?? []) }} buku digital yang tersedia</p>
            </div>

            @if(request('search'))
                <a href="{{ url()->current() }}" class="btn btn-outline-secondary rounded-pill btn-sm px-3 smaller d-inline-flex align-items-center gap-1">
                    <i data-lucide="x" size="14"></i> Hapus Pencarian
                </a>
            @endif
        </div>

        {{-- Flipbook Cards Grid --}}
        <div class="row g-4 mb-5">
            @forelse($flipbooks ?? [] as $item)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card border-0 rounded-4 shadow-sm bg-white h-100 overflow-hidden flipbook-card">
                    
                    {{-- Cover Image Container --}}
                    <div class="position-relative overflow-hidden bg-dark style-cover-wrapper" style="height: 260px;">
                        <img src="{{ route('show.thumbnail.produk.private', $item->cover_image) }}" 
                             class="w-100 h-100 object-fit-cover flipbook-cover-img" 
                             alt="{{ $item->judul }}"
                             onerror="this.src='https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=600&auto=format&fit=crop&q=80'">
                        
                        {{-- Overlay Gradient & Read Button --}}
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-3 style-overlay">
                            <!-- <button type="button" 
                                    class="btn btn-light rounded-3 py-2 px-3 fw-bold smaller text-dark shadow-sm d-flex align-items-center justify-content-center gap-2 btn-read-hover"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#readerModal{{ $item->id }}">
                                <i data-lucide="book-open" size="16" class="text-danger"></i> Baca Flipbook
                            </button> -->
                             <a 
                                    class="btn btn-light rounded-3 py-2 px-3 fw-bold smaller text-dark shadow-sm d-flex align-items-center justify-content-center gap-2 btn-read-hover"
                                    href="{{ route('frontend.flipbook.show', $item->id) }}">
                                <i data-lucide="book-open" size="16" class="text-danger"></i> Baca Flipbook
                            </a>
                        </div>

                        {{-- PDF Badge --}}
                        <span class="badge position-absolute top-0 end-0 m-3 rounded-pill px-2.5 py-1.5 smaller fw-semibold bg-danger text-white shadow-sm">
                            <i data-lucide="file-text" size="12" class="me-1"></i> PDF
                        </span>
                    </div>

                    {{-- Card Body Content --}}
                    <div class="card-body p-3.5 d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-muted smaller mb-2 d-flex align-items-center gap-1">
                                <i data-lucide="calendar" size="13"></i>
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                            </div>
                            <h6 class="fw-bold text-dark mb-2 line-clamp-2" title="{{ $item->judul }}" style="line-height: 1.4; font-size: 0.98rem;">
                                {{ $item->judul }}
                            </h6>
                            <p class="text-muted smaller mb-3 line-clamp-2" style="line-height: 1.5;">
                                {{ $item->deskripsi ?? 'Tidak ada deskripsi singkat.' }}
                            </p>
                        </div>

                        {{-- Footer Action Buttons --}}
                        <div class="pt-2 border-top d-flex align-items-center justify-content-between gap-2">
                            <button type="button" 
                                    class="btn btn-outline-danger btn-sm rounded-3 flex-grow-1 fw-semibold smaller py-1.5 d-flex align-items-center justify-content-center gap-1.5"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#readerModal{{ $item->id }}">
                                <i data-lucide="eye" size="14"></i> Pratinjau
                            </button>
                            
                            <!-- <a href="{{ asset('storage/' . $item->file_pdf) }}" 
                               download 
                               class="btn btn-light border btn-sm rounded-3 px-2.5 py-1.5 text-secondary" 
                               title="Unduh PDF">
                                <i data-lucide="download" size="14"></i>
                            </a> -->
                        </div>
                    </div>

                </div>
            </div>

            {{-- Modal Reader Interaktif untuk setiap buku --}}
            <div class="modal fade" id="readerModal{{ $item->id }}" tabindex="-1" aria-labelledby="readerModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                        
                        {{-- Modal Header --}}
                        <div class="modal-header bg-dark text-white border-0 px-4 py-3">
                            <div class="d-flex align-items-center gap-2 overflow-hidden me-3">
                                <i data-lucide="book-open" class="text-danger flex-shrink-0" size="20"></i>
                                <h6 class="modal-title fw-bold text-truncate mb-0" id="readerModalLabel{{ $item->id }}">
                                    {{ $item->judul }}
                                </h6>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                <!-- <a href="{{ asset('storage/' . $item->file_pdf) }}" download class="btn btn-sm btn-danger rounded-3 px-3 py-1.5 fw-semibold smaller d-flex align-items-center gap-1" style="background-color: #e11d48;">
                                    <i data-lucide="download" size="14"></i> Unduh
                                </a> -->
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>

                        {{-- Modal Body: PDF Viewer Embed --}}
                        <div class="modal-body p-0 bg-secondary bg-opacity-10" style="min-height: 70vh;">
                            <iframe src="{{ route('show.thumbnail.produk.private', $item->file_pdf) }}" class="w-100 h-100 border-0" style="min-height: 70vh;" title="{{ $item->judul }}"></iframe>
                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 py-5">
                <div class="text-center py-5 bg-white rounded-4 shadow-sm border p-4">
                    <div class="rounded-circle bg-light p-3 d-inline-flex mb-3 text-muted">
                        <i data-lucide="book-x" size="48"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Flipbook Tidak Ditemukan</h5>
                    <p class="text-muted smaller mb-3" style="max-width: 420px; margin: 0 auto;">
                        Belum ada modul atau buku digital yang dipublikasikan saat ini. Silakan kembali lagi nanti.
                    </p>
                    @if(request('search'))
                        <a href="{{ url()->current() }}" class="btn btn-danger btn-sm rounded-3 px-4 py-2 fw-semibold border-0" style="background-color: #e11d48;">
                            Lihat Semua Buku
                        </a>
                    @endif
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination jika ada --}}
        @if(isset($flipbooks) && method_exists($flipbooks, 'links'))
            <div class="d-flex justify-content-center pt-3">
                {{ $flipbooks->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
    .fw-black { font-weight: 800; }
    
    /* Card Styles & Hover Effects */
    .flipbook-card {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
    }
    .flipbook-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 30px rgba(0,0,0,0.12) !important;
    }
    .flipbook-cover-img {
        transition: transform 0.4s ease;
    }
    .flipbook-card:hover .flipbook-cover-img {
        transform: scale(1.05);
    }

    /* Overlay Hover Animation */
    .style-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 60%);
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }
    
    /* Line Clamping for Text */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection