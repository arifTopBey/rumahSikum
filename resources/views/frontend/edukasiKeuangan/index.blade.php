@extends('frontend.main.index')

@section('content')


<div class="container finance-wrapper">
    <div class="finance-header shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill fw-bold text-uppercase" style="letter-spacing: 1px;">Finance Smart</span>
                <h1 class="fw-800 display-5 mb-3">Kelola Keuangan UMKM Lebih Profesional</h1>
                <p class="lead opacity-75 mb-0">Pelajari cara mencatat arus kas, menghitung harga pokok produksi (HPP), hingga akses permodalan yang aman.</p>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <i data-lucide="wallet" size="140" class="text-primary opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <h4 class="fw-800 mb-4 d-flex align-items-center gap-2">
                <i data-lucide="book-open" class="text-primary"></i> Panduan Terbaru
            </h4>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="article-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=600" class="article-img">
                        <div class="p-4">
                            <span class="text-primary small fw-bold text-uppercase">Tips Akuntansi</span>
                            <h5 class="fw-800 mt-2">Cara Memisahkan Rekening Pribadi & Usaha</h5>
                            <p class="text-muted small">Kesalahan fatal yang sering dilakukan UMKM adalah mencampur uang belanja dapur dengan uang modal...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Baca Selengkapnya <i data-lucide="arrow-right" size="14"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="article-card shadow-sm">
                        <div class="video-thumb">
                            <img src="https://images.unsplash.com/photo-1579621970795-87faff2f9160?w=600" class="article-img">
                            <div class="play-btn"><i data-lucide="play" fill="currentColor"></i></div>
                        </div>
                        <div class="p-4">
                            <span class="text-success small fw-bold text-uppercase">Video Tutorial</span>
                            <h5 class="fw-800 mt-2">Tutorial Mencatat Arus Kas di Smartphone</h5>
                            <p class="text-muted small">Panduan menggunakan aplikasi pencatatan keuangan gratis agar bisnis Anda terpantau setiap hari.</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Tonton Video <i data-lucide="play-circle" size="14"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="fw-800 mb-4">Materi Downloadable</h4>
            <div class="list-group border-0 shadow-sm rounded-4 overflow-hidden">
                <a href="#" class="list-group-item list-group-item-action p-3 d-flex align-items-center justify-content-between border-0 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-light p-2 rounded-3 text-danger"><i data-lucide="file-text"></i></div>
                        <div>
                            <p class="mb-0 fw-bold">Template Excel Arus Kas (Sederhana)</p>
                            <span class="smaller text-muted">PDF • 1.2 MB</span>
                        </div>
                    </div>
                    <i data-lucide="download" size="18" class="text-muted"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action p-3 d-flex align-items-center justify-content-between border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-light p-2 rounded-3 text-success"><i data-lucide="file-spreadsheet"></i></div>
                        <div>
                            <p class="mb-0 fw-bold">Kalkulator HPP Produk Kuliner</p>
                            <span class="smaller text-muted">XLSX • 2.5 MB</span>
                        </div>
                    </div>
                    <i data-lucide="download" size="18" class="text-muted"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="calc-box shadow-sm">
                <h5 class="fw-800 mb-4 d-flex align-items-center gap-2">
                    <i data-lucide="calculator" class="text-primary"></i> Cek Kesehatan Bisnis
                </h5>
                <p class="small text-muted mb-4">Hitung margin keuntungan kotor produk Anda secara cepat.</p>
                
                <div class="mb-3">
                    <label class="form-label-custom">Harga Jual (Rp)</label>
                    <input type="number" class="form-control form-control-finance" placeholder="Contoh: 50000">
                </div>
                <div class="mb-4">
                    <label class="form-label-custom">Modal Produksi / HPP (Rp)</label>
                    <input type="number" class="form-control form-control-finance" placeholder="Contoh: 30000">
                </div>
                
                <div class="bg-light rounded-4 p-3 mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small text-muted">Keuntungan:</span>
                        <span class="fw-bold text-success">Rp 20.000</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="small text-muted">Margin:</span>
                        <span class="fw-bold text-primary">40%</span>
                    </div>
                </div>

                <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow">
                    Hitung Detail <i data-lucide="chevron-right" size="16"></i>
                </button>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-primary text-white text-center shadow-sm">
                <h6 class="fw-bold">Butuh Pinjaman Modal?</h6>
                <p class="smaller opacity-75">Cek program Kredit Usaha Rakyat (KUR) khusus UMKM Tangerang.</p>
                <button class="btn btn-light btn-sm rounded-pill px-4 fw-bold">Info Selengkapnya</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection