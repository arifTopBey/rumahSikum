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

    @if (Request::is('e-learning'))
        <link rel="stylesheet" href="{{ asset('css/elearning.css') }}">  
    @endif
    @if (Request::is('e-commerce'))
        <link rel="stylesheet" href="{{ asset('css/ecommerce.css') }}">  
    @endif
    @if (Request::is('koperasi'))
        <link rel="stylesheet" href="{{ asset('css/koperasi.css') }}">  
    @endif
        
    @if (Request::is('tambah-umkm'))
        <link rel="stylesheet" href="{{ asset('css/formUmkm.css') }}">     
    @endif

    @if (Request::is('register'))
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    @endif
    @if (Request::is('profile'))
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @endif
    @if (Request::is('pesanan'))
        <link rel="stylesheet" href="{{ asset('css/pesananSaya.css') }}">
    @endif
    @if (Request::is('alamat-saya'))
        <link rel="stylesheet" href="{{ asset('css/alamat.css') }}">
    @endif
    @if (Request::is('checkout'))
        <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    @endif
    @if (Request::is('ulasan'))
        <link rel="stylesheet" href="{{ asset('css/ulasan.css') }}">
    @endif
    @if (Request::is('transaksi-detail'))
        <link rel="stylesheet" href="{{ asset('css/detailTransaksi.css') }}">
    @endif
    @if (Request::is('acara'))
        <link rel="stylesheet" href="{{ asset('css/acara.css') }}">
    @endif
    @if (Request::is('pelatihan'))
        <link rel="stylesheet" href="{{ asset('css/pelatihan.css') }}">
    @endif
    @if (Request::is('informasi-bpom'))
        <link rel="stylesheet" href="{{ asset('css/informasiBPOM.css') }}">
    @endif
    @if (Request::is('edukasi-keuangan'))
        <link rel="stylesheet" href="{{ asset('css/edukasiKeuangan.css') }}">
    @endif
    @if (Request::is('dashboard'))
        <link rel="stylesheet" href="{{ asset('css/sidebarDashboard.css') }}">
    @endif
    @if (Request::is('pelatihan/daftar-pelatihan'))
        <link rel="stylesheet" href="{{ asset('css/daftarPelatihan.css') }}">
    @endif
    @if (Request::is('acara/detail-acara'))
        <link rel="stylesheet" href="{{ asset('css/detailAcara.css') }}">
    @endif



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

    @include('frontend.partial.navbar')

    @yield('content')


   @include('frontend.partial.footer')

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