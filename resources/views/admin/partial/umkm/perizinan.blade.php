<div class="">
    <h5 class="fw-bold">G. Sebaran Usaha Yang Memiliki Perizinan</h5>
    <p class="text-muted">Bagian ini menampilkan statistik sebaran perizinan yang dimiliki oleh unit usaha binaan. Melalui perbandingan jumlah pemilik PIRT, BPOM, TDP, dan sertifikasi Halal, pemerintah daerah dapat memetakan kebutuhan fasilitasi sertifikasi bagi UMKM yang belum memenuhi standar perizinan. Hal ini sejalan dengan upaya percepatan transformasi formalitas usaha sesuai dengan amanat regulasi penyederhanaan perizinan berusaha.</p>
</div>
<div class="row">
   

    <div class="col-md-12 mt-5 ">
        <div class="row">
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card cursor-pointer" data-skala="pirt">
                <div style="" class="border rounded-2 py-3 px-3 shadow-lg">
                    <div
                        class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                        <p class="text-warning fw-bold mx-auto my-auto">Memiliki PIRT</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Mikro yang memilki PIRT</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($totalPirt, 0, ',', '.') }}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="bpom">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div
                        class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                        <p class="text-primary mx-auto fw-bold my-auto">Memiliki BPOM/BD</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Mikro yang memilki BPOM/BD</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($totalBpom, 0, ',', '.') }}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="tdp">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div
                        class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                        <p class="text-danger mx-auto fw-bold my-auto">Memiliki TDP</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Mikro yang memilki TDP</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($totalTdp, 0, ',', '.') }}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="halal">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div
                        class="d-flex mb-3 px-3 py-2 bg-success bg-opacity-10 border border-success rounded-2">
                        <p class="text-success mx-auto fw-bold my-auto">Memiliki Halal</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Mikro yang memilki Halal</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($totalHalal, 0, ',', '.') }}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Grafik Perbandingan Kepemilikan Izin</h5>
                        <div style="height: 300px;">
                            <canvas id="perizinanChart"></canvas>
                        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dataPerizinan = @json($perizinan);
        
        const ctx = document.getElementById('perizinanChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(dataPerizinan), // ['PIRT', 'BPOM', 'TDP', 'Halal']
                datasets: [{
                    label: 'Total Unit Usaha',
                    data: Object.values(dataPerizinan), // [angka, angka, angka, angka]
                    backgroundColor: [
                        '#ffc107', // Kuning (PIRT)
                        '#0dcaf0', // Biru Muda (BPOM)
                        '#dc3545', // Merah (TDP)
                        '#198754'  // Hijau (Halal)
                    ],
                    borderRadius: 8,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 30 // Kasih space di atas agar angka tidak terpotong canvas
                    }
                },
                plugins: {
                legend: { display: false },
                // --- KONFIGURASI ANGKA DI ATAS BATANG ---
                datalabels: {
                    anchor: 'end', // Posisi di ujung batang
                    align: 'top',  // Muncul di atas batang
                    color: '#333',
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    formatter: function(value) {
                        // Format ke ribuan Indonesia (contoh: 1.250)
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                }
            },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: false },
                        ticks: { display: true } 
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { weight: 'bold' }
                        }
                    }
                }
            }
        });
    });
</script>

