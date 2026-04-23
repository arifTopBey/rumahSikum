<div class="">
    <h5 class="fw-bold">J. Pertumbuhan Usaha Mikro</h5>
    <p class="text-muted">
       Grafik ini menggambarkan tren pertumbuhan unit usaha berdasarkan kurun waktu dimulainya operasional usaha.
       Peningkatan volume yang signifikan dalam beberapa tahun terakhir menunjukkan dinamika kewirausahaan yang semakin
       <!-- inklusif serta efektivitas program pemberdayaan ekonomi lokal. Data ini menjadi instrumen penting bagi pemerintah
       untuk memahami siklus hidup usaha mikro, sehingga intervensi kebijakan—baik berupa pendampingan manajerial maupun
        akses permodalan—dapat disesuaikan dengan masa bakti atau pengalaman operasional masing-masing unit usaha guna menjaga
        keberlanjutan ekonomi daerah -->
    </p>
</div>
<div class="row">


    <div class="col-md-12 mt-5 ">
       
        <div class="row">

            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Grafik Usaha Berdasarkan Tahun</h5>
                        <div style="width: 100%; overflow-x: auto;">
                            <div style="width: 2000px; height: 300px;">
                                <canvas id="tahunMulaiOperasi"></canvas>
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
                    <a style="max-height: 40px;;" id="exportBtn" href="#" class="btn btn-success d-none px-2 mt-5">
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
        // Daftarkan plugin datalabels jika Anda ingin angka di atas batang

        const filterUrlTemplate = "{{ route('admin.filter.pertumbuhan.usaha') }}";
        const exportUrlTemplate = "{{ route('admin.export.pertumbuhan.usaha')}}";

        Chart.register(ChartDataLabels);

        let tahunMulai = ''

        const labelsTahun = @json($labels);
        const valuesTahun = @json($values);
        const ctxTahun = document.getElementById('tahunMulaiOperasi').getContext('2d');

        new Chart(ctxTahun, {
            type: 'bar',
            data: {
                labels: labelsTahun,
                datasets: [{
                    label: 'Jumlah Unit Usaha',
                    data: valuesTahun,
                    backgroundColor: '#a82282', 
                    borderRadius: 5,
                    barThickness: 'flex',
                    maxBarThickness: 40
                }]
            },

            // options: {
            //     responsive: true,
            //     maintainAspectRatio: false,
            //     scales: {
            //         x: {
            //             ticks: {
            //                 autoSkip: true, // Chart.js akan otomatis menyembunyikan sebagian label agar tidak tabrakan
            //                 maxRotation: 45, // Memiringkan label 45 derajat
            //                 minRotation: 45
            //             },
            //             grid: { display: false }
            //         }
            //     },
            //     plugins: {
            //         datalabels: {
            //             // Sembunyikan angka jika nilai terlalu kecil atau data terlalu padat
            //             display: function (context) {
            //                 return context.dataset.data[context.dataIndex] > 500; // Hanya muncul jika unit usaha > 500
            //             },
            //             anchor: 'end',
            //             align: 'top',
            //             offset: -5
            //         }
            //     }
            // }
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                          tahunMulai = this.data.labels[index];
                         document.getElementById('skalaTitle9').innerText =
                        "Data UMKM Tahun " + tahunMulai;

                        //  const btn = document.getElementById('btnExportNib');
                         const formSeach = document.getElementById('formSearch');
                         const exportBtn = document.getElementById('exportBtn');
                        
                        formSeach.classList.remove('d-none');
                        exportBtn.classList.remove('d-none');
                        // btn.classList.remove('d-none');

                        // btn.href = `/export-nib/${encodeURIComponent(label)}`;
                        // loadNIB(`/filter-nib?status=${label}`);
                        // btn.href =
                    // exportNibTemplate.replace(':status', encodeURIComponent(tahunMulai));
                    exportBtn.href = `/export-pertumbuhan-usaha?tahun=${encodeURIComponent(tahunMulai)}`;

                    loadTable(`${filterUrlTemplate}?tahun=${encodeURIComponent(tahunMulai)}`);

                    }
                },
                layout: {
                    padding: {
                        top: 30 // Memberi ruang untuk angka di atas batang
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: '#333',
                        font: {
                            weight: 'bold'
                        },
                        formatter: function(value) {
                            return value.toLocaleString('id-ID');
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0 // Menghilangkan angka desimal di sumbu Y
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
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
              const url = `${filterUrlTemplate}?tahun=${encodeURIComponent(tahunMulai)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;

            loadTable(url);
        }

        document.getElementById('btnResetSearch').addEventListener('click', function () {
            document.getElementById('searchInputWilayah').value = '';
            document.getElementById('filterSkala').value = '';
            loadTable(`${filterUrlTemplate}?tahun=${encodeURIComponent(tahunMulai)}`);
        });

    });
</script>