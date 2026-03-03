@extends('admin.main.main')

@section('content')
<div class="">
    <div class="container mt-4">
        <div class="row px-3">
            <div style="background: #A020F0" class="col-md-12 rounded-2  py-3 px-5">
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
                <div class="tab-pane active" id="content-skala">
                    @include('admin.partial.umkm.skala')
                </div>

                {{-- content berdasarkan wilayah --}}
                <div class="tab-pane d-none" id="content-wilayah">
                    @include('admin.partial.umkm.wilayah')
                </div>

                {{-- content berdasarkan kluster --}}
                <div id="content-cluster" class="mt-10 p-4 bg-white shadow-sm rounded-lg tab-pane d-none">
                    @include('admin.partial.umkm.cluster')
                </div>


                {{-- berdasarkan desil --}}
                <div id="content-desil" class="p-6 bg-white shadow-sm rounded-lg tab-pane d-none py-3">
                    @include('admin.partial.umkm.desil')
                </div>

                {{-- berdasarkan KBLI --}}
                <div id="content-kbli" class=" rounded-lg mt-6 tab-pane d-none">
                    @include('admin.partial.umkm.kbli')
                </div>
                {{-- end content --}}

                <!-- indikator usaha lainnya -->
                <div id="content-usaha-lainnya" class="row mt-4  tab-pane d-none">
                    @include('admin.partial.umkm.lainnya')
                </div>
                <!-- indikator usaha lainnya -->


            </div>

            {{-- navigasi halaman --}}
            <div class="col-md-2 py-3">
                <h5>Navigasi Halaman</h5>

                {{-- Navigasi A --}}
                <ol type="A" class="bg-secondary bg-opacity-10 border-start border-4 border-warning ps-3 mb-3">
                    <li class="nav-link active py-2" onclick="bukaTab(event, 'content-skala')"
                        style="cursor: pointer;">
                        Usaha Berdasarkan Skala
                    </li>
                </ol>

                <ol type="A" start="2" class="ps-3 mb-3">
                    <li class="nav-link py-2" onclick="bukaTab(event, 'content-wilayah')" style="cursor: pointer;">
                        Usaha Berdasarkan Wilayah
                    </li>
                </ol>

                <ol type="A" start="3" class="ps-3 mb-3">
                    <li class="nav-link py-2" onclick="bukaTab(event, 'content-cluster')" style="cursor: pointer;">
                        Usaha Berdasarkan Cluster Prioritas
                    </li>
                </ol>
                <ol type="A" start="3" class="ps-3 mb-3">
                    <li class="nav-link py-2" onclick="bukaTab(event, 'content-desil')" style="cursor: pointer;">
                        Pengusaha Berdasarkan Desil
                    </li>
                </ol>
                <ol type="A" start="3" class="ps-3 mb-3">
                    <li class="nav-link py-2" onclick="bukaTab(event, 'content-kbli')" style="cursor: pointer;">
                        Usaha Berdasarkan KBLI
                    </li>
                </ol>
                <ol type="A" start="3" class="ps-3 mb-3">
                    <li class="nav-link py-2" onclick="bukaTab(event, 'content-usaha-lainnya')"
                        style="cursor: pointer;">
                        Indikator Usaha Lainnya
                    </li>
                </ol>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    @endsection