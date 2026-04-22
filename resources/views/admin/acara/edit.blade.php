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

    <form action="{{ route('admin.acara.update', $acara->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row py-5">

            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Edit Acara</h4>
                    <p class="text-muted small mb-0">Perbarui informasi acara.</p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.acara.index') }}" class="btn btn-light rounded-pill px-4 fw-bold border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow">
                        Update Acara
                    </button>
                </div>
            </div>


            {{-- LEFT --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

                    {{-- JUDUL --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">
                            Nama / Judul Acara
                        </label>

                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul', $acara->judul) }}"
                            class="form-control form-control-lg rounded-3 border-2"
                            required>
                    </div>


                    {{-- GAMBAR --}}
                    <div class="mb-4">

                        <label class="form-label fw-bold text-dark d-block">
                            Banner Acara
                        </label>

                        <!-- @if($acara->gambar)
                            <div class="mb-3">
                                <img
                                    src="{{ asset('storage/'.$acara->gambar) }}"
                                    class="img-fluid rounded-3"
                                >
                                <img
                                    src="{{ route('showFoto.acara.private', $acara->gambar) }}"
                                    class="img-fluid rounded-3"
                                >
                            </div>
                        @endif

                        <input
                            type="file"
                            name="gambar"
                            class="form-control rounded-3"
                        >

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti banner
                        </small> -->
                        <div class="border border-2 border-dashed rounded-4 p-4 text-center position-relative">

                            <!-- Preview -->
                            <img id="preview-acara"
                                src="{{ $acara->gambar ? route('showFoto.acara.private', $acara->gambar) : '' }}"
                                class="img-fluid rounded-3 mb-3 {{ $acara->gambar ? '' : 'd-none' }}"
                                style="max-height:250px; object-fit:cover;" />

                            <!-- Placeholder -->
                            <div id="placeholder-acara" class="{{ $acara->gambar ? 'd-none' : '' }}">
                                <i data-lucide="image" size="40" class="text-muted mb-2"></i>
                                <p class="smaller text-muted mb-2">Upload atau ganti banner acara</p>
                            </div>

                            <!-- Input -->
                            <input
                                type="file"
                                id="input-acara"
                                name="gambar"
                                accept="image/*"
                                class="position-absolute w-100 h-100 top-0 start-0 opacity-0"
                                style="cursor: pointer;">

                        </div>

                        <small class="text-muted fw-bold">
                           Klik Gambar untuk mengganti dan Kosongkan jika tidak ingin mengganti banner
                        </small>

                    </div>


                    {{-- DESKRIPSI --}}
                    <div>

                        <label class="form-label fw-bold text-dark">
                            Deskripsi & Detail Acara
                        </label>

                        <textarea
                            id="editor"
                            name="deskripsi">{{ old('deskripsi', $acara->deskripsi) }}</textarea>

                    </div>

                </div>

            </div>



            {{-- RIGHT --}}
            <div class="col-lg-4">


                {{-- WAKTU --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

                    <h6 class="fw-800 mb-3">
                        Waktu & Pelaksanaan
                    </h6>

                    <div class="mb-3">

                        <label class="form-label small fw-bold text-muted">
                            Tanggal Acara
                        </label>

                        <input
                            type="date"
                            name="tanggal_acara"
                            value="{{ old('tanggal_acara', $acara->tanggal_acara) }}"
                            class="form-control rounded-3">

                    </div>


                    <div class="row">

                        <div class="col-6">

                            <label class="form-label small fw-bold text-muted">
                                Jam Mulai
                            </label>

                            <input
                                type="time"
                                name="waktu_acara_mulai"
                                value="{{ old('waktu_acara_mulai', \Carbon\Carbon::parse($acara->waktu_acara_mulai)->format('H:i')) }}"
                                class="form-control rounded-3">

                        </div>


                        <div class="col-6">

                            <label class="form-label small fw-bold text-muted">
                                Jam Selesai
                            </label>

                            <input
                                type="time"
                                name="waktu_acara_selesai"
                                value="{{ old('waktu_acara_selesai', \Carbon\Carbon::parse($acara->waktu_acara_selesai)->format('H:i')) }}"
                                class="form-control rounded-3">

                        </div>

                    </div>

                </div>



                {{-- LOKASI --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

                    <h6 class="fw-800 mb-3">
                        Lokasi & Kapasitas
                    </h6>


                    <div class="mb-3">

                        <label class="form-label small fw-bold text-muted">
                            Lokasi
                        </label>

                        <textarea
                            name="lokasi"
                            rows="2"
                            class="form-control rounded-3">{{ old('lokasi', $acara->lokasi) }}</textarea>

                    </div>



                    <div>

                        <label class="form-label small fw-bold text-muted">
                            Kuota Peserta
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                name="kuota"
                                value="{{ old('kuota', $acara->kuota) }}"
                                class="form-control rounded-3">

                            <span class="input-group-text">
                                Orang
                            </span>

                        </div>

                    </div>

                </div>



                {{-- KATEGORI --}}
                <div class="card border-0 shadow-sm rounded-4 p-4">

                    <h6 class="fw-800 mb-3">
                        Kategori
                    </h6>

                    <select
                        name="kategori_acara_id"
                        class="form-select rounded-3"
                        required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('kategori_acara_id', $acara->kategori_acara_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>

                        @endforeach

                    </select>

                </div>


            </div>

        </div>

    </form>

</div>



{{-- CKEDITOR --}}
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    lucide.createIcons();
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
        const placeholder = document.getElementById('placeholder-acara');

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {

                // validasi optional (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran gambar maksimal 2MB');
                    input.value = '';
                    return;
                }

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