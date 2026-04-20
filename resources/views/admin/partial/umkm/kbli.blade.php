<div class="container">
    <div class="p-6 bg-white shadow-sm px-3 py-2">
        <h3 class="fw-bold text-dark">E. Sebaran Usaha berdasarkan KBLI 2020 di KAB. TANGERANG,
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
    
    @foreach ($dataCardKbli as $item )
        <div class="row py-3 px-3 mt-3 bg-white shadows-sm rounded-2">
            <div class="col-md-10 mt-3">
                <h3>{{ $item['kategori'] }}</h3>
    
            </div>
            <div class="col-md-2">
                <div class="d-flex">
                    <div class="">
                        <p class="fw-bold">{{ $item['total'] }} </p>
                    </div>
                    <div class="">
                        <p class="ms-2"> Unit Usaha </p>
                    </div>
                    <!-- <div class="">
                        <i>v</i>
                    </div> -->
                </div>
            </div>
    
            {{-- ini content dropdown --}}
            <div class="col-12 px-2 mt-5">
                <p class="text-muted">{{ $item['deskripsi'] }}</p>
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
                                <p class="fw-semibold">{{ $item['mikro'] }}</p>
                                <p class="text-muted"> Unit Usaha</p>
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
                                <p class="fw-semibold">{{ $item['kecil'] }}</p>
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
                                <p class="fw-semibold">{{ $item['menengah'] }}</p>
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
        
    @endforeach
</div>
    

<!-- <div class="row py-3 px-3 mt-3 bg-white shadows-sm rounded-2">
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
</div> -->
{{-- batas card dropdown --}}