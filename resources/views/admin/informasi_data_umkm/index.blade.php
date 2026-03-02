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
                                <div class="">
                                    <h5 class="fw-bold">A. Sebaran Usaha Berdasarkan Skala Usaha</h5>
                                    <p class="text-muted">Berdasarkan kriteria penjualan tahunan sebagaimana dimaksud dalam Pasal 35
                                        ayat (5) Peraturan Pemerintah Nomor 7 Tahun 2021 tentang Kemudahan, Perlindungan, dan
                                        pembedayaan Koperasi Serta UMKM</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 mx-auto">
                                        <div class="d-flex mt-3 gap-3 justify-content-center">
                                            <div class="px-2 d-flex justify-content-center align-items-center">
                                                <i class="bi bi-shop "
                                                    style="color:#cc9125; font-size: 70px; display: inline-block;"></i>
                                            </div>
                                            <div class="">
                                                <p style="color: #183252" class="fw-semibold">Total UMKM</p>
                                                <p style="color: #183252" class="fw-bold fs-2">{{ number_format($totalUmkm, 0, ',', '.') }}</p>
                                                <p class="text-light text-dark">Unit Usaha</p>
                                                <p class="text-muted">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4 px-5">
                                                <div style="min-height: 330px;" class="border rounded-2 py-3 px-3 shadow-lg">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                                        <p class="text-warning my-auto">Usaha Mikro</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted">Unit usaha yang hasil penjualan tahunannya sampai
                                                            dengan paling banyak Rp 2.000.000.000(dua miliar rupiah)</p>
                                                        </div>
                                                        <div>
                                                            <p class="fw-semibold">{{ number_format($totalMicro, 0, ',', '.') }}</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class="border rounded-2 py-3 px-3 shadow-lg">
                                                    <div
                                                        class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                                                        <p class="text-dark fw-bold my-auto">Usaha Kecil</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted">Unit usaha yang hasil penjualan tahunannya lebih dari Rp 2.000.000.000 (dua miliar rupiah) sampai paling banyak Rp 15.000.000.000 (lima belas miliar rupiah)</p>
                                                    </div>
                                                    <div>
                                                        <p class="fw-semibold">{{ number_format($totalUsahaKecil, 0, ',', '.') }}</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class="border rounded-2 py-3 px-3 shadow-lg">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                                        <p class="text-danger my-auto">Usaha Menengah</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted">Unit usaha yang hasil penjualan tahunannya lebih dari Rp 15.000.000.000 (lima belas miliar rupiah) sampai paling banyak Rp 50.000.000.000 (lima puluh miliar rupiah)</p>
                                                    </div>
                                                    <div>
                                                        <p class="fw-semibold">{{ number_format($totalUsahaMenengah, 0, ',', '.') }}</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- content berdasarkan wilayah --}}
                            <div class="tab-pane d-none" id="content-wilayah">
                                <div class="mb-3">
                                    <h5 class="fw-bold">B. Sebaran Usaha Berdasarkan Wilayah</h5>
                                    <p class="text-muted">Menyajikan Sebaran jumlah UMKM berdasarkan wilayah yang dapat difilter
                                        hingga tingkat kelurahan melalui tombol "Filter Data Agregate" dipojok kanan bawah</p>
                                    <p style="color: #cc9125" class="fs-7 fw-semibold">Untuk melihat detail bisa menekan data pada
                                        grafik atau nama</p>

                                </div>
                                <canvas id="businessChart"></canvas>
                            </div>

                            {{-- content berdasarkan kluster --}}
                            <div id="content-cluster" class="mt-10 p-4 bg-white shadow-sm rounded-lg tab-pane d-none">
                                <h3 class="fw bold">C. Sebaran Usaha Berdasarkan Kluster UMKM di KAB. TANGERANG</h3>
                                <p class="text-muted">Kluster UMKM ini merupakan bagian dari program holding UMKM, Sebagai salah
                                    satu strategi inovasi Kementrian UMKM dalam rangka meningkatkan kapasitas pengusaha UMKM.
                                    Berikut adalah beberapa cluster UMKM sektor prioritas yang menjadi ploating pada tahun 2025 -
                                    2029 </p>

                                <div style="height: 400px;">
                                    <canvas id="clusterChart"></canvas>
                                </div>
                            </div>


                            {{-- berdasarkan desil --}}
                            <div id="content-desil" class="p-6 bg-white shadow-sm rounded-lg tab-pane d-none py-3">
                                <h3 class="font-bold text-gray-800 px-3">D. Sebaran Pengusaha Berdasarkan Peringkat Desil pada DTSEN</h3>
                                <p class="text-xs text-muted mb-6 px-3">Peringkat desil pada Data Tunggal Sosial Ekonomi (DTSEN)
                                    dibagi menjadi 10 tingkat. Desil merupakan indikator untuk mengelompokan rumah tangga berdasarkan tingkat kesejahteraan dari yang terendah (desil 1) hingga desil tertinggi desil(10). Pemerintah menggunakan peringkat desil tersebut untuk menyalurkan bantuan sosial agar tepat sasaran, dimana desil yang paling rendah menjadi prioritas untuk mendapatkan bantuan</p>

                                <div class="row mb-5">
                                    <div class="col-md-10 mx-auto">
                                        <div class="d-flex mt-3 gap-3 justify-content-center">
                                            <div class="px-2 d-flex justify-content-center align-items-center">
                                                <i class="bi bi-shop "
                                                    style="color:#cc9125; font-size: 70px; display: inline-block;"></i>
                                            </div>
                                            <div class="">
                                                <p style="color: #183252" class="fw-semibold">Total</p>
                                                <p style="color: #183252" class="fw-bold fs-2">48.789</p>
                                                <p class="text-light text-muted">Pengusaha UMKM yang memiliki informasi desil</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 px-5">
                                                 <div class="row px-5 border rounded-2 shadow-lg ">
                                                    <div class="col-md-10 ">
                                                        <p style="color: #183252" class="">Potensi Penerimaan Manfaat Kartu Usaha Produktif (Desil 5-10) </p>
                                                        <p style="color: #183252" class="fw-bold fs-5">29.878</p>
                                                        <p style="color: #183252" class="">Pengusaha UMKM</p>
                                                        <div class="d-flex gap-1">
                                                            <div class="d-flex gap-2">
                                                                <div class="">
                                                                    <i style="color: #183252" class="bi bi-person-standing fs-4"></i>
                                                                </div>
                                                                <div class="">
                                                                    <p class="fw-semibold text-primary ">15.897</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                 <div class="">
                                                                    <i class="bi bi-person-standing-dress fs-4 text-danger"></i>
                                                                </div>
                                                                <div class="">
                                                                    <p class="fw-semibold text-primary">14.197</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                                                        <i style="color:#cc9125;" class="bi bi-person-video fs-1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-5">
                                                 <div class="row px-5 border rounded-2 shadow-lg ">
                                                    <div class="col-md-10 ">
                                                        <p style="color: #183252" class="">Potensi Penerimaan Manfaat Kartu Usaha Produktif (Desil 5-10) </p>
                                                        <p style="color: #183252" class="fw-bold fs-5">29.878</p>
                                                        <p style="color: #183252" class="">Pengusaha UMKM</p>
                                                        <div class="d-flex gap-1">
                                                            <div class="d-flex gap-2">
                                                                <div class="">
                                                                    <i style="color: #183252" class="bi bi-person-standing fs-4"></i>
                                                                </div>
                                                                <div class="">
                                                                    <p class="fw-semibold text-primary ">12.817</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                 <div class="">
                                                                    <i class="bi bi-person-standing-dress fs-4 text-danger"></i>
                                                                </div>
                                                                <div class="">
                                                                    <p class="fw-semibold text-primary">16.197</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                                                        <i style="color:#cc9125;" class="bi bi-person-video fs-1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div style="height: 450px;">
                                    <canvas id="desilChart"></canvas>
                                </div>
                            </div>

                            {{-- berdasarkan KBLI --}}
                            <div id="content-kbli" class=" rounded-lg mt-6 tab-pane d-none">
                                <div class="p-6 bg-white shadow-sm px-3 py-2">
                                    <h3 class="font-bold text-gray-800">E. Sebaran Usaha berdasarkan KBLI 2020 di KAB. TANGERANG,
                                        BANTEN
                                    </h3>
                                    <p class="text-xs text-gray-500 mb-4">Menyajikan jumlah data usaha berdasarkan Klasifikasi Baku
                                        Lapangan Usaha Indonesia (KBLI) 2020. Untuk menentukan kategori bidang usaha yang akan dikembangkan di indonesia, Pemerintah melalui Badan Pusat Statistik (BPS) Menyusun KBLI 2020. Pada Basis Data Tunggal UMKM saat ini terdapat 17 dari 21 kategori dari KBLI 2020, yaitu kecuali Kategori A, O, T, Dan U</p>

                                    <div style="height: 400px; position: relative;">
                                        <div id="highlight-box"
                                            style="position: absolute;
                                            top: 20px;
                                            left: 48px;
                                            width: 38%;
                                            height: 90%;
                                            border: 2px solid #48a44c;
                                            background-color: rgba(72, 164, 76, 0.05);
                                            border-radius: 15px;
                                            z-index: 0;
                                            pointer-events: none;">
                                            <span class="p-2 text-success fw-italic small"
                                                style="position: absolute; top: -36px; left:88px;">
                                                <i>5 Kategori Lapangan Usaha Teratas</i>
                                            </span>
                                        </div>
                                        <canvas id="kbliChart"></canvas>
                                    </div>
                                </div>

                                {{-- card dropdown --}}
                                <div class="row py-3 px-3 mt-3 bg-white shadows-sm rounded-2">
                                    <div class="col-md-10 mt-3">
                                        <h3>PERDAGANGAN BESAR DAN ECERAN, REPARASI DAN PERAWATAN MOBIL DAN SEPEDA MOTOR</h3>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex">
                                            <div class="">
                                                <p>117.189</p>
                                            </div>
                                            <div class="">
                                                <p>Unit Usaha </p>
                                            </div>
                                            <div class="">
                                                <i>v</i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ini content dropdown --}}
                                    <div class="col-12 px-2 mt-5">
                                        <p class="text-muted">Kategori ini mencakup kegiatan ekonomi lapangan usaha yang berkaitan
                                            dengan perdagangan besar dan eceran berbagai jenis barang, serta jasa reparasi dan
                                            perawatan kendaraan bermotor</p>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                                        <p class="text-warning my-auto">Usaha Mikro</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                                                        <p class="text-dark fw-bold my-auto">Usaha Kecil</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                                        <p class="text-danger my-auto">Usaha Menengah</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3 d-flex justify-content-center">
                                        <a href=""
                                            class="px-3 d-block fw-bold py-2 border border-secondary rounded-2 text-decoration-none text-primary">Lihat
                                            Selengkapnya...... </a>
                                    </div>
                                </div>
                                <div class="row py-3 px-3 mt-3 bg-white shadows-sm rounded-2">
                                    <div class="col-md-10 mt-3">
                                        <h3>PENYEDIAAN AKOMODASI DAN PENYEDIAAN MAKAN DAN MINUM</h3>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex">
                                            <div class="">
                                                <p>117.189</p>
                                            </div>
                                            <div class="">
                                                <p>Unit Usaha </p>
                                            </div>
                                            <div class="">
                                                <i>v</i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ini content dropdown --}}
                                    <div class="col-12 px-2 mt-5">
                                        <p class="text-muted">Kegiatan ini mencakup kegiatan ekonomi lapangan usaha yang berkaitan
                                            dengan penyediaan layanan penginapan dan penyediaan makanan dan minuman untuk dikonsumsi
                                            langsung </p>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                                        <p class="text-warning my-auto">Usaha Mikro</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                                                        <p class="text-dark fw-bold my-auto">Usaha Kecil</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                                        <p class="text-danger my-auto">Usaha Menengah</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3 d-flex justify-content-center">
                                        <a href=""
                                            class="px-3 d-block fw-bold py-2 border border-secondary rounded-2 text-decoration-none text-primary">Lihat
                                            Selengkapnya...... </a>
                                    </div>
                                </div>
                                <div class="row py-3 px-3 mt-3 bg-white shadows-sm rounded-2">
                                    <div class="col-md-10 mt-3">
                                        <h3>AKTIVITAS JASA LAINNYA</h3>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex">
                                            <div class="">
                                                <p>117.189</p>
                                            </div>
                                            <div class="">
                                                <p>Unit Usaha </p>
                                            </div>
                                            <div class="">
                                                <i>v</i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ini content dropdown --}}
                                    <div class="col-12 px-2 mt-5">
                                        <p class="text-muted">Kategori ini mencakup kegiatan ekonomi lapangan usaha yang tidak
                                            termasuk dalam kategori lainnya, seperti jasa perorangan, jasa rumah tangga, dan jasa
                                            lainnya yang mendukung kegiatan ekonomi</p>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                                        <p class="text-warning my-auto">Usaha Mikro</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                                                        <p class="text-dark fw-bold my-auto">Usaha Kecil</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                                        <p class="text-danger my-auto">Usaha Menengah</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3 d-flex justify-content-center">
                                        <a href=""
                                            class="px-3 d-block fw-bold py-2 border border-secondary rounded-2 text-decoration-none text-primary">Lihat
                                            Selengkapnya...... </a>
                                    </div>
                                </div>
                                <div class="row py-3 px-3 mt-3 bg-white shadows-sm rounded-2">
                                    <div class="col-md-10 mt-3">
                                        <h3>INDUSTRI PENGOLAHAN </h3>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex">
                                            <div class="">
                                                <p>117.189</p>
                                            </div>
                                            <div class="">
                                                <p>Unit Usaha </p>
                                            </div>
                                            <div class="">
                                                <i>v</i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ini content dropdown --}}
                                    <div class="col-12 px-2 mt-5">
                                        <p class="text-muted">Kategori ini meliputi kegiatan ekonomi/lapangan usaha dibidang
                                            perubahan secara kimia atau fisik dari bahan, unsur, atau komponen menjadi produk baru.
                                            Bahan baku industri pengolahan berasal dari produk pertanian, kehutanan, perikanan,
                                            pertambangan atau penggalian seperti produk dari kegiatan industri pengolahan lainnya.
                                            Perubahan, pembaharuan, atau rekontruksi yang pokok dari barang secara umum,
                                            diperlakukan sebagai industri pengolahan</p>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                                        <p class="text-warning my-auto">Usaha Mikro</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                                                        <p class="text-dark fw-bold my-auto">Usaha Kecil</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-5">
                                                <div class=" rounded-2 py-3 px-3 ">
                                                    <div
                                                        class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                                                        <p class="text-danger my-auto">Usaha Menengah</p>
                                                    </div>

                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="fw-semibold">277.999</p>
                                                        <p class="text-muted">Unit Usaha</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3 d-flex justify-content-center">
                                        <a href=""
                                            class="px-3 d-block fw-bold py-2 border border-secondary rounded-2 text-decoration-none text-primary">Lihat
                                            Selengkapnya...... </a>
                                    </div>
                                </div>
                                {{-- batas card dropdown --}}
                            </div>
                            {{-- end content --}}

                            <!-- indikator usaha lainnya -->
                            <div id="content-usaha-lainnya" class="row mt-4  tab-pane d-none">

                                <div class="col-md-12 ">
                                        <div class="row border mb-2 border-warning bg-warning bg-opacity-10 rounded-2">
                                            <div class="col-md-10 py-3 px-3" >
                                                <div class="">
                                                    <p class="fw-bold fs-5 text-primary">NIB & Indikator Usaha Lainnya di KAB. TANGERANG BANTEN</p>
                                                    <p class="text-muted">Berikut ini adalah diagram lainnya yang digunakan untuk melihat data argregasi UMKM</p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                    <div class="d-flex gap-1">
                                        <div class="col-md-4">
                                            <div class="card h-100 border-0 shadow-sm p-3">
                                                <h6 class="fw-bold">Kepemilikan NIB</h6>
                                                <p class="text-muted small">Data perbandingan UMKM yang memiliki NIB dan tidak.</p>

                                                <div style="height: 250px;">
                                                    <canvas id="nibChart"></canvas>
                                                </div>

                                                <div class="text-center mt-3">
                                                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4">Lihat
                                                        Detail &rarr;</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="card border-0 shadow-sm p-3">
                                                <h6 class="fw-bold">Metode Pemasaran Usaha</h6>
                                                <p class="text-muted small">Data agregasi UMKM berdasarkan metode pemasarannya.</p>

                                                <div style="height: 330px;">
                                                    <canvas id="pemasaranChart" ></canvas>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px;">
                                                <h6 class="fw-bold">Jenis Kelamin Pengusaha</h6>
                                                <p class="text-muted small">Perbandingan Pengusaha berdasarkan Jenis Kelamin</p>

                                                <div class="position-relative" style="height: 250px;">
                                                    <canvas id="genderChart"></canvas>
                                                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                                                        <span class="text-muted small">Total</span><br>
                                                        <span class="fw-bold h5">{{ number_format($totalJenisKelamin, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>

                                                <div class="mt-3 small">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <span class="badge rounded-circle me-2"
                                                            style="background-color: #d4a017; width: 12px; height: 12px;">&nbsp;</span>
                                                        Laki-Laki - {{ $persenLaki }}%
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <span class="badge rounded-circle me-2"
                                                            style="background-color: #2b4c7e; width: 12px; height: 12px;">&nbsp;</span>
                                                        Perempuan - {{ $persenPerempuan }}%
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge rounded-circle me-2"
                                                            style="background-color: #ff0000; width: 12px; height: 12px;">&nbsp;</span>
                                                        Tidak Diketahui - {{ $persenTidak }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px;">
                                                <h6 class="fw-bold">Jumlah Tenaga Kerja</h6>
                                                <p class="text-muted small">Perbandingan antara tenaga kerja yang dibayar dan tidak
                                                    dibayar</p>

                                                <div class="position-relative" style="height: 250px;">
                                                    <canvas id="laborChart"></canvas>
                                                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                                                        <span class="text-muted small">Total</span><br>
                                                        <span class="fw-bold h5">{{ number_format($totalTenagaKerja, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>

                                                <div class="mt-3 small">
                                                    @php
                                                        $persenDibayar = $totalTenagaKerja > 0
                                                            ? ($tenagaKerja->dibayar / $totalTenagaKerja) * 100
                                                            : 0;

                                                        $persenTidakDibayar = $totalTenagaKerja > 0
                                                            ? ($tenagaKerja->tidak_dibayar / $totalTenagaKerja) * 100
                                                            : 0;
                                                    @endphp

                                                    <div class="d-flex align-items-center mb-1">
                                                        <span class="badge rounded-circle me-2"
                                                            style="background-color: #d4a017; width: 12px; height: 12px;">&nbsp;</span>
                                                        Dibayar - {{ number_format($persenDibayar, 1) }}%
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge rounded-circle me-2"
                                                            style="background-color: #2b4c7e; width: 12px; height: 12px;">&nbsp;</span>
                                                        Tidak Dibayar - {{ number_format($persenTidakDibayar, 1) }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


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
                        {{-- <ol type="A" start="4" class=" mb-3">

                            <li class="mb-3">Usaha Berdasarkan Desil</li>

                        </ol>
                        <ol type="A" start="5" class=" mb-3">

                            <li class="mb-3">Usaha Berdasarkan KBLI</li>
                        </ol>
                        <ol type="A" start="6" class=" mb-3">

                            <li>Usaha Berdasarkan Indikator Lainnya</li>
                        </ol> --}}

                    </div>
            </div>
        </div>
    {{-- </div> --}}
@endsection
