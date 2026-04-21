<div class="">
    <h5 class="fw-bold">K. Usaha Bersarkan Omzet Usaha </h5>
    <p class="text-muted">
        Bagian ini menyajikan klasifikasi unit usaha berdasarkan kapasitas pendapatan tahunan atau omzet usaha. 
        Visualisasi ini membagi pelaku usaha ke dalam kategori mikro, kecil, dan menengah sesuai dengan 
        rentang nilai pendapatan yang dihasilkan. Data ini merupakan indikator vital untuk mengukur 
        <strong>skala ekonomi</strong> UMKM.
    </p>
</div>
<div class="row">


    <div class="col-md-12 mt-5 ">

        <div class="row">

            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Grafik Usaha Berdasarkan Tahun</h5>
                        <div style=" overflow-x: auto;">
                            <div style="height: 300px;">
                                <canvas id="omzetChart"></canvas>
                            </div>
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
                    <!-- <a style="max-height: 40px;;" id="exportBtn" href="#" class="btn btn-success d-none px-2 mt-5">
                        Export Excel
                    </a> -->
                </div>

                <div id="tableContainer9" class="mt-4">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctxOmzet = document.getElementById('omzetChart').getContext('2d');
        const dataOmzet = @json($dataOmzet);
        let filterOmzet = "{{ route('admin.filter.omzet.usaha') }}"
        let laporanKeuangan = '';

        new Chart(ctxOmzet, {
            type: 'line', // Ganti ke line chart agar sama dengan gambar
            data: {
                labels: dataOmzet.labels,
                datasets: [{
                    label: 'Jumlah Unit Usaha',
                    data: dataOmzet.values,
                    borderColor: '#0d6efd', // Warna garis biru
                    backgroundColor: 'rgba(13, 110, 253, 0.1)', // Warna bayangan di bawah garis
                    borderWidth: 3,
                    fill: true, // Mengisi area di bawah garis
                    tension: 0.4, // Membuat garis melengkung (smooth) seperti di gambar
                    pointRadius: 5, // Titik bulat pada setiap data
                    pointBackgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function (evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        console.log(index);
                        laporanKeuangan = this.data.labels[index];
                        document.getElementById('skalaTitle9').innerText =
                            "Data UMKM Omset " + laporanKeuangan;

                        const formSeach = document.getElementById('formSearch');

                        formSeach.classList.remove('d-none');

                        // btn.href = `/export-nib/${encodeURIComponent(label)}`;
                        // loadNIB(`/filter-nib?status=${label}`);


                        loadKeuangan(`${filterOmzet}?skala=${encodeURIComponent(laporanKeuangan)}`);

                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom', // Legend di bawah seperti di gambar
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        offset: 5,
                        formatter: (val) => val.toLocaleString('id-ID'),
                        font: { weight: 'bold' }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: '#e0e0e0'
                        }
                    },
                    x: {
                        grid: {
                            display: false // Menghilangkan garis vertikal agar bersih
                        }
                    }
                }
            }
        });



        function loadKeuangan(url) {



            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainer9').innerHTML = html;
                });
        }
        document.addEventListener('click', function (e) {
            if (e.target.closest('#tableContainer9 .pagination a')) {
                e.preventDefault();

                let url = e.target.closest('a').getAttribute('href');

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableContainer9').innerHTML = html;
                    });
            }
        });

        document.getElementById('btnDoSearch').addEventListener('click', function () {
            performSearch();
        });
        // Support tekan "Enter" di input search
        document.getElementById('searchInputWilayah').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        function performSearch() {
            const searchValue = document.getElementById('searchInputWilayah').value;
            // const skalaValue = document.getElementById('filterSkala').value; // Ambil nilai dropdown

            // Panggil loadWilayah dengan kecamatan + kata kunci search
            const url = `${filterOmzet}?skala=${encodeURIComponent(laporanKeuangan)}&search=${encodeURIComponent(searchValue)}`;
            //   const url = `${filterOmzet}?izin=${encodeURIComponent(skala)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;

            loadKeuangan(url);
        }

        document.getElementById('btnResetSearch').addEventListener('click', function () {
            document.getElementById('searchInputWilayah').value = '';
            loadKeuangan(`${filterOmzet}?skala=${encodeURIComponent(laporanKeuangan)}`);
        });
    });

</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctxOmzet = document.getElementById('omzetChart').getContext('2d');
        const dataOmzet = @json($dataOmzet);

        new Chart(ctxOmzet, {
            type: 'line',
            data: {
                labels: dataOmzet.labels,
                datasets: [{
                    label: 'Jumlah Unit Usaha',
                    data: dataOmzet.values,
                    backgroundColor: [
                        '#ffc107', // Kuning (Mikro)
                        '#0d6efd', // Biru (Kecil)
                        '#198754'  // Hijau (Menengah)
                    ],
                    borderWidth: 1,
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        const label = this.data.labels[index];
                        
                        // Mapping label ke parameter filter
                        let skala = '';
                        if(index === 0) skala = 'mikro';
                        else if(index === 1) skala = 'kecil';
                        else if(index === 2) skala = 'menengah';

                        document.getElementById('skalaTitle2').innerText = "Data UMKM Omzet: " + label;
                        document.getElementById('formSearch').classList.remove('d-none');
                        
                        // Panggil fungsi load filter (sesuaikan dengan route Anda)
                        loadOmzetTable(`${filterOmzetUrl}?skala=${skala}`);
                    }
                },
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: (val) => val.toLocaleString('id-ID'),
                        font: { weight: 'bold' }
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { display: true } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script> -->