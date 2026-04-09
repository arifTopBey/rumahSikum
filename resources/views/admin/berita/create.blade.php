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


    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">

    <!-- $berita = new Berita();
            $berita->judul = $validated['judul'];
            $berita->deskripsi = $validated['deskripsi'];
            $berita->kategori_id = $validated['kategori_id'];
            $berita->user_id = $validated['user_id'];
            $berita->view = 0;
            $berita->is_published = $request->has('is_published') ? 1 : 0;
            $berita->gambar = $validated['gambar']->store('berita', 'public'); -->
        @csrf
        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Buat Berita Baru</h4>
                    <p class="text-muted small mb-0">Tulis dan terbitkan informasi terbaru untuk ekosistem UMKM.</p>
                </div>
               
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Judul Berita</label>
                        <input type="text" name="judul" class="form-control form-control-lg rounded-3 border-2" placeholder="Masukkan judul berita yang menarik..." required>
                    </div>

                    <!-- <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">URL Slug</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light">rumahsikum.id/berita/</span>
                            <input type="text" name="slug" class="form-control" placeholder="judul-berita-otomatis">
                        </div>
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Isi Berita</label>
                        <textarea id="editor" name="deskripsi" style="min-height: 400px;"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-center">
                    <h6 class="fw-800 text-start mb-3">Gambar Utama (Thumbnail)</h6>
                    <div class="border border-2 border-dashed rounded-4 p-4 mb-2" id="drop-area">
                        <i data-lucide="image" size="48" class="text-muted mb-2"></i>
                        <p class="smaller text-muted mb-2">Seret gambar ke sini atau klik untuk unggah</p>
                        <input type="file" name="gambar" id="thumbnail" class="form-control form-control-sm" accept="image/*">
                    </div>
                    <p class="smaller text-muted mb-0 text-start text-danger">(Maks. 2MB)</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3">Kategori</h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Pilih Kategori</label>
                        <select name="kategori_id" class="form-select rounded-3" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>   
                            @endforeach
                           
                        </select>
                    </div>
                    <!-- <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">Tags (Pisahkan dengan koma)</label>
                        <input type="text" name="tags" class="form-control rounded-3" placeholder="Contoh: kuliner, digital, ekspor">
                    </div> -->
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-800 mb-3">Pengaturan Lainnya</h6>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" checked>
                        <label class="form-check-label small fw-bold" for="is_published">Publish</label>
                    </div>
                    <!-- <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="allow_comments" name="allow_comments" checked>
                        <label class="form-check-label small fw-bold" for="allow_comments">Izinkan Komentar</label>
                    </div> -->

                     <div class="d-flex gap-2 mt-3">
                        <!-- <button type="submit" name="status" value="draft" class="btn btn-light rounded-pill px-4 fw-bold border">Simpan Draft</button> -->
                        <button type="submit" name="status" value="published" class="btn btn-primary rounded-pill px-4 fw-bold shadow">Terbitkan Sekarang</button>
                     </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    lucide.createIcons();

    // Inisialisasi CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
        })
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .ck-editor__editable {
        min-height: 400px;
        border-radius: 0 0 15px 15px !important;
    }
    .ck-toolbar {
        border-radius: 15px 15px 0 0 !important;
        background: #f8fafc !important;
    }
</style>
@endif
@endsection