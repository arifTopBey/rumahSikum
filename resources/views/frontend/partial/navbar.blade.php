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
                    <li class="nav-item"><a class="nav-link px-3" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.eCommerce') }}">Marketplace</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.list.panel') }}">Landing Page</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.e-learning') }}">E-Learning</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-4">Login</a>
                    <a href="#" class="btn btn-primary rounded-pill px-4 shadow">Gabung UMKM</a>
                </div>
            </div>
        </div>
    </nav>