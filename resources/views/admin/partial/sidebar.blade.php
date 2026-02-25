 <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">

            <ul class="navbar-nav">

                <li>
                    <p class="fs-5 fw-semibold">Kementrian UMKM</p>
                </li>

            </ul>
            <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
    </nav>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <aside style="background: whitesmoke;" class="app-sidebar shadow py-3" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand ">
            <!--begin::Brand Link-->
            <a href="" class="brand-link py-3">
                <!--begin::Brand Image-->
                <img src="{{ asset('image/logo_umkm.png') }}" alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow" />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <div class="ms-2 py-3">
                    <span class="brand-text fw-bold fs-7 text-primary">KEMENTRIAN UMKM</span>
                    <p class="fs-7 text-center fw-light text-primary">REPUBLIK INDONESIA</p>
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
                    <li class="nav-item {{ Request::is('dashboard') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('dashboard') ? 'active bg-black' : '' }}">
                            <i class="bi bi-house text-dark"></i>
                            <p class="text-dark">
                                Infomasi Data UMKM
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.sebaran.data.umkm') }}" class="nav-link">
                                    <i class="bi bi-dot text-dark"></i>
                                    <p class="text-dark">Sebaran Data UMKM (Agregat)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="bi bi-dot text-dark"></i>
                                    <p class="text-dark">Detail Data UMKM (BNBA)</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('pembinaan*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('pembinaan') ? 'active bg-black' : '' }}">
                            <i class="bi bi-table text-dark"></i>
                            <p class="text-dark">
                                Tabel Tabulasi UMKM
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.ukmkm.list') }}" class="nav-link {{ Request::is('pembinaan') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-dark">Daftar UMKM</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.koperasi') }}" class="nav-link {{ Request::is('pembinaan') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-dark">Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sertifikat') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-dark">sertifikat</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-box-arrow-right text-dark"></i>
                            <p class="fs-8 text-dark">
                                Logout
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <form action="" method="post">
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
