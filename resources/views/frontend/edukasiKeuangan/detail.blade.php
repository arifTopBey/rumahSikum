@extends('frontend.main.index')

@section('content')

<div class="container article-detail-wrapper">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="">Edukasi Keuangan</a></li>
            <li class="breadcrumb-item active fw-bold text-primary">Detail Artikel</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2 fw-bold mb-3 text-uppercase small">Tips Akuntansi</span>
            <h1 class="fw-800 display-5 mb-4">Cara Memisahkan Rekening Pribadi & Usaha bagi Pelaku UMKM</h1>
            
            <div class="d-flex align-items-center gap-4 mb-5 text-muted small fw-semibold">
                <div class="d-flex align-items-center gap-2">
                    <i data-lucide="calendar" size="16"></i> 02 April 2026
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i data-lucide="clock" size="16"></i> 5 Menit Baca
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i data-lucide="eye" size="16"></i> 1.240 Dilihat
                </div>
            </div>

            <div class="featured-image-wrapper">
                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1200" class="img-fluid w-100" alt="Finance Image">
            </div>

            <div class="article-content">
                <p class="lead fw-bold text-dark">Salah satu penyebab utama UMKM sulit berkembang adalah manajemen arus kas yang berantakan karena mencampuradukkan uang rumah tangga dengan uang bisnis.</p>
                
                <p>Bagi pelaku UMKM, memisahkan rekening pribadi dan usaha bukan hanya soal kerapihan administrasi, melainkan strategi bertahan hidup. Tanpa pemisahan yang jelas, Anda tidak akan pernah tahu apakah bisnis Anda benar-benar menghasilkan laba atau justru sedang "memakan" modal sendiri.</p>

                <h2>1. Mengapa Harus Dipisah?</h2>
                <p>Ada tiga alasan fundamental mengapa pemisahan ini wajib hukumnya:</p>
                <ul>
                    <li><strong>Transparansi Laba:</strong> Anda bisa melihat dengan jelas berapa uang yang benar-benar masuk dari hasil jualan.</li>
                    <li><strong>Memudahkan Evaluasi:</strong> Saat ingin mengajukan pinjaman ke bank (seperti KUR), mutasi rekening yang rapi akan menjadi poin plus.</li>
                    <li><strong>Disiplin Gaji:</strong> Anda bisa mulai menggaji diri sendiri layaknya karyawan, sehingga keuangan pribadi tetap terkontrol.</li>
                </ul>

                <h2>2. Langkah Praktis Memulai</h2>
                <p>Jangan tunggu bisnis besar untuk membuka rekening kedua. Berikut caranya:</p>
                <p>Gunakan dua bank berbeda atau buat "kantong" digital di aplikasi perbankan Anda. Berikan label "Modal & Putaran" pada satu rekening, dan "Kebutuhan Pribadi" pada yang lainnya.</p>

                <blockquote>
                    <div class="p-4 bg-light border-start border-primary border-4 rounded-3 my-4 italic text-dark">
                        "Uang bisnis bukan uang saku. Perlakukan setiap rupiah di rekening bisnis sebagai titipan untuk pertumbuhan usaha Anda."
                    </div>
                </blockquote>
            </div>

            <div class="author-box">
                <img src="https://i.pravatar.cc/100?u=finance" class="rounded-circle" width="60" alt="Author">
                <div>
                    <h6 class="fw-800 mb-1">Dibuat oleh Tim Finansial RumahSikum</h6>
                    <p class="text-muted small mb-0">Spesialis edukasi manajemen keuangan untuk UMKM Kabupaten Tangerang.</p>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3 py-4 border-top">
                <span class="fw-bold small">Bagikan Artikel:</span>
                <button class="btn btn-light rounded-circle p-2"><i data-lucide="facebook" size="18"></i></button>
                <button class="btn btn-light rounded-circle p-2"><i data-lucide="twitter" size="18"></i></button>
                <button class="btn btn-light rounded-circle p-2"><i data-lucide="link" size="18"></i></button>
            </div>
        </div>

        <!-- <div class="col-lg-4">
            <div class="sidebar-newsletter shadow-sm border-0">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white d-inline-flex p-3 rounded-circle mb-3">
                        <i data-lucide="mail" size="24"></i>
                    </div>
                    <h5 class="fw-800">Dapatkan Tips Keuangan Mingguan</h5>
                    <p class="small text-muted">Bergabung dengan 5.000+ UMKM lainnya yang sudah belajar manajemen uang.</p>
                </div>
                <form>
                    <input type="email" class="form-control rounded-pill border-0 py-3 px-4 mb-3" placeholder="Alamat Email Anda">
                    <button class="btn btn-primary w-100 rounded-pill py-3 fw-bold">Berlangganan</button>
                </form>
            </div>

            <div class="mt-5 px-3">
                <h6 class="fw-800 mb-4">Artikel Terkait</h6>
                <div class="mb-4">
                    <a href="#" class="text-decoration-none group">
                        <h6 class="fw-bold text-dark small mb-1 hover-primary">Cara Menghitung HPP dengan Akurat</h6>
                        <span class="text-muted smaller">3 Menit Baca</span>
                    </a>
                </div>
                <div class="mb-4">
                    <a href="#" class="text-decoration-none">
                        <h6 class="fw-bold text-dark small mb-1">Tips Mengajukan KUR di Tahun 2026</h6>
                        <span class="text-muted smaller">7 Menit Baca</span>
                    </a>
                </div>
            </div>
        </div> -->
    </div>
</div>



@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection