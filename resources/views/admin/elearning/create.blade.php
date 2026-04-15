@extends('admin.main.main')

@section('content')

<div class="container-fluid px-5 bg-white">


     @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>  
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
     @endif

     @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
     @endif

      @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
        
    @endif

    <form action="{{ route('admin.elearning.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Tambah Materi Akademi Digital</h4>
                    <p class="text-muted small mb-0">Publikasikan konten video atau e-book untuk akses mandiri UMKM.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light rounded-pill px-4 fw-bold border">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow">Simpan & Publikasikan</button>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Judul Kelas E-Learning</label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3 border-2" placeholder="Contoh: Optimasi Penjualan Melalui TikTok Shop" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-block">Thumbnail Materi</label>
                        <div class="border border-2 border-dashed rounded-4 p-4 text-center bg-light position-relative">
                            <i data-lucide="image" size="32" class="text-muted mb-2"></i>
                            <p class="smaller text-muted mb-0">Klik atau tarik gambar ke sini (Rasio 16:9)</p>
                            <input type="file" name="thumbnail" class="position-absolute w-100 h-100 top-0 start-0 opacity-0" style="cursor: pointer;">
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold text-dark">Deskripsi & Tujuan Pembelajaran</label>
                        <textarea id="editor" name="deskripsi"></textarea>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="content" size="18" class="text-primary"></i> Konten Utama
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Link Video Utama (YouTube/Vimeo)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-2"><i data-lucide="youtube" size="16"></i></span>
                                <input type="url" name="link_youtube" class="form-control border-2" placeholder="https://youtube.com/...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Atau Upload E-Book (PDF) Optional</label>
                            <input type="file" name="pdf" class="form-control border-2" accept="application/pdf">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="list" size="18" class="text-primary"></i> Klasifikasi
                    </h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kategori</label>
                        <select name="kategori_elearning_id" class="form-select rounded-3">
                            <option>Pilih Kategori</option>
                             @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>   
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">Level</label>
                        <select name="level" class="form-select rounded-3">
                            <option value="semua level">Semua Level</option>
                            <option value="pemula">Pemula</option>
                            <option value="mahir">Mahir</option>
                        </select>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="info" size="18" class="text-primary"></i> Metadata
                    </h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Estimasi Waktu Belajar</label>
                        <div class="input-group">
                            <input type="number" name="durasi" class="form-control rounded-start-3" placeholder="Contoh: 120">
                            <span class="input-group-text">Menit</span>
                        </div>
                    </div>
                    <!-- <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">Mentor Pengampu</label>
                        <input type="text" name="mentor" class="form-control rounded-3" placeholder="Nama Mentor">
                    </div> -->
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-center bg-primary bg-opacity-10 border border-primary border-opacity-25">
                    <div class="mx-auto bg-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px;">
                        <i data-lucide="user-plus" size="32" class="text-primary"></i>
                    </div>
                    <h6 class="fw-800 mb-1">Informasi Mentor</h6>
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-bold text-muted">Foto Mentor</label>
                        <input type="file" name="photo_mentor" class="form-control rounded-3 border-0 shadow-sm" >
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-bold text-muted">Nama Mentor / Pengajar</label>
                        <input type="text" name="nama_mentor" class="form-control rounded-3 border-0 shadow-sm" placeholder="Contoh: Dr. Budi Santoso">
                    </div>
                    <div class="text-start">
                        <label class="form-label small fw-bold text-muted">Bidang Mentor</label>
                        <input type="text" name="bidang_menthor" class="form-control rounded-3 border-0 shadow-sm" placeholder="Contoh: Pakar Keuangan UMKM">
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary bg-opacity-10">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_publish" id="isActive" checked>
                        <label class="form-check-label fw-bold text-primary" for="isActive">Publish E-learning</label>
                    </div>
                    <p class="smaller text-muted mb-0">Jika dinonaktifkan, materi tidak akan muncul di katalog publik.</p>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    lucide.createIcons();
    ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });
</script>
<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .ck-editor__editable { min-height: 250px; border-radius: 0 0 12px 12px !important; }
</style>

@endsection