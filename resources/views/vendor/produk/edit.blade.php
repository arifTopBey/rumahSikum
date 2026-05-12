@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white pb-5">

    @if ($errors->any())
        <div class="alert alert-danger mt-4 rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>  
    @endif

    <form action="{{ route('vendor.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Edit Produk: {{ $produk->nama_produk }}</h4>
                    <p class="text-muted small mb-0">Perbarui informasi produk atau stok barang Anda.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('vendor.produk.index') }}" class="btn btn-light rounded-3 px-4 fw-bold border">Batal</a>
                    <button type="submit" class="btn btn-warning text-white rounded-3 px-4 fw-bold shadow">Simpan Perubahan</button>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-4 d-flex align-items-center gap-2 text-primary">
                        <i data-lucide="package" size="18"></i> Informasi Detail Produk
                    </h6>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control form-control-lg rounded-3 border-2" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Harga Produk (Rp)</label>
                            <input type="number" name="harga" class="form-control border-2 rounded-3" value="{{ old('harga', $produk->harga) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stok Produk</label>
                            <input type="number" name="stok" class="form-control border-2 rounded-3" value="{{ old('stok', $produk->stok) }}" required>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold">Deskripsi Produk</label>
                        <textarea id="editor" name="produk_deskripsi">{{ old('produk_deskripsi', $produk->produk_deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-800 mb-0 d-flex align-items-center gap-2 text-primary">
                            <i data-lucide="images" size="18"></i> Galeri Foto Produk
                        </h6>
                        <button type="button" class="btn btn-outline-primary btn-sm fw-bold rounded-2" id="add-photo-btn">
                            <i data-lucide="plus" size="14"></i> Tambah Foto Baru
                        </button>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        @foreach($produk->produkPhoto  as $photo)
                        <div class="col-md-3" id="old-photo-{{ $photo->id }}">
                            <div class="position-relative border rounded-3 p-1">
                                <img src="{{ route('showFoto.elearning.thumnail.private', $photo->photos_produks) }}" class="img-fluid rounded-2 object-fit-cover" style="height: 100px; width: 100%;">
                                <div class="form-check position-absolute top-0 end-0 m-1">
                                    <input class="form-check-input bg-danger border-danger" type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" title="Centang untuk hapus foto ini">
                                </div>
                                <span class="smaller text-danger d-block text-center mt-1">Hapus?</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div id="additional-photos-container" class="row g-3">
                        </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2 text-primary">
                        <i data-lucide="image" size="18"></i> Foto Utama (Thumbnail)
                    </h6>
                    <div class="thumbnail-upload-box border-2 border-dashed rounded-4 p-3 text-center bg-light position-relative" style="min-height: 200px;">
                        <img id="thumb-preview" src="{{ route('show.thumbnail.produk.private', $produk->produk_thumbnail) }}" class="img-fluid rounded-3 mb-2" style="max-height: 150px; width: 100%; object-fit: cover;">
                        <!-- <img id="thumb-preview" src="{{ asset('storage/' . $produk->produk_thumbnail) }}" class="img-fluid rounded-3 mb-2" style="max-height: 150px; width: 100%; object-fit: cover;"> -->
                        
                        <div id="thumb-placeholder" class="d-none">
                            <i data-lucide="camera" size="32" class="text-muted mb-2"></i>
                            <p class="smaller text-muted mb-0">Klik untuk ganti foto utama</p>
                        </div>
                        <input type="file" name="produk_thumbnail" class="position-absolute w-100 h-100 top-0 start-0 opacity-0" style="cursor: pointer;" onchange="previewThumbnail(this)">
                    </div>
                    <p class="smaller text-muted mt-2 mb-0 text-center">Biarkan kosong jika tidak ingin mengganti foto utama.</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2 text-primary">
                        <i data-lucide="tag" size="18"></i> Klasifikasi
                    </h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kategori Produk</label>
                        <select name="kategori_produk_id" class="form-select rounded-3 border-2" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $produk->kategori_produk_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">Status</label>
                        <select name="status_produk" class="form-select rounded-3 border-2">
                            <option value="1" {{ $produk->status_produk == 1 ? 'selected' : '' }}>Aktif / Jual</option>
                            <option value="0" {{ $produk->status_produk == 0 ? 'selected' : '' }}>Sembunyikan / Draft</option>
                        </select>
                    </div>
                </div>

                <div class="text-center">
                    <p class="smaller text-muted">Produk dibuat: {{ $produk->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    lucide.createIcons();
    ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });

    function previewThumbnail(input) {
        const preview = document.getElementById('thumb-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('add-photo-btn').addEventListener('click', function() {
        const container = document.getElementById('additional-photos-container');
        const photoId = Date.now();
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-3';
        col.id = `photo-row-${photoId}`;
        
        col.innerHTML = `
            <div class="border rounded-3 p-2 bg-light position-relative">
                <div class="ratio ratio-1x1 mb-2 bg-white rounded-2 overflow-hidden border">
                    <img id="preview-${photoId}" class="img-fluid object-fit-cover d-none">
                    <div id="placeholder-${photoId}" class="d-flex align-items-center justify-content-center h-100">
                        <i data-lucide="image" class="text-muted"></i>
                    </div>
                </div>
                <input type="file" name="photos_produks[]" class="form-control form-control-sm mb-1" onchange="previewGallery(this, ${photoId})" required>
                <button type="button" class="btn btn-link text-danger btn-sm p-0 w-100 text-decoration-none smaller" onclick="removePhoto(${photoId})">Hapus</button>
            </div>
        `;
        
        container.appendChild(col);
        lucide.createIcons();
    });

    function previewGallery(input, id) {
        const preview = document.getElementById(`preview-${id}`);
        const placeholder = document.getElementById(`placeholder-${id}`);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removePhoto(id) {
        document.getElementById(`photo-row-${id}`).remove();
    }
</script>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .ck-editor__editable { min-height: 250px; border-radius: 0 0 12px 12px !important; }
    .object-fit-cover { object-fit: cover; }
    .form-check-input:checked { background-color: #dc3545; border-color: #dc3545; }
</style>
@endsection