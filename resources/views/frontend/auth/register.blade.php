<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('image/icon.png') }}">
    <title>Register Akun</title>

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

   
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card register-card">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-flex register-visual">
                            <div class="mb-4">
                                <i data-lucide="shopping-bag" size="60" class="mb-3"></i>
                                <h2 class="fw-800">Mulai Belanja Produk Lokal</h2>
                                <p class="opacity-75">Dukung UMKM Kabupaten Tangerang dan temukan produk unik setiap harinya.</p>
                            </div>
                            <div class="">
                                <img src="https://illustrations.popsy.co/violet/shopping-cart.svg" class="img-fluid p-4" alt="Register Visual">
                            </div>
                        </div>
    
                        <div class="col-md-7 bg-white p-4 p-lg-5">
                            <div class="mb-4">
                                <h4 class="fw-bold text-dark mb-1">Buat Akun Baru</h4>
                                <p class="text-muted small">Gabung sekarang dan nikmati kemudahan bertransaksi.</p>
                            </div>
    
                            @if ($errors->any())
                                <div class="alert alert-danger border-0 rounded-4 small">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
    
                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label small fw-bold">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i data-lucide="user" size="16"></i></span>
                                            <input type="text" name="name" class="form-control border-start-0 shadow-none" placeholder="Masukkan nama Anda" required value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label small fw-bold">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i data-lucide="mail" size="16"></i></span>
                                            <input type="email" name="email" class="form-control border-start-0 shadow-none" placeholder="contoh@mail.com" required value="{{ old('email') }}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                    </div>
    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label small fw-bold">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                                    </div>
                                </div>
    
                                <button type="submit" class="btn btn-register w-100 mb-4 shadow-sm">
                                    Daftar Sekarang
                                </button>
    
                                <div class="position-relative mb-4">
                                    <hr class="text-muted opacity-25">
                                    <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">Atau daftar dengan</span>
                                </div>
    
                                <div class="row g-2">
                                    <div class="col-12">
                                        <a href="#" class="social-login">
                                            <img src="{{ asset('image/google.png') }}" width="18" alt="Google">
                                            Google Account
                                        </a>
                                    </div>
                                </div>
    
                                <p class="text-center mt-4 text-muted small">
                                    Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: #6B17BF;">Masuk di sini</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>














