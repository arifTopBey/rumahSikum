<nav class="navbar navbar-expand-lg fixed-top shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">
            <span class="text-primary">Rumah</span>Sikum
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto fw-semibold align-items-center">
                <li class="nav-item"><a class="nav-link px-3" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.eCommerce') }}">Marketplace</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link px-3 dropdown-toggle d-flex align-items-center gap-1" href="#" id="landingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Landing Page
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg mt-lg-3 p-2 rounded-4" aria-labelledby="landingDropdown">
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('frontend.list.panel') }}">
                                <i data-lucide="layout" size="16" class="text-muted"></i> Landing Page
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('frontend.acara') }}">
                                <i data-lucide="layout" size="16" class="text-muted"></i> Acara
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('frontend.pelatihan') }}">
                                <i data-lucide="award" size="16" class="text-muted"></i> Pelatihan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('frontend.informasi.bpom') }}">
                                <i data-lucide="users" size="16" class="text-muted"></i>Informasi BPOM
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('frontend.edukasi.keuangan') }}">
                                <i data-lucide="book-open" size="16" class="text-muted"></i> Edukasi Keuangan
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.e-learning') }}">E-Learning</a></li>
            </ul>
            
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('frontend.cart.list') }}" class="btn btn-outline-primary btn-sm rounded-circle p-2 d-flex align-items-center justify-content-center">
                    <i data-lucide="shopping-cart" size="18"></i>
                </a>

                <div class="dropdown">
                    <button class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2 border shadow-sm dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 24px; height: 24px;">
                            <i data-lucide="user" size="14"></i>
                        </div>
                        <span class="small fw-bold">Akun</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-4" aria-labelledby="userMenu" style="min-width: 200px;">
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('frontend.profile.index') }}">
                                <i data-lucide="user-circle" size="16" class="text-muted"></i> Akun Saya
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('login') }}">
                                <i data-lucide="log-in" size="16" class="text-muted"></i> Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('frontend.pesanan.index') }}">
                                <i data-lucide="package" size="16" class="text-muted"></i> Pesanan Saya
                            </a>
                        </li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-lucide="log-out" size="16"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('frontend.tambah.umkm') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">Gabung UMKM</a>
            </div>
        </div>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>