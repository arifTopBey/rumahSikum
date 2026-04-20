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
                <a href="{{ route('admin.ukmkm.list') }}" style="color: #183252" class="fw-bold fs-2 text-decoration-none">{{ number_format($totalUmkm, 0, ',', '.') }}</a>
                <p class="text-light text-dark">Unit Usaha</p>
                <p class="text-muted">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-12 ">
        <div class="row">
            <div style="cursor: pointer;" class="col-md-4 px-3 skala-card cursor-pointer" data-skala="mikro">
                <div style="min-height: 352px;" class="border rounded-2 py-3 px-3 shadow-lg">
                    <div
                        class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                        <p class="text-warning mx-auto fw-bold text-center my-auto">Usaha Mikro</p>
                    </div>
                    <div>
                        <p class="text-muted">Unit usaha yang hasil penjualan tahunannya sampai
                            dengan paling banyak Rp 2.000.000.000(dua miliar rupiah)</p>
                    </div>
                    <div class="mt-5 py-2">
                        <p class="fw-semibold fs-3 ">{{ number_format($totalMicro, 0, ',', '.') }}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-4 px-3 skala-card" data-skala="kecil">
                <div style="min-height: 352px;" class="border rounded-2 py-3 px-3 shadow-lg">
                    <div 
                        class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                        <p class="text-primary mx-auto fw-bold my-auto">Usaha Kecil</p>
                    </div>
                    <div>
                        <p class="text-muted">Unit usaha yang hasil penjualan tahunannya lebih dari Rp 2.000.000.000 (dua miliar rupiah) sampai paling banyak Rp 15.000.000.000 (lima belas miliar rupiah)</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-3">{{ number_format($totalUsahaKecil, 0, ',', '.') }}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-4 px-3 skala-card" data-skala="menengah">
                <div style="min-height: 352px;" class="border rounded-2 py-3 px-3 shadow-lg">
                    <div
                        class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                        <p class="text-danger mx-auto fw-bold my-auto">Usaha Menengah</p>
                    </div>
                    <div>
                        <p class="text-muted">Unit usaha yang hasil penjualan tahunannya lebih dari Rp 15.000.000.000 (lima belas miliar rupiah) sampai paling banyak Rp 50.000.000.000 (lima puluh miliar rupiah)</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-3">{{ number_format($totalUsahaMenengah, 0, ',', '.') }}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

         <div class="row d-flex justify-content-end mt-5">
                <div class="col-md-8">
                    <form id="formSearch" action="javascript:void(0);" method="GET" class="d-none">
                        <div class="input-group mb-3">
                            <input type="text" id="searchInputWilayah" class="form-control "
                                placeholder="Cari berdasarkan nama usaha, kecamatan, Desa" name="search"
                                value="{{ request('search') }}">
                           <button class="btn btn-outline-primary" type="button" id="btnDoSearch">Cari</button>
                           <button class="btn btn-secondary" type="button" id="btnResetSearch">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-between py-2 ">
                    <h4 id="skalaTitle9" class="fw-bold text-primary mb-3"></h4>
                    <a style="max-height: 40px;;" id="exportBtn" href="#"
                        class="btn btn-success d-none px-2 mt-5">
                        Export Excel
                    </a>
                </div>

                <div id="tableContainer9" class="mt-4">

                </div>
            </div>
        </div>
    </div>
</div>