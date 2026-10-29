@extends('admin.main.main')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container-fluid px-4">

        {{-- Top Bar Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold text-dark mb-1">Daftar Flipbook</h3>
                <p class="text-muted small mb-0">Kelola buku digital, katalog, dan modul interaktif berbentuk Flipbook.</p>
            </div>
            <a href="{{ route('admin.flipbook.create') }}" class="btn btn-danger d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-semibold border-0 shadow-sm" style="background-color: #e11d48;">
                <i data-lucide="plus-circle" size="18"></i> Tambah Flipbook
            </a>
        </div>

        {{-- Stats Overview Row --}}
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-3 d-flex align-items-center justify-content-center text-primary" style="background-color: #eff6ff;">
                        <i data-lucide="book-open" size="24"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">{{ $flipbooks->count() ?? 2 }}</h4>
                        <span class="text-muted smaller">Total Flipbook</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-3 d-flex align-items-center justify-content-center text-danger" style="background-color: #ffe4e6;">
                        <i data-lucide="file-text" size="24"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">{{ $flipbooks->count() ?? 2 }}</h4>
                        <span class="text-muted smaller">File PDF Terunggah</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-3 d-flex align-items-center justify-content-center text-success" style="background-color: #d1fae5;">
                        <i data-lucide="clock" size="24"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">Terbaru</h4>
                        <span class="text-muted smaller">Diperbarui Hari Ini</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Search Bar --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white p-3 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-3">
                <form action="{{ route('admin.flipbook.index') }}" method="GET" class="d-flex gap-2 flex-grow-1" style="max-width: 400px;">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted ps-3">
                            <i data-lucide="search" size="16"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-start-0 rounded-end-3 py-2 smaller" placeholder="Cari judul atau deskripsi...">
                    </div>
                </form>

                <div class="d-flex align-items-center gap-2 text-muted smaller">
                    <span>Urutkan:</span>
                    <select class="form-select form-select-sm rounded-3 py-1.5 px-3 smaller border" style="width: 150px;">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="title">Judul (A-Z)</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Flipbook Grid Cards --}}
        <div class="row g-4 mb-4">
            {{-- Loop Data (Contoh Static / Dynamic Blade) --}}
            @php
                $dummyFlipbooks = [
                    [
                        'id' => 1,
                        'judul' => 'Katalog Panduan UMKM 2026',
                        'deskripsi' => 'Panduan lengkap bagi pelaku usaha mikro, kecil, dan menengah dalam mengembangkan bisnis digital.',
                        'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80',
                        'file_pdf' => 'katalog-umkm-2026.pdf',
                        'created_at' => '17 Jun 2026',
                    ],
                    [
                        'id' => 2,
                        'judul' => 'Modul Pelatihan E-Learning Fellonge',
                        'deskripsi' => 'Modul materi utama pembelajaran daring untuk peserta program pelatihan terpadu.',
                        'cover_image' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=600&auto=format&fit=crop&q=80',
                        'file_pdf' => 'modul-elearning.pdf',
                        'created_at' => '01 Aug 2026',
                    ],
                ];
            @endphp

            @forelse($flipbooks ?? $dummyFlipbooks as $item)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card border-0 rounded-4 shadow-sm bg-white h-100 overflow-hidden hover-card">
                    
                    {{-- Flipbook Cover Image Banner --}}
                    <div class="position-relative bg-dark" style="height: 220px; overflow: hidden;">
                        <img src="{{ route('show.thumbnail.produk.private', $item->cover_image) }}" 
                             class="w-100 h-100 object-fit-cover opacity-90" 
                             alt="{{ $item['judul'] }}"
                             onerror="this.src='https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=600&auto=format&fit=crop&q=80'">
                        
                        {{-- PDF Badge Overlay --}}
                        <span class="badge position-absolute top-0 end-0 m-3 rounded-pill px-2.5 py-1.5 smaller fw-semibold bg-danger text-white shadow-sm d-flex align-items-center gap-1">
                            <i data-lucide="file-text" size="12"></i> PDF
                        </span>
                    </div>

                    {{-- Card Content --}}
                    <div class="card-body p-3.5 d-flex flex-column justify-content-between">
                        <div>
                            <span class="text-muted smaller d-block mb-1">
                                <i data-lucide="calendar" size="12" class="me-1"></i> {{ \Carbon\Carbon::parse($item['created_at'])->format('d M Y') }}
                            </span>
                            <h6 class="fw-bold text-dark mb-2 text-truncate-2" style="font-size: 0.95rem; line-height: 1.3;">
                                {{ $item['judul'] }}
                            </h6>
                            <p class="text-muted smaller mb-3 line-clamp-2">
                                {{ $item['deskripsi'] }}
                            </p>
                        </div>

                        <div>
                            {{-- PDF File Info --}}
                            <div class="p-2 rounded-3 bg-light d-flex align-items-center justify-content-between mb-3 border">
                                <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                                    <i data-lucide="file" class="text-danger flex-shrink-0" size="16"></i>
                                    <span class="text-muted smaller text-truncate fw-medium">{{ $item['file_pdf'] }}</span>
                                </div>
                                <a href="{{ route('show.thumbnail.produk.private', $item->file_pdf) }}" target="_blank" class="text-primary smaller text-decoration-none fw-semibold flex-shrink-0">
                                    Buka
                                </a>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.flipbook.show', $item['id'] ?? $item->id) }}" class="btn btn-outline-primary flex-grow-1 rounded-3 py-1.5 fw-semibold smaller d-flex align-items-center justify-content-center gap-1">
                                    <i data-lucide="book-open" size="14"></i> Baca
                                </a>
                                <a href="{{ route('admin.flipbook.edit', $item['id'] ?? $item->id) }}" class="btn btn-light border text-secondary rounded-3 px-2.5 py-1.5 smaller" title="Edit">
                                    <i data-lucide="edit-3" size="14"></i>
                                </a>
                                <form action="{{ route('admin.flipbook.destroy', $item['id'] ?? $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus flipbook ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light border text-danger rounded-3 px-2.5 py-1.5 smaller" title="Hapus">
                                        <i data-lucide="trash-2" size="14"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-5 text-center">
                    <i data-lucide="book-x" size="48" class="text-muted mb-3 mx-auto"></i>
                    <h6 class="fw-bold text-dark mb-1">Belum Ada Flipbook</h6>
                    <p class="text-muted smaller mb-3">Silakan tambahkan modul atau katalog digital pertama Anda.</p>
                    <div>
                        <a href="{{ route('admin.flipbook.create') }}" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold smaller border-0" style="background-color: #e11d48;">
                            + Tambah Flipbook
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if(isset($flipbooks) && method_exists($flipbooks, 'links'))
        <div class="d-flex justify-content-between align-items-center pt-2">
            <span class="text-muted smaller">Menampilkan {{ $flipbooks->firstItem() ?? 0 }} - {{ $flipbooks->lastItem() ?? 0 }} dari {{ $flipbooks->total() ?? 0 }} data</span>
            <div>
                {{ $flipbooks->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .text-truncate-2 {
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