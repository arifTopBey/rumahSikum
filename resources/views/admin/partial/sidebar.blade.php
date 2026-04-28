 <!--begin::Header-->
    <!-- <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">

            <ul class="navbar-nav">

                <li>
                    <p class="fs-5 fw-semibold">DINAS KOPERASI DAN USAHA MIKRO KABUPATEN TANGERANG</p>
                </li>

            </ul>
        </div>
    </nav> -->
    <!--end::Header-->

    <!--begin::Sidebar-->
    <aside style="background: linear-gradient(to bottom, #a82282, #a82252);" class="app-sidebar shadow py-3" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand ">
            <!--begin::Brand Link-->
            <a href="" class="brand-link py-3">
                <!--begin::Brand Image-->
                <img src="{{ asset('image/icon.png') }}" alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow" />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <div class="ms-1 py-3">
                    <span class="brand-text fw-bold fs-8 text-white">DINAS KOPERASI DAN USAHA MIKRO</span>
                    <p class="fs-7 text-center fw-light text-white">KABUPATEN TANGERANG</p>
                </div>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">

            {{-- <div class="sidebar-brand">
                <a href="./index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="" alt="AdminLTE Logo"
                        class="brand-image rounded-circle opacity-75 shadow" />

                    <span class="brand-text fw-light fs-7">Admin</span>
                </a>
            </div> --}}
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                    aria-label="Main navigation" data-accordion="false" id="navigation">
                    <li class="nav-item {{ Request::is('sebaran-data-umkm') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('sebaran-data-umkm') ? 'active bg-black' : '' }}">
                            <i class="bi bi-house text-white"></i>
                            <p class="text-white">
                                Infomasi Data UMKM
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.sebaran.data.umkm') }}" class="nav-link">
                                    <i class="bi bi-dot text-white"></i>
                                    <p class="text-white">Sebaran Data UMKM (Agregat)</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="bi bi-dot text-white"></i>
                                    <p class="text-white">Detail Data UMKM (BNBA)</p>
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('list-umkm*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('list-umkm*') ? 'active bg-black' : '' }}">
                            <i class="bi bi-table text-white"></i>
                            <p class="text-white">
                                Tabel Tabulasi UMKM
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.ukmkm.list')}}" class="nav-link {{ Request::is('list-umkm') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Daftar UMKM</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="" class="nav-link {{ Request::is('pembinaan') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">sertifikat</p>
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('admin/berita*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('admin/berita*') ? 'active bg-black' : '' }}">
                            <i class="bi bi-body-text text-white"></i>
                            <p class="text-white">
                                Umum
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.kategori.berita.index') }}" class="nav-link {{ Request::is('admin/kategori/berita*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori Berita</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.berita.index')}}" class="nav-link {{ Request::is('admin/berita*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Berita</p>
                                </a>
                            </li>

                             <li class="nav-item">
                                <a href="{{ route('admin.kategori.acara.index') }}" class="nav-link {{ Request::is('admin/kategori-acara*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori Acara</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.acara.index')}}" class="nav-link {{ Request::is('admin/acara*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Acara</p>
                                </a>
                            </li>
                             <li class="nav-item">
                                <a href="{{ route('admin.kategori.pelatihan.index') }}" class="nav-link {{ Request::is('admin/kategori-pelatihan*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori Pelatihan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.pelatihan.index')}}" class="nav-link {{ Request::is('admin/pelatihan*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Pelatihan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('admin/elearning*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('admin/elearning*') ? 'active bg-black' : '' }}">
                            <i class="bi bi-backpack text-white"></i>
                            <p class="text-white">
                                E-learning
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                             <li class="nav-item">
                                <a href="{{ route('admin.kategori.elearning.index') }}" class="nav-link {{ Request::is('admin/kategori-elearning*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori E-learning</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.elearning.index') }}" class="nav-link {{ Request::is('admin/elearning*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Modul E-learning</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-house-fill text-white"></i>
                            <p class="fs-8 text-white">
                                Halaman Utama
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <a href="{{ route('frontend.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Halaman Beranda</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-box-arrow-right text-white"></i>
                            <p class="fs-8 text-white">
                                Logout
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    {{-- <i class="nav-icon bi bi-box-arrow-in-right"></i> --}}

                                    <button class="ms-3 nav-link"  type="submit">Logout</button>
                                    {{-- <i class="nav-arrow bi bi-chevron-right"></i> --}}

                                 </form>
                            </li>
                        </ul>
                    </li>


                    <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
