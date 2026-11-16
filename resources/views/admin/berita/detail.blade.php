@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5">
        <div class="col-md-12 mb-4 d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}" class="text-decoration-none">Daftar Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pratinjau Berita</li>
                </ol>
            </nav>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
                <a href="#" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                    <i data-lucide="edit-3" size="18" class="me-1"></i> Edit Berita
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <img src="{{ route('showFoto.acara.private', $berita->gambar) }}" class="card-img-top" style="height: 400px; object-fit: cover;" alt="{{ $berita->judul }}">
                    <!-- <img src="{{ Storage::url($berita->gambar) }}" class="card-img-top" style="height: 400px; object-fit: cover;" alt="{{ $berita->judul }}"> -->
                    
                    <div class="card-body p-5 bg-white">
                        <h1 class="fw-800 text-dark mb-4" style="line-height: 1.3;">{{ $berita->judul }}</h1>
                        
                        <div class="article-content text-muted lh-lg fs-6">
                            {!! $berita->deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h6 class="fw-800 text-dark mb-4 border-bottom pb-2">Informasi Publikasi</h6>
                    
                    <div class="mb-3">
                        <label class="text-muted smaller d-block mb-1">Status Berita</label>
                        @if ($berita->is_published === 1)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-2 w-100 d-block text-center fw-bold">Published</span>
                        @else   
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-2 w-100 d-block text-center fw-bold"> Non Published</span>
                        @endif
                    </div>

                    <div class="row g-3 d-flex justify-content-center align-items-center">
                        <div class="col-6 text-center">
                            <label class="text-muted smaller d-block mb-1">Total View</label>
                            <h5 class="fw-800 mb-0"><i data-lucide="eye" size="16" class="text-primary me-1"></i>{{ $berita->views }}</h5>
                        </div>
                        <!-- <div class="col-6 text-center">
                            <label class="text-muted smaller d-block mb-1">Komentar</label>
                            <h5 class="fw-800 mb-0"><i data-lucide="message-square" size="16" class="text-primary me-1"></i>0</h5>
                        </div> -->
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                                <i data-lucide="tag" size="20"></i>
                            </div>
                            <div>
                                <p class="text-muted smaller mb-0">Kategori</p>
                                <p class="fw-bold mb-0 text-dark">{{ $berita->kategori->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                                <i data-lucide="user" size="20"></i>
                            </div>
                            <div>
                                <p class="text-muted smaller mb-0">Penulis</p>
                                <p class="fw-bold mb-0 text-dark">{{ $berita->users->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                                <i data-lucide="calendar" size="20"></i>
                            </div>
                            <div>
                                <p class="text-muted smaller mb-0">Tanggal Terbit</p>
                                <p class="fw-bold mb-0 text-dark">{{ $berita->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-800 text-dark mb-3 border-bottom pb-2">Slug & SEO</h6>
                    <label class="text-muted smaller d-block mb-1">URL Slug</label>
                    <div class="bg-light p-2 rounded border smaller text-break">
                        /berita/{{ $berita->slug ?? 'slug-tidak-tersedia' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
<style>
    /* Styling khusus agar konten dari CKEditor tampil rapi */
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 20px 0;
    }
    .article-content h2, .article-content h3 {
        color: #212529;
        font-weight: 700;
        margin-top: 30px;
        margin-bottom: 15px;
    }
    .article-content p {
        margin-bottom: 20px;
    }
    .fw-800 { font-weight: 800; }
</style>
@endpush
@endsection