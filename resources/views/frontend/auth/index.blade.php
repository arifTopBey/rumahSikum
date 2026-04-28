<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('image/icon.png') }}">

    <title>Login Dashboard | Rumah Sikum</title>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;

            /* #6B17BF #5f07b8 */
            background: linear-gradient(135deg, #a82282 0%, #a82252 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .login-info-section {
            background: linear-gradient(rgba(1168, 34, 130, 0.8), rgba(176, 3, 127, 0.9)),
                url('https://images.unsplash.com/photo-1556742044-3c52d6e88c62?auto=format&fit=crop&w=800&q=80');
            /* background: linear-gradient(rgba(107, 23, 191, 0.8), rgba(95, 7, 184, 0.9)), 
                        url('https://images.unsplash.com/photo-1556742044-3c52d6e88c62?auto=format&fit=crop&w=800&q=80'); */
            background-size: cover;
            background-position: center;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 20px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(107, 23, 191, 0.1);
            border-color: #6B17BF;
        }

        .btn-login {
            background: linear-gradient(90deg, #a82282, #a82252);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(107, 23, 191, 0.3);
            opacity: 0.9;
        }

        .brand-logo {
            width: 60px;
            margin-bottom: 20px;
        }

        /* Alert Styling */
        .alert-modern {
            border-radius: 12px;
            border: none;
            background-color: #fee2e2;
            color: #991b1b;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card login-card shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-6 d-none d-md-flex login-info-section">
                            <img src="{{ asset('image/icon.png') }}" alt="Logo"
                                class="brand-logo animate__animated animate__fadeInDown">
                            <h2 class="fw-800 mb-3">Selamat Datang Kembali!</h2>
                            <!-- untuk mengelola UMKM dan Koperasi -->
                            <p class="opacity-75">Silakan masuk ke dashboard administrasi Rumah Sikum Kabupaten
                                Tangerang.</p>
                            <div class="mt-4 border-top pt-4 border-white border-opacity-25">
                                <small class="opacity-50 mb-2">Dinas Koperasi dan Usaha Mikro</small><br>
                                <small class="opacity-50 mt-5">Belum Punya Akun? <a
                                        href="{{ route('frontend.register') }}"
                                        class="text-decoration-none ">Daftar</a></small>
                            </div>
                        </div>

                        <div class="col-md-6 bg-white p-4 p-lg-5">
                            <div class="text-center d-md-none mb-4">
                                <img src="{{ asset('image/icon.png') }}" width="50" alt="Logo">
                            </div>

                            <h4 class="fw-bold text-dark mb-2">Login Dashboard</h4>
                            <p class="text-muted mb-4 small text-uppercase fw-semibold">Gunakan akun resmi Anda</p>

                            @if ($errors->any())
                                <div class="alert alert-modern mb-4">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('login.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input name="email" type="email" class="form-control" placeholder="masukan email"
                                        required autofocus />
                                </div>

                                <div class="mb-4 position-relative">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label small fw-bold">Password</label>
                                        <!-- <a href="#" class="text-decoration-none small" style="color: #6B17BF;">Lupa Password?</a> -->
                                    </div>
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="masukan password" required />
                                    <!-- ICON TOGGLE -->
                                    <span onclick="togglePassword()"
                                        style="position:absolute; right:15px; top:45px; cursor:pointer; font-size:14px;">
                                        👁️
                                    </span>
                                </div>

                                <button class="btn btn-primary btn-login w-100 text-white shadow-sm mb-3" type="submit">
                                    Sign In to Dashboard
                                </button>

                                <div class="text-center">
                                    <a href="{{ route('frontend.index') }}"
                                        class="text-muted small text-decoration-none">
                                        &larr; Kembali ke Beranda
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
</body>

</html>