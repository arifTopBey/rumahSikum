<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sikum | Digitalisasi UMKM Tangerang</title>
    <link rel="icon" href="{{ asset('image/icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary-color: #0d6efd;
            --accent-color: #00d2ff;
            --dark-bg: #0f172a;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* Modern Floating Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        /* Hero Section with Mesh Gradient */
        .hero-gradient {
            background: radial-gradient(at 0% 0%, rgba(13, 110, 253, 0.15) 0, transparent 50%), 
                        radial-gradient(at 100% 0%, rgba(0, 210, 255, 0.1) 0, transparent 50%);
            padding: 120px 0 80px;
        }

        .hero-title { font-weight: 800; font-size: 3.5rem; line-height: 1.2; color: var(--dark-bg); }
        .text-gradient { background: linear-gradient(90deg, #0d6efd, #00d2ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* Bento Grid Kategori */
        .bento-card {
            border-radius: 24px;
            border: none;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            height: 100%;
        }
        .bento-card:hover { transform: scale(1.02); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        
        .bg-blue { background: #0d6efd; color: white; }
        .bg-orange { background: #ff7e5f; color: white; }

        /* Stats Section */
        .stat-box { border-left: 4px solid var(--primary-color); padding-left: 20px; }

        /* Product Card */
        .product-card {
            border-radius: 20px;
            border: 1px solid #edf2f7;
            background: white;
            transition: 0.3s;
        }
        .product-card .img-container {
            border-radius: 16px;
            overflow: hidden;
            margin: 10px;
        }
        .product-card:hover { border-color: var(--primary-color); }

        /* Footer */
        .footer-custom { background: var(--dark-bg); color: #94a3b8; padding: 80px 0 30px; }
        .footer-link { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        .footer-link:hover { color: white; padding-left: 5px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <span class="text-primary">Rumah</span>Sikum
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto fw-semibold">
                    <li class="nav-item"><a class="nav-link px-3" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">Marketplace</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">Koperasi</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">E-Learning</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-4">Login</a>
                    <a href="#" class="btn btn-primary rounded-pill px-4 shadow">Gabung UMKM</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">🚀 Era Digital UMKM Tangerang</span>
                    <h1 class="hero-title mb-4">Berdayakan <span class="text-gradient">Ekonomi Lokal</span> Dalam Satu Genggaman.</h1>
                    <p class="lead text-muted mb-5">Platform terintegrasi untuk pendataan, pemasaran produk unggulan, dan penguatan koperasi di Kabupaten Tangerang.</p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-primary btn-lg rounded-pill px-5">Jelajahi Produk</button>
                        <button class="btn btn-outline-dark btn-lg rounded-pill px-4"><i data-lucide="play-circle" class="me-2"></i>Video Profil</button>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="col-4 stat-box">
                            <h3 class="fw-bold mb-0 text-dark">245K+</h3>
                            <small class="text-muted">UMKM Terdaftar</small>
                        </div>
                        <!-- <div class="col-4 stat-box border-info">
                            <h3 class="fw-bold mb-0 text-dark">120+</h3>
                            <small class="text-muted">Koperasi Aktif</small>
                        </div> -->
                        <div class="col-4 stat-box border-warning">
                            <h3 class="fw-bold mb-0 text-dark">31</h3>
                            <small class="text-muted">Kecamatan</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-flex justify-content-center align-items-center px-5  d-lg-block ">
                    <img style="height: 600px;" src="{{ asset('image/icon.png') }}" class="ms-5 img-fluid mx-auto" height="100" alt="Hero Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card bento-card bg-blue p-4">
                        <i data-lucide="shopping-bag" class="mb-3" size="40"></i>
                        <h3>Marketplace <br>Lokal</h3>
                        <p class="opacity-75">Beli produk terbaik langsung dari tangan pengrajin lokal.</p>
                        <a href="#" class="btn btn-light btn-sm rounded-pill mt-3 w-50">Buka Toko</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card bento-card bg-white p-4 border shadow-sm">
                                <i data-lucide="users" class="text-primary mb-3"></i>
                                <h5>Legalitas Koperasi</h5>
                                <p class="text-muted small">Urus perizinan dan manajemen koperasi lebih transparan.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bento-card bg-orange p-4">
                                <i data-lucide="trending-up" class="mb-3"></i>
                                <h5>Pelatihan Gratis</h5>
                                <p class="small">Akses webinar dan tutorial digital marketing untuk UMKM.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card bento-card bg-white p-4 border shadow-sm d-flex flex-row align-items-center">
                                <div class="me-4"><i data-lucide="map-pin" size="40" class="text-danger"></i></div>
                                <div>
                                    <h5 class="mb-0">Sentra UMKM Terdekat</h5>
                                    <p class="text-muted mb-0">Temukan lokasi workshop pelaku usaha di sekitar Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Katalog Produk Unggulan</h2>
                <p class="text-muted">Produk pilihan yang telah melewati kurasi kualitas tinggi.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="product-card p-2 shadow-sm">
                        <div class="img-container">
                            <img src="https://images.unsplash.com/photo-1544203380-602956272321?auto=format&fit=crop&w=600&q=80" class="img-fluid" alt="Product">
                        </div>
                        <div class="p-3 pt-1">
                            <small class="text-primary fw-bold text-uppercase">Craft</small>
                            <h6 class="fw-bold mb-1">Tas Anyaman Bambu</h6>
                            <p class="text-muted small mb-2"><i data-lucide="map-pin" size="12"></i> Tigaraksa, Tangerang</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5">Rp 85.000</span>
                                <button class="btn btn-outline-primary btn-sm rounded-circle"><i data-lucide="plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="bg-primary p-5 rounded-5 text-white text-center shadow-lg position-relative overflow-hidden">
            <div class="position-relative z-1">
                <h2 class="fw-bold mb-3">Siap Go-Digital Bersama Kami?</h2>
                <p class="opacity-75 mb-4">Daftarkan usaha Anda sekarang dan dapatkan akses pasar yang lebih luas.</p>
                <button class="btn btn-light btn-lg rounded-pill px-5 fw-bold">Daftar Sekarang</button>
            </div>
        </div>
    </section>

    <footer class="footer-custom">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="text-white fw-bold mb-4">RumahSikum.</h3>
                    <p>Layanan digital resmi Dinas Koperasi dan Usaha Mikro Kabupaten Tangerang untuk percepatan ekonomi daerah.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i data-lucide="instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i data-lucide="twitter"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i data-lucide="facebook"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h6 class="text-white fw-bold mb-4">Layanan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link d-block mb-2">Pendaftaran UMKM</a></li>
                        <li><a href="#" class="footer-link d-block mb-2">Sertifikasi Halal</a></li>
                        <li><a href="#" class="footer-link d-block mb-2">Laporan Koperasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6 class="text-white fw-bold mb-4">Pusat Bantuan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link d-block mb-2">FAQ</a></li>
                        <li><a href="#" class="footer-link d-block mb-2">Kebijakan Privasi</a></li>
                        <li><a href="#" class="footer-link d-block mb-2">Kontak Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="text-white fw-bold mb-4">Lokasi</h6>
                    <p class="small">Jl. Raya H. Tabri No. 1, Tigaraksa, Kec. Tigaraksa, Kabupaten Tangerang, Banten 15720</p>
                </div>
            </div>
            <hr class="my-5 opacity-10">
            <div class="d-flex justify-content-between small">
                <p class="mb-0">&copy; 2026 Rumah Sikum. All Rights Reserved.</p>
                <!-- <p class="mb-0">Crafted with ❤️ for Tangerang</p> -->
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      lucide.createIcons();
      
      // Navbar scroll effect
      window.addEventListener('scroll', function() {
          if (window.scrollY > 50) {
              document.querySelector('.navbar').classList.add('py-2');
          } else {
              document.querySelector('.navbar').classList.remove('py-2');
          }
      });
    </script>
</body>
</html>