<div class="col-md-12 ">
    <div class="row border mb-2 border-warning bg-warning bg-opacity-10 rounded-2">
        <div class="col-md-10 py-3 px-3">
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
                    <canvas id="pemasaranChart"></canvas>
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
     <div class="row">
            <div class="col-md-12">
                <div id="tableContainer6" class="mt-4">

                </div>
            </div>
        </div>
</div>