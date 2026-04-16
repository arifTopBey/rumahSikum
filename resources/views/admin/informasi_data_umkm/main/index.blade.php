@extends('admin.main.main')

@section('content')
<div class="">
    <div class="container mt-4">
        <div class="row px-3">
            <div style="background: #a82282" class="col-md-12 rounded-2  py-3 px-5">
                <div class="">
                    <h3 class="text-white">Selamat Datang di Sistem Informasi Data Tunggal UMKM(SIDT-UMKM)</h3>
                    <p style="color: #cc9125" class="fs-5 fw-semibold">Sebaran Data UMKM (Agregat)</p>
                </div>
                <div class="">
                    <p class="text-white">di Kab. TANGERANG, BANTEN</p>
                </div>
            </div>
        </div>

        <div class="row px-3">
            <div class="col-md-10 py-3 tab-content" id="v-pills-tabContent">

                {{-- content skala --}}
                <div class="tab-pane active">
                     @yield('content-dashboard')
                </div>

            </div>

            {{-- navigasi halaman --}}
            <div class="col-md-2 py-3">
                <h5>Navigasi Halaman</h5>

                {{-- Navigasi A --}}
                <ol type="A" class="{{ Request::is('sebaran-data-umkm') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }} ps-3 mb-3">
                    <li class="nav-link active py-2"
                    >
                        <a href="{{ route('admin.sebaran.data.umkm') }}" class="text-decoration-none text-dark">Usaha Berdasarkan Skala</a>
                    </li>
                </ol>

                <ol type="A" start="2" class="ps-3 mb-3 {{ Request::is('usaha-berdasarkan-wilayah') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }}">
                    <li class="nav-link py-2">
                        <a href="{{ route('admin.wilayah') }}" class="text-decoration-none text-dark">Usaha Berdasarkan Wilayah Kecamatan</a>
                    </li>
                </ol>
                <ol type="A" start="2" class="ps-3 mb-3 {{ Request::is('usaha-berdasarkan-wilayah-desa') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }}">
                    <li class="nav-link py-2">
                        <a href="{{ route('admin.wilayah.desa') }}" class="text-decoration-none text-dark">Usaha Berdasarkan Wilayah Desa</a>
                    </li>
                </ol>
                <ol type="A" start="2" class="ps-3 mb-3 {{ Request::is('usaha-berdasarkan-cluster-prioritas') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }}">
                    <li class="nav-link py-2">
                        <a href="{{ route('admin.cluster.prioritas') }}" class="text-decoration-none text-dark">Usaha Berdasarkan Cluster Prioritas</a>
                    </li>
                </ol>
                <ol type="A" start="2" class="ps-3 mb-3 {{ Request::is('usaha-berdasarkan-desil') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }}">
                    <li class="nav-link py-2">
                        <a href="{{ route('admin.usaha.desil') }}" class="text-decoration-none text-dark">Pengusaha Berdasarkan Desil</a>
                    </li>
                </ol>
                <ol type="A" start="2" class="ps-3 mb-3 {{ Request::is('usaha-berdasarkan-kbli') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }}">
                    <li class="nav-link py-2">
                        <a href="{{ route('admin.usaha.kbli') }}" class="text-decoration-none text-dark">Usaha Berdasarkan KBLI</a>
                    </li>
                </ol>
                <ol type="A" start="2" class="ps-3 mb-3 {{ Request::is('usaha-berdasarkan-perizinan') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }}">
                    <li class="nav-link py-2">
                        <a href="{{ route('admin.usaha.perizinan') }}" class="text-decoration-none text-dark">Jumlah Perizinan Usaha Mikro</a>
                    </li>
                </ol>
                <ol type="A" start="2" class="ps-3 mb-3 {{ Request::is('indikator-usaha-lainnya') ? 'bg-secondary bg-opacity-10 border-start border-4 border-warning' : '' }}">
                    <li class="nav-link py-2">
                        <a href="{{ route('admin.usaha.lainnya') }}" class="text-decoration-none text-dark">Indikator Usaha LainnyaI</a>
                    </li>
                </ol>
                <!-- <ol type="A" start="3" class="ps-3 mb-3">
                    <li class="nav-link py-2"
                        style="cursor: pointer;">
                        Indikator Usaha Lainnya
                    </li>
                </ol> -->
            </div>
        </div>
    </div>
</div>
    @endsection