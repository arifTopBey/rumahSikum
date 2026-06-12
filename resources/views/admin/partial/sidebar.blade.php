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
<aside style="background: linear-gradient(to bottom, #a82282, #a82252);" class="app-sidebar shadow py-3"
    data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand ">
        <!--begin::Brand Link-->
        <a href="" class="brand-link py-3">
            <!--begin::Brand Image-->
            <img src="{{ asset('image/icon.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
           
            <div class="ms-1 py-3">
                <span class="brand-text fw-bold fs-8 text-white">DINAS KOPERASI DAN USAHA MIKRO</span>
                <p class="fs-7 text-center fw-light text-white">KABUPATEN TANGERANG</p>
            </div>
           
        </a>
       
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->

    <div class="sidebar-wrapper">

      
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-columns-gap text-white"></i>
                        <p class="text-white">
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.dashboard') }}" class="nav-link">
                                <i class="bi bi-person-vcard text-white"></i>
                                <p class="text-white">Dashboard User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->user_role == "admin")
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
                                <a href="{{route('admin.ukmkm.list')}}"
                                    class="nav-link {{ Request::is('list-umkm') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Daftar UMKM</p>
                                </a>
                            </li>
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
                                <a href="{{ route('admin.kategori.berita.index') }}"
                                    class="nav-link {{ Request::is('admin/kategori/berita*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori Berita</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.berita.index')}}"
                                    class="nav-link {{ Request::is('admin/berita*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Berita</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.kategori.acara.index') }}"
                                    class="nav-link {{ Request::is('admin/kategori-acara*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori Acara</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.acara.index')}}"
                                    class="nav-link {{ Request::is('admin/acara*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Acara</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kategori.pelatihan.index') }}"
                                    class="nav-link {{ Request::is('admin/kategori-pelatihan*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori Pelatihan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.pelatihan.index')}}"
                                    class="nav-link {{ Request::is('admin/pelatihan*') ? 'active' : '' }}">
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
                                <a href="{{ route('admin.kategori.elearning.index') }}"
                                    class="nav-link {{ Request::is('admin/kategori-elearning*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kategori E-learning</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.elearning.index') }}"
                                    class="nav-link {{ Request::is('admin/elearning*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Modul E-learning</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-bag-fill text-white"></i>
                            <p class="fs-6 text-white">
                                Pesanan
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.list.pesanan', auth()->user()->id) }}" class="nav-link">
                                    <i class="nav-icon bi bi-bag-check"></i>
                                    <p class="text-white">Semua Pesanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.address') }}" class="nav-link">
                                    <i class="nav-icon bi bi-star-fill"></i>
                                    <p class="text-white">Reviews</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-cart-plus-fill text-white"></i>
                            <p class="text-white">
                                Toko & Produk
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('admin.kategori.produk') }}"
                                    class="nav-link {{ Request::is('admin/kategori-produk*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-layout-text-sidebar"></i>
                                    <p class="text-white">Kategori Produk</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.list.toko.index') }}"
                                    class="nav-link {{ Request::is('admin/list-toko*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-cart-plus-fill"></i>
                                    <p class="text-white">Daftar Toko</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.list.produk.index') }}"
                                    class="nav-link {{ Request::is('admin/list-produk*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-cart-plus-fill"></i>
                                    <p class="text-white">Daftar List Produk</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi bi-shop-window text-white"></i>
                            <p class="text-white">
                                Kelola Ecommerce
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.slider.index')}}"
                                    class="nav-link {{ Request::is('admin/banner-ecommerce*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-card-image"></i>
                                    <p class="text-white">Banner</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.kupon.index')}}"
                                    class="nav-link {{ Request::is('admin/kupon*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-ticket-perforated-fill"></i>
                                    <p class="text-white">Kode Kupon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.daftar.umkm')  }}"
                                    class="nav-link {{ Request::is('admin/kategori-produk*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-newspaper"></i>
                                    <p class="text-white">List Pengajuan UMKM</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-people text-white"></i>
                            <p class="fs-6 text-white">
                                Pengguna
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.daftar.pengguna.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-people-fill"></i>
                                    <p class="text-white">Daftar Pengguna</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi bi-whatsapp text-white"></i>
                            <p class="fs-6 text-white">
                                WhatApps Info
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.whatapp.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">WhatApps Blast</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-person-video2 text-white"></i>
                            <p class="fs-8 text-white">
                                Halaman Koperasi
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Dashboard Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.grafik.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Grafik Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pendirian.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Pendirian Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Daftar Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.statistik.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Statistik Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.jenis.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Jenis Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kuk.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Kuk Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.grade.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Grade Koperasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sertifikat.koperasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="text-white">Sertifikat Koperasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if (auth()->user()->user_role == 'vendor')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-bag-fill text-white"></i>
                            <p class="fs-6 text-white">
                                Produk Saya
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('vendor.produk.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-bag-check"></i>
                                    <p class="text-white">Produk</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                     <a href="{{ route('user.address') }}" class="nav-link">
                                        <i class="nav-icon bi bi-star-fill"></i>
                                        <p class="text-white">Reviews</p>
                                    </a>
                                </li> -->
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-bag-fill text-white"></i>
                            <p class="fs-6 text-white">
                                Pesanan
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.list.pesanan', auth()->user()->id) }}" class="nav-link">
                                    <i class="nav-icon bi bi-bag-check"></i>
                                    <p class="text-white">Pesanan saya</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.address') }}" class="nav-link">
                                    <i class="nav-icon bi bi-star-fill"></i>
                                    <p class="text-white">Reviews</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-shop text-white"></i>
                            <p class="fs-6 text-white">
                                Pengaturan Toko
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('vendor.profile.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-person-circle"></i>
                                    <p class="text-white">Toko Saya</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                     <a href="{{ route('user.address') }}" class="nav-link">
                                        <i class="nav-icon bi bi-building-add"></i>
                                        <p class="text-white">Alamat Pengiriman</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a href="{{ route('user.daftar.umkm') }}" class="nav-link">
                                        <i class="nav-icon bi bi-bag-plus-fill"></i>
                                        <p class="text-white">Daftar Jadi UMKM</p>
                                    </a>
                                </li> -->
                        </ul>
                    </li>

                @endif

                @if(auth()->user()->user_role == 'users')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-bag-fill text-white"></i>
                            <p class="fs-6 text-white">
                                Pesanan
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.list.pesanan', auth()->user()->id) }}" class="nav-link">
                                    <i class="nav-icon bi bi-bag-check"></i>
                                    <p class="text-white">Pesanan saya</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.address') }}" class="nav-link">
                                    <i class="nav-icon bi bi-star-fill"></i>
                                    <p class="text-white">Reviews</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-person-gear text-white"></i>
                        <p class="fs-6 text-white">
                            Pengaturan Akun
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.prfile.index', auth()->user()->id) }}" class="nav-link">
                                <i class="nav-icon bi bi-person-circle"></i>
                                <p class="text-white">Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.address') }}" class="nav-link">
                                <i class="nav-icon bi bi-building-add"></i>
                                <p class="text-white">Alamat Pengiriman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.daftar.umkm') }}" class="nav-link">
                                <i class="nav-icon bi bi-bag-plus-fill"></i>
                                <p class="text-white">Daftar Jadi UMKM</p>
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
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('frontend.acara') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p class="text-white">Halaman Acara</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('frontend.berita') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p class="text-white">Halaman Berita</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('frontend.pelatihan') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p class="text-white">Halaman Pelatihan</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('frontend.eCommerce') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p class="text-white">Halaman Marketplace</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('frontend.e-learning') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p class="text-white">Halaman Elearning</p>
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

                                <button class="ms-3 nav-link" type="submit">Logout</button>
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