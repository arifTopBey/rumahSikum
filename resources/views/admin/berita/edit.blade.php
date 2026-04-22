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

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Edit Berita</h4>
                    <p class="text-muted small mb-0">Perbarui informasi berita.</p>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Judul Berita</label>
                        <input type="text" 
                               name="judul" 
                               value="{{ old('judul', $berita->judul) }}"
                               class="form-control form-control-lg rounded-3 border-2" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Isi Berita</label>
                        <textarea id="editor" name="deskripsi">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-center">
                    <h6 class="fw-bold text-start mb-3"><span class="fw-bold text-muted">Ganti Dengan Klik Gambar</span></h6>

                    {{-- Preview gambar lama --}}
                    <!-- @if ($berita->gambar)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                 class="img-fluid rounded-3" style="max-height:200px;">
                            <img src="{{ route('showFoto.berita.private', $berita->gambar) }}" 
                                 class="img-fluid rounded-3" style="max-height:200px;">
                        </div>
                    @endif -->

                   <div class="border border-2 border-dashed rounded-4 p-4 mb-2 text-center position-relative">

                        <!-- Preview -->
                        <img id="preview-gambar" 
                            src="{{ $berita->gambar ? route('showFoto.berita.private', $berita->gambar) : '' }}" 
                            class="img-fluid rounded-3 mb-2 {{ $berita->gambar ? '' : 'd-none' }}" 
                            style="max-height:200px; object-fit:cover;" />

                        <!-- Placeholder -->
                        <div id="placeholder-gambar" class="{{ $berita->gambar ? 'd-none' : '' }}">
                            <i data-lucide="image" size="48" class="text-muted mb-2"></i>
                            <p class="smaller text-muted mb-2">Upload atau ganti gambar</p>
                        </div>

                        <!-- Input -->
                        <input 
                            type="file" 
                            id="input-gambar"
                            name="gambar" 
                            accept="image/*"
                            class="position-absolute w-100 h-100 top-0 start-0 opacity-0"
                            style="cursor: pointer;">
                </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3">Kategori</h6>

                    <select name="kategori_id" class="form-select rounded-3" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $berita->kategori_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>   
                        @endforeach
                    </select>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-800 mb-3">Pengaturan</h6>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="is_published"
                               {{ $berita->is_published ? 'checked' : '' }}>
                        <label class="form-check-label small fw-bold">Publish</label>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow">
                            Update Berita
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    lucide.createIcons();

    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => console.error(error));
</script>

<style>
    .ck-editor__editable {
        min-height: 400px;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('input-gambar');
    const preview = document.getElementById('preview-gambar');
    const placeholder = document.getElementById('placeholder-gambar');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            }

            reader.readAsDataURL(file);
        }
    });

});
</script>
@endsection