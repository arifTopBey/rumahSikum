<div class="">
    <h5 class="fw-bold">G. Usaha berdasarkan Status Usaha</h5>
    <p class="text-muted">
        Bagian ini menyajikan statistik sebaran unit usaha berdasarkan bentuk legalitas atau status badan usahanya.
        Melalui visualisasi perbandingan antara status Perseroan Terbatas (PT), CV, Koperasi, hingga usaha Perorangan,
        pemerintah daerah dapat memetakan tingkat maturitas legalitas pelaku UMKM binaan.
        <!-- Data ini berfungsi sebagai 
        instrumen kebijakan dalam mendorong transformasi dari sektor informal ke formal, serta mempermudah 
        klasifikasi bantuan hukum, akses pembiayaan perbankan, dan penguatan tata kelola organisasi usaha yang 
        sesuai dengan regulasi yang berlaku. -->
    </p>
</div>
<div class="row">


    <div class="col-md-12 mt-5 ">
        <div class="row">
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card cursor-pointer" data-skala="pt">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                        <p class="text-warning fw-bold mx-auto my-auto">PT</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus PT</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($pt, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="yayasan">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                        <p class="text-primary mx-auto fw-bold my-auto">Yayasan</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus Yayasab</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($yayasan, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="cv">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                        <p class="text-danger mx-auto fw-bold my-auto">CV</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus CV</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($cv, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="firma">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex mb-3 px-3 py-2 bg-success bg-opacity-10 border border-success rounded-2">
                        <p class="text-success mx-auto fw-bold my-auto">Firma</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus Firma</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($firma, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-3">
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card cursor-pointer" data-skala="nv">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                        <p class="text-warning fw-bold mx-auto my-auto">NV</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus NV</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($nv, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="danaPensiun">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex px-3 mb-3 py-2 bg-info bg-opacity-10 border border-info rounded-2">
                        <p class="text-primary mx-auto fw-bold my-auto">Dana Pensiun</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus Dana Pensiun</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($danaPensiun, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="perorangan">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex mb-3 px-3 py-2 bg-danger bg-opacity-10 border border-danger rounded-2">
                        <p class="text-danger mx-auto fw-bold my-auto">Perorangan</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus Perorangan</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($perorangan, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card" data-skala="lainnya">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex mb-3 px-3 py-2 bg-success bg-opacity-10 border border-success rounded-2">
                        <p class="text-success mx-auto fw-bold my-auto">Lainnya</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Berstatus Lainnya</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($lainnya, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>

            <div style="cursor: pointer;" class="col-md-3 px-2 skala-card cursor-pointer mt-3" data-skala="none">
                <div class="border rounded-2 py-3 px-3 shadow-lg">
                    <div class="d-flex mb-3 px-3 py-2 bg-secondary bg-opacity-10 border border-secondary rounded-2">
                        <p class="text-secondari fw-bold mx-auto my-auto">None</p>
                    </div>
                    <div>
                        <p class="text-muted">Jumlah Usaha Tidak Memiliki Status</p>
                    </div>
                    <div>
                        <p class="fw-semibold fs-2">{{ number_format($belumMemilikiStatus, 0, ',', '.')}}</p>
                        <p class="text-muted">Unit Usaha</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">

            <!-- <p class="text-muted fw-bold ">Yang belum Memiliki Status Badan Usaha <span class="text-danger fw-bold fs-5">{{ number_format($belumMemilikiStatus, 0, ',', '.')}} Usaha</span></p> -->
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Grafik Usaha Berdasarkan Status Badan Usaha</h5>
                        <div style="height: 300px;">
                            <canvas id="statusBadanUsaha"></canvas>
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



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('statusBadanUsaha').getContext('2d');

        // Data dari Controller
        const labels = {!! json_encode($chartLabels) !!};
        const dataValues = {!! json_encode($chartData) !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Usaha',
                    data: dataValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Agar sumbu Y menunjukkan angka bulat
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend jika hanya satu dataset
                    }
                }
            }
        });
    })


</script>


<!-- di klik cardnya -->
<script>
    // const exportUrlTemplate = "{{ route('admin.export.skala', ['skala' => ':skala']) }}";
</script>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const filterUrlTemplate = "{{ route('admin.filter.status.usaha') }}";

        let skala = '';
        // Klik card skala
        document.querySelectorAll('.skala-card').forEach(card => {

            card.addEventListener('click', function () {

                skala = this.dataset.skala;
                console.log(skala)

                let titleMap = {
                    pt: 'PT',
                    yayasan: 'Yayasan',
                    cv: 'CV',
                    firma: "Firma",
                    nv: "NV",
                    danaPensiun: "Dana Pensiun",
                    perorangan: "Perorangan",
                    lainnya: "Lainnya",
                };

                // document.getElementById('exportBtn').classList.remove('d-none')
                const formSeach = document.getElementById('formSearch');

                formSeach.classList.remove('d-none');

                // document.getElementById('exportBtn').href =
                //     `/export-skala/${skala}`;

                // document.getElementById('exportBtn').href =
                //     exportUrlTemplate.replace(':skala', skala);

                document.getElementById('skalaTitle9').innerText = titleMap[skala];

                // loadTable(`/filter-skala?skala=${skala}`);
                loadTable(`${filterUrlTemplate}?status=${skala}`);

            });
        });

        // Function reusable untuk load table
        function loadTable(url) {
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainer9').innerHTML = html;
                });
        }

        // Handle pagination click (WAJIB TAMBAH INI)
        document.addEventListener('click', function (e) {
            if (e.target.closest('#tableContainer9 .pagination a')) {
                e.preventDefault();

                let url = e.target.closest('a').getAttribute('href');

                loadTable(url);
            }
        });

        // --- LOGIKA PENCARIAN AJAX ---
        document.getElementById('btnDoSearch').addEventListener('click', function () {
            performSearch();
        });
        // Support tekan "Enter" di input search
        document.getElementById('searchInputWilayah').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        document.getElementById('filterSkala').addEventListener('change', function() {
             performSearch();
        });

        function performSearch() {
            const searchValue = document.getElementById('searchInputWilayah').value;
            const skalaValue = document.getElementById('filterSkala').value; // Ambil nilai dropdown

            // Panggil loadWilayah dengan kecamatan + kata kunci search
            // const url = `${filterUrlTemplate}?status=${encodeURIComponent(skala)}&search=${encodeURIComponent(searchValue)}`;
              const url = `${filterUrlTemplate}?status=${encodeURIComponent(skala)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;

            loadTable(url);
        }

        document.getElementById('btnResetSearch').addEventListener('click', function () {
            document.getElementById('searchInputWilayah').value = '';
            document.getElementById('filterSkala').value = '';
            loadTable(`${filterUrlTemplate}?status=${encodeURIComponent(skala)}`);
        });
    })

</script>