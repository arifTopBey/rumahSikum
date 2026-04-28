@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Buat Pelatihan Baru</h4>
                    <p class="text-muted small mb-0">Susun kurikulum dan materi edukasi untuk meningkatkan kapasitas UMKM.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light rounded-pill px-4 fw-bold border">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow">Simpan Pelatihan</button>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Nama Materi Pelatihan</label>
                        <input type="text" name="nama_pelatihan" class="form-control form-control-lg rounded-3 border-2" placeholder="Contoh: Dasar-Dasar Akuntansi untuk Usaha Kecil" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold text-dark">Deskripsi & Silabus Pembelajaran</label>
                        <textarea id="editor" name="deskripsi" style="min-height: 400px;"></textarea>
                        <div class="form-text mt-2">Sebutkan poin-poin materi yang akan dipelajari oleh peserta.</div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="file-text" size="18" class="text-primary"></i> Materi Unduhan (Opsional)
                    </h6>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">File Modul (PDF/PPT)</label>
                        <input type="file" name="modul_file" class="form-control rounded-3">
                        <p class="smaller text-muted mt-2 mb-0 text-danger">*Maksimal 10MB</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-center bg-primary bg-opacity-10 border border-primary border-opacity-25">
                    <div class="mx-auto bg-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px;">
                        <i data-lucide="user-plus" size="32" class="text-primary"></i>
                    </div>
                    <h6 class="fw-800 mb-1">Informasi Mentor</h6>
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-bold text-muted">Nama Mentor / Pengajar</label>
                        <input type="text" name="nama_mentor" class="form-control rounded-3 border-0 shadow-sm" placeholder="Contoh: Dr. Budi Santoso">
                    </div>
                    <div class="text-start">
                        <label class="form-label small fw-bold text-muted">Keahlian Mentor</label>
                        <input type="text" name="keahlian_mentor" class="form-control rounded-3 border-0 shadow-sm" placeholder="Contoh: Pakar Keuangan UMKM">
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="layers" size="18" class="text-primary"></i> Klasifikasi
                    </h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kategori Pelatihan</label>
                        <select name="kategori_id" class="form-select rounded-3">
                            <option value="1">Legalitas & Perizinan</option>
                            <option value="2">Pemasaran Digital</option>
                            <option value="3">Manajemen Keuangan</option>
                            <option value="4">Produksi & Operasional</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">Tingkat Kesulitan</label>
                        <div class="d-flex gap-2">
                            <div class="form-check flex-fill p-0">
                                <input type="radio" class="btn-check" name="level" id="lv1" value="Pemula" checked>
                                <label class="btn btn-outline-primary btn-sm w-100 rounded-pill" for="lv1">Pemula</label>
                            </div>
                            <div class="form-check flex-fill p-0">
                                <input type="radio" class="btn-check" name="level" id="lv2" value="Menengah">
                                <label class="btn btn-outline-primary btn-sm w-100 rounded-pill" for="lv2">Menengah</label>
                            </div>
                            <div class="form-check flex-fill p-0">
                                <input type="radio" class="btn-check" name="level" id="lv3" value="Mahir">
                                <label class="btn btn-outline-primary btn-sm w-100 rounded-pill" for="lv3">Mahir</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="award" size="18" class="text-primary"></i> Pengaturan Tambahan
                    </h6>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kuota Peserta</label>
                        <input type="number" name="kuota" class="form-control rounded-3" placeholder="Contoh: 50">
                    </div>
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox" id="generate_certificate" name="generate_certificate" checked>
                        <label class="form-check-label small fw-bold" for="generate_certificate">Terbitkan E-Sertifikat Otomatis</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    lucide.createIcons();

    // Inisialisasi CKEditor untuk Silabus
    ClassicEditor
        .create(document.querySelector('#editor'), {
            placeholder: 'Tuliskan rincian materi, modul 1, modul 2, dan seterusnya...'
        })
        .catch(error => { console.error(error); });
</script>
<style>
    .fw-800 { font-weight: 800; }
    .ck-editor__editable { min-height: 350px; border-radius: 0 0 15px 15px !important; border-color: #dee2e6 !important; }
    .ck-toolbar { border-radius: 15px 15px 0 0 !important; border-color: #dee2e6 !important; background: #f8fafc !important; }
    .btn-check:checked + .btn-outline-primary { background-color: #4361ee; border-color: #4361ee; color: white; }
</style>

@endsection