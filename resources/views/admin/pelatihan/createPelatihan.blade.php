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

    <form action="{{ route('admin.pelatihan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 style="color: #a82282;" class="fw-800 mb-1">Buat Pelatihan Baru</h4>
                    <p class="text-muted small mb-0">Atur jadwal pelatihan, webinar, atau bazar untuk mitra UMKM.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light rounded-pill px-4 fw-bold border">Batal</a>
                    <button  type="submit" style="background-color: #a82282; color: white" class="btn rounded-pill px-4 fw-bold shadow">Simpan & Publikasikan</button>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Nama / Judul Pelatihan</label>
                        <input type="text" name="judul" class="form-control form-control-lg rounded-3 border-2" placeholder="Contoh: Pelatihan Digital Marketing UMKM 2026" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-block">Banner Pelatihan</label>

                        <!-- <div class="border border-2 border-dashed rounded-4 p-5 text-center position-relative" id="drop-area">
                            <i data-lucide="image" size="40" class="text-muted mb-2"></i>
                            <p class="smaller text-muted mb-3">Unggah gambar poster acara (Rekomendasi 16:9)</p>
                            <input type="file" name="gambar" class="form-control border-0 position-absolute w-100 h-100 top-0 start-0 opacity-0" style="cursor: pointer;">
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-4">Pilih File</button>
                        </div> -->
                        <div class="border border-2 border-dashed rounded-4 p-5 text-center position-relative">

                            <!-- Preview -->
                            <img id="preview-acara"
                                src=""
                                class="img-fluid rounded-3 mb-3 d-none"
                                style="max-height:250px; object-fit:cover;" />

                            <!-- Placeholder -->
                            <div id="placeholder-acara">
                                <i data-lucide="image" size="40" class="text-muted mb-2 mx-auto"></i>
                                <p class="smaller text-muted mb-3">Unggah gambar poster Pelatihan (Rekomendasi 16:9)</p>
                            </div>

                            <!-- Input -->
                            <input
                                type="file"
                                id="input-acara"
                                name="gambar"
                                accept="image/*"
                                class="position-absolute w-100 h-100 top-0 start-0 opacity-0"
                                style="cursor: pointer;">

                            <button id="buttonThumbanil" style="background-color: #a82282; color: white" type="button"  class="btn btn-sm rounded-pill px-4">
                                Pilih File
                            </button>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold text-dark">Deskripsi & Detail Pelatihan</label>
                        <textarea id="editor" name="deskripsi" style="min-height: 300px;"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="clock" size="18" style="color: #a82282;" class=""></i> Waktu & Pelaksanaan
                    </h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Tanggal Pelatihan</label>
                        <input type="date" name="tanggal_acara" class="form-control rounded-3">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Jam Mulai</label>
                            <input type="time" name="waktu_acara_mulai" class="form-control rounded-3">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Jam Selesai</label>
                            <input type="time" name="waktu_acara_selesai" class="form-control rounded-3">
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="map-pin" size="18" style="color: #a82282;" class=""></i> Lokasi Pelatihan
                    </h6>
                    <!-- <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Tipe Acara</label>
                        <select name="tipe" class="form-select rounded-3">
                            <option value="offline">Tatap Muka (Offline)</option>
                            <option value="online">Webinar (Online)</option>
                        </select>
                    </div> -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Lokasi</label>
                        <textarea name="lokasi" class="form-control rounded-3" rows="2" placeholder="Lokasi Tempat Pelatihan"></textarea>
                    </div>
                    <!-- <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">Kuota Peserta</label>
                        <div class="input-group">
                            <input type="number" name="kuota" class="form-control rounded-3" placeholder="Contoh: 100">
                            <span class="input-group-text bg-light smaller fw-bold">Orang</span>
                        </div>
                    </div> -->
                </div>

                <!-- <div class="card border-0 shadow-sm rounded-4 p-4">

                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="tag" size="18" class="text-primary"></i> Kategori Acara
                    </h6>
                    <select name="kategori_acara_id" class="form-select rounded-3">
                        <option value="">Pilih Kategori Acara</option>
                        @foreach($categories as $category)
                            <option class="text-white" value="{{ $category->id }}">{{ $category->nama }}</option>
                        @endforeach
                    </select>
                </div> -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3">Kategori</h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Pilih Kategori</label>
                        <select name="kategori_pelatihan_id" class="form-select rounded-3" required>
                            <option value="" class="fw-bold text-muted">-- Pilih Kategori Pelatihan --</option>
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
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    lucide.createIcons();

    // Editor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .fw-800 {
        font-weight: 800;
    }

    .ck-editor__editable {
        min-height: 250px;
        border-radius: 0 0 12px 12px !important;
    }

    .ck-toolbar {
        border-radius: 12px 12px 0 0 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const input = document.getElementById('input-acara');
        const preview = document.getElementById('preview-acara');
        const buttonThumbanil = document.getElementById('buttonThumbanil');
        const placeholder = document.getElementById('placeholder-acara');

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                    buttonThumbanil.classList.add('d-none');
                }

                reader.readAsDataURL(file);
            }
        });

    });
</script>
@endsection