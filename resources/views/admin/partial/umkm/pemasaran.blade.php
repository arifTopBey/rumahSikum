<div class="col-md-12 ">
    <div class="row border mb-2 border-warning bg-warning bg-opacity-10 rounded-2">
        <div class="col-md-10 py-3 px-3">
            <div class="">
                <p class="fw-bold fs-5 text-primary">F. Usaha Berdasarkan Penjualan dan Pemasaran</p>
                <p class="text-muted">Berikut ini adalah diagram Pemasaran dan Penjualan yang digunakan untuk melihat data argregasi UMKM</p>
            </div>
        </div>
        <div class="col-md-2">

        </div>
    </div>

    <div class="d-flex gap-1">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <h6 class="fw-bold">Usaha Mikro yang Memiliki Laporan keuangan</h6>
                <p class="text-muted small">Data perbandingan UMKM yang memiliki Laporan Keuangan dan Tidak.</p>

                <div style="height: 250px;">
                    <canvas id="keuanganChart"></canvas>
                </div>

                <!-- <div class="text-center mt-3">
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4">Lihat
                        Detail &rarr;</a>
                </div> -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                 <h6 class="fw-bold">Pemasaran Usaha Menggunakan digital(e-commerce)</h6>
                <p class="text-muted small">Data perbandingan UMKM yang memiliki digital(e-commerce) dan Tidak.</p>
                <div style="height: 250px;">
                    <canvas id="digitalChart"></canvas>
                </div>

                <!-- <div class="text-center mt-3">
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4">Lihat
                        Detail &rarr;</a>
                </div> -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
               
                 <h6 class="fw-bold">Pemasaran Usaha Menggunakan non-digital (pasar)</h6>
                <p class="text-muted small">Data perbandingan UMKM yang memiliki non-digital(pasar) dan Tidak.</p>
                <div style="height: 250px;">
                    <canvas id="nonDigitalChart"></canvas>
                </div>

                <!-- <div class="text-center mt-3">
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4">Lihat
                        Detail &rarr;</a>
                </div> -->
            </div>
        </div>

        <!-- <div class="col-md-8">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold">Jumlah Penjulan/Omset</h6>
                <p class="text-muted small">Data agregasi UMKM berdasarkan metode pemasarannya.</p>

                <div style="height: 330px;">
                    <canvas id="pemasaranChart"></canvas>
                </div>
            </div>
        </div> -->

    </div>

    <!-- <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px;">
                <h6 class="fw-bold">Jenis Kelamin Pengusaha</h6>
                <p class="text-muted small">Perbandingan Pengusaha berdasarkan Jenis Kelamin</p>

                <div class="position-relative" style="height: 250px;">
                    <canvas id="genderChart"></canvas>
                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                        <span class="text-muted small">Total</span><br>
                        <span class="fw-bold h5">10010</span>
                    </div>
                </div>

                <div class="mt-3 small">
                    <div class="d-flex align-items-center mb-1">
                        <span class="badge rounded-circle me-2"
                            style="background-color: #d4a017; width: 12px; height: 12px;">&nbsp;</span>
                        Laki-Laki - 40%
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <span class="badge rounded-circle me-2"
                            style="background-color: #2b4c7e; width: 12px; height: 12px;">&nbsp;</span>
                        Perempuan - 40%
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge rounded-circle me-2"
                            style="background-color: #ff0000; width: 12px; height: 12px;">&nbsp;</span>
                        Tidak Diketahui - 20%
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
                        <span class="fw-bold h5">100</span>
                    </div>
                </div>

                <div class="mt-3 small">
                   

                    <div class="d-flex align-items-center mb-1">
                        <span class="badge rounded-circle me-2"
                            style="background-color: #d4a017; width: 12px; height: 12px;">&nbsp;</span>
                        Dibayar - 90%
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge rounded-circle me-2"
                            style="background-color: #2b4c7e; width: 12px; height: 12px;">&nbsp;</span>
                        Tidak Dibayar - 10%
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row mt-5">

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
    
        <div class="col-md-12">
            <div class="d-flex justify-content-between py-2 ">
                <h4 id="detailTitle88" class="fw-bold text-primary mb-3 mt-5"></h4>
                <a style="max-height: 40px;" id="btnExportNib" href="#"
                    class="btn btn-success d-none px-2 mt-5">
                    Export Excel
                </a>
            </div>

            <div id="tableContainer6" class="mt-4">

            </div>
        </div>
    </div>
</div>





<!-- variable data blade -->
    <script>
        const filterLaporanKeuangan = "{{ route('admin.filter.laporan.keuangan') }}";
        const filterDigital = "{{ route('admin.filter.pemasaran.digital') }}";
        const filterNonDigital = "{{ route('admin.filter.pemasaran.non.digital') }}";
    </script>
<!-- batas data variable blade -->
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // Daftarkan plugin untuk angka di dalam grafik
        Chart.register(ChartDataLabels);

        const dataKeuangan = @json($dataKeuangan);
        const ctxKeuangan = document.getElementById('keuanganChart').getContext('2d');
        let laporanKeuangan = '';

        new Chart(ctxKeuangan, {
            type: 'pie', // Tipe grafik Pie
            data: {
                labels: Object.keys(dataKeuangan), // ['Memiliki', 'Tidak Memiliki']
                datasets: [{
                    data: Object.values(dataKeuangan),
                    backgroundColor: [
                        '#198754', // Hijau (Memiliki)
                        '#a82282'  
                        // '#ced4da'  // Abu-abu (Tidak Memiliki)
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                 onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        laporanKeuangan = this.data.labels[index];
                         document.getElementById('detailTitle88').innerText =
                        "Data UMKM  " + laporanKeuangan + " Laporan Keuangan";

                         const formSeach = document.getElementById('formSearch');
                        
                        formSeach.classList.remove('d-none');

                        // btn.href = `/export-nib/${encodeURIComponent(label)}`;
                        // loadNIB(`/filter-nib?status=${label}`);
                     

                    loadKeuangan(`${filterLaporanKeuangan}?keuangan=${encodeURIComponent(laporanKeuangan)}`);

                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: function(value, ctx) {
                            // Menampilkan angka murni
                            return value.toLocaleString('id-ID');
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / total) * 100);
                                return `${label}: ${value.toLocaleString('id-ID')} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
            });
      })


      function loadKeuangan(url) {



            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainer6').innerHTML = html;
                });
        }
    document.addEventListener('click', function (e) {
            if (e.target.closest('#tableContainer6 .pagination a')) {
                e.preventDefault();

                let url = e.target.closest('a').getAttribute('href');

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableContainer6').innerHTML = html;
                    });
            }
    });
</script>


<script>
      document.addEventListener('DOMContentLoaded', function () {
        // Daftarkan plugin untuk angka di dalam grafik
        Chart.register(ChartDataLabels);

        const dataPemasaran = @json($dataPemasaran);
        const ctxPemasaran = document.getElementById('digitalChart').getContext('2d');
        let digital = '';

        new Chart(ctxPemasaran, {
            type: 'pie', // Tipe grafik Pie
            data: {
                labels: Object.keys(dataPemasaran), // ['Memiliki', 'Tidak Memiliki']
                datasets: [{
                    data: Object.values(dataPemasaran),
                    backgroundColor: [
                        '#198754', // Hijau (Memiliki)
                        '#ced4da'  
                        // '#ced4da'  // Abu-abu (Tidak Memiliki)
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        digital = this.data.labels[index];
                         document.getElementById('detailTitle88').innerText =
                        "Data UMKM menggunakan Digital " + digital;

                         const formSeach = document.getElementById('formSearch');
                        
                        formSeach.classList.remove('d-none');

                        // btn.href = `/export-nib/${encodeURIComponent(label)}`;
                        // loadNIB(`/filter-nib?status=${label}`);
                     

                    loadDigital(`${filterDigital}?digital=${encodeURIComponent(digital)}`);

                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: function(value, ctx) {
                            // Menampilkan angka murni
                            return value.toLocaleString('id-ID');
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / total) * 100);
                                return `${label}: ${value.toLocaleString('id-ID')} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
            });
      })

        function loadDigital(url) {



            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainer6').innerHTML = html;
                });
        }
        document.addEventListener('click', function (e) {
            if (e.target.closest('#tableContainer6 .pagination a')) {
                e.preventDefault();

                let url = e.target.closest('a').getAttribute('href');

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableContainer6').innerHTML = html;
                    });
            }
    });
</script>
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // Daftarkan plugin untuk angka di dalam grafik
        Chart.register(ChartDataLabels);

        const dataNonDigital = @json($dataNonDigital);
        const ctxNonDigital = document.getElementById('nonDigitalChart').getContext('2d');
        let nonDigital = '';
        new Chart(ctxNonDigital, {
            type: 'pie', // Tipe grafik Pie
            data: {
                labels: Object.keys(dataNonDigital), // ['Memiliki', 'Tidak Memiliki']
                datasets: [{
                    data: Object.values(dataNonDigital),
                    backgroundColor: [
                        '#198754', // Hijau (Memiliki)
                        '#ff0335'  
                        // '#ced4da'  // Abu-abu (Tidak Memiliki)
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        nonDigital = this.data.labels[index];
                         document.getElementById('detailTitle88').innerText =
                        "Data UMKM menggunakan NonDigital " + nonDigital;

                         const formSeach = document.getElementById('formSearch');
                        
                        formSeach.classList.remove('d-none');

                        // btn.href = `/export-nib/${encodeURIComponent(label)}`;
                        // loadNIB(`/filter-nib?status=${label}`);
                     

                    loadNonDigital(`${filterNonDigital}?nondigital=${encodeURIComponent(nonDigital)}`);

                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: function(value, ctx) {
                            // Menampilkan angka murni
                            return value.toLocaleString('id-ID');
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / total) * 100);
                                return `${label}: ${value.toLocaleString('id-ID')} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
            });
      })

       function loadNonDigital(url) {



            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainer6').innerHTML = html;
                });
        }
        document.addEventListener('click', function (e) {
            if (e.target.closest('#tableContainer6 .pagination a')) {
                e.preventDefault();

                let url = e.target.closest('a').getAttribute('href');

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableContainer6').innerHTML = html;
                    });
            }
    });
</script>


