 <div class="container">
    <h3 class="fw-bold">D. Sebaran Usaha Berdasarkan Kluster UMKM di KAB. TANGERANG</h3>
    <p class="text-muted">Kluster UMKM ini merupakan bagian dari program holding UMKM, Sebagai salah
     satu strategi inovasi Kementrian UMKM dalam rangka meningkatkan kapasitas pengusaha UMKM.
     Berikut adalah beberapa cluster UMKM sektor prioritas yang menjadi ploating pada tahun 2025 -
     2029 </p>

 <div style="height: 400px;">
     <canvas id="clusterChart"></canvas>
 </div>
 <div class="row">

    <div class="row d-flex justify-content-end mt-5">
                <div class="col-md-8">
                    <form id="formSearch" action="javascript:void(0);" method="GET" class="d-none">
                        <div class="input-group mb-3">

                            <select id="filterSkala" class="form-select me-2" style="max-width: 200px;">
                                <option value="">Semua Skala</option>
                                <option value="mikro">Usaha Mikro</option>
                                <option value="kecil">Usaha Kecil</option>
                                <option value="menengah">Usaha Menengah</option>
                            </select>


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
                <h4 id="clusterTitle" class="fw-bold text-primary mb-3 mt-5"></h4>
                <a style="max-height: 40px;" id="btnExportWilayah" href="#"
                    class="btn btn-success d-none px-2 mt-5">
                    Export Excel
                </a>
            </div>

            <div id="tableCluster" class="mt-4">

            </div>
        </div>
    </div>
 </div>