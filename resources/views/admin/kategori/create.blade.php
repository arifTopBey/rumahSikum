@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <div class="row py-5">
        <div class="col-md-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Kategori Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-800 text-dark mb-1">Tambah Kategori Baru</h4>
                    <p class="text-muted small mb-0">Buat klasifikasi baru untuk mengorganisir berita dan artikel.</p>
                </div>
                <a href="#" class="btn btn-light rounded-pill px-4 border fw-bold">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <form action="#" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Nama Kategori</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg rounded-3" 
                                   placeholder="Contoh: Tips Pembiayaan UMKM" required>
                            <div class="form-text mt-2">Gunakan nama yang unik dan mudah dipahami oleh pembaca.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Slug URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted small">rumahsikum.id/berita/kategori/</span>
                                <input type="text" id="slug" name="slug" class="form-control rounded-3 border-start-0 bg-light" 
                                       placeholder="tips-pembiayaan-umkm" readonly>
                            </div>
                            <div class="form-text">Slug akan terisi otomatis berdasarkan nama kategori untuk kebutuhan SEO.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Deskripsi (Opsional)</label>
                            <textarea name="description" class="form-control rounded-3" rows="4" 
                                      placeholder="Jelaskan secara singkat topik apa saja yang dibahas dalam kategori ini..."></textarea>
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-light rounded-pill px-4 fw-bold">Reset Form</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow">
                                <i data-lucide="save" size="18" class="me-1"></i> Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary bg-opacity-10 mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 text-primary">
                    <i data-lucide="help-circle" size="20"></i>
                    <h6 class="fw-800 mb-0">Bantuan Penulisan</h6>
                </div>
                <ul class="smaller text-dark opacity-75 ps-3 mb-0">
                    <li class="mb-2">Gunakan maksimal 2-3 kata untuk nama kategori agar tetap rapi di menu navigasi.</li>
                    <li class="mb-2">Deskripsi membantu mesin pencari (Google) memahami isi kategori Anda.</li>
                    <li>Slug akan otomatis dikonversi menjadi huruf kecil dan menggunakan tanda hubung (-).</li>
                </ul>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <i data-lucide="layers" size="40" class="text-muted mb-3 mx-auto"></i>
                <h6 class="fw-bold mb-1">Total Kategori Saat Ini</h6>
                <p class="display-6 fw-800 text-primary mb-0">12</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();

    // Script sederhana untuk auto-generate slug
    const nameInput = document.querySelector('#name');
    const slugInput = document.querySelector('#slug');

    nameInput.addEventListener('keyup', function() {
        let preslug = nameInput.value.toLowerCase();
        preslug = preslug.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                         .replace(/\s+/g, '-')       // collapse whitespace and replace by -
                         .replace(/-+/g, '-');       // collapse dashes
        slugInput.value = preslug;
    });
</script>
@endpush
@endsection