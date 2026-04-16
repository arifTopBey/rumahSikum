<div class="container">
    <div class="mb-3">
        <h5 class="fw-bold">C. Sebaran Usaha Berdasarkan Wilayah Desa/Kelurahan</h5>
        <p class="text-muted">Menyajikan Sebaran jumlah UMKM berdasarkan wilayah yang dapat difilter
            hingga tingkat kelurahan melalui tombol "Filter Data Agregate" dipojok kanan bawah</p>
        <p style="color: #cc9125" class="fs-7 fw-semibold">Untuk melihat detail bisa menekan data pada
            grafik atau nama </p>

    </div>
    <canvas id="businessChart"></canvas>
    <div class="row">

        <div class="col-md-12">

            <div class="row d-flex justify-content-end">
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
            <div class="d-flex justify-content-between py-2 ">
                <h4 id="skalaTitle2" class="fw-bold text-primary mb-3 mt-5"></h4>
                <a style="max-height: 40px;" id="btnExportWilayah" href="#" class="btn btn-success d-none px-2 mt-5">
                    Export Excel
                </a>
            </div>
            <div id="tableContainerWilayah" class="mt-4">
                <!-- inputan sorting data -->
            </div>
        </div>
    </div>

</div>