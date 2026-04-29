<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rumah Sikum</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Monev Dashboard" />

    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />

    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('css/adminlte.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('image/icon.png') }}">
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css?...&display=swap"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />

    {{-- leaft cdn --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/lucide@latest"></script>


    <style>
         /* CSS KRITIKAL: Agar teks langsung muncul meskipun font belum siap */
        body { font-family: sans-serif; }
        /* Pastikan elemen LCP p.text-muted tidak disembunyikan JS di awal */
        .text-muted { display: block !important; }
        /* maps */
        #map {
            height: 400px;
            /* WAJIB ada height agar muncul */
            width: 100%;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            display: block !important;
            opacity: 1 !important;
            cursor: pointer !important;
            /* Opsional: memastikan ikon tidak tertutup */
            position: absolute;
            right: 15px;
        }

        /* Memastikan input memiliki ruang untuk absolute position */
        input[type="date"] {
            position: relative;
        }


    </style>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('admin.partial.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        @yield('content')
        <!--end::App Main-->

        <footer class="app-footer text-center py-3 ">

            <strong class="text-center py-3">
                Copyright Dinas Koperasi Dan Usaha Mikro Kabupaten Tangerang &copy; 2026&nbsp;
                <!-- <a href="https://adminlte.io" class="text-decoration-none">Kementrian UMKM</a>. -->
            </strong>
            All rights reserved.
        </footer>
    </div>
    <!--end::App Wrapper-->

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/adminlte.js') }}" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    {{-- chart cdn --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(".sidebar-wrapper");
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined") {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: "os-theme-light",
                        autoHide: "leave",
                        clickScroll: true,
                    },
                });
            }
        });

        // row per pages
        //     document.getElementById('rowPerPage').addEventListener('change', function() {
        //     const rowPerPage = this.value;
        //     const url = new URL(window.location.href);

        //     // Update atau tambah parameter row_per_page
        //     url.searchParams.set('row_per_page', rowPerPage);

        //     // Reset ke halaman 1 setiap kali jumlah baris berubah agar tidak error
        //     url.searchParams.set('page', 1);

        //     // Pindah ke URL baru
        //     window.location.href = url.href;
        // });
    </script>

     <!--end::Script-->

    {{-- delete cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data " + name + " akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user klik 'Ya', submit form-nya
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        </script>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 4000, // Hilang otomatis dalam 3 detik
                    showConfirmButton: false
                });
            </script>
        @endif --}}

    <script>
        function bukaTab(evt, tabName) {
            // 1. Sembunyikan semua konten
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-pane");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.add("d-none");
                tabcontent[i].classList.remove("active");
            }

            // 2. Hilangkan class 'active' dan styling kuning dari semua tombol navigasi
            tablinks = document.getElementsByClassName("nav-link");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
                // Hapus background kuning dari parent <ol> jika perlu
                tablinks[i].parentElement.classList.remove("bg-secondary", "bg-opacity-10", "border-start", "border-4",
                    "border-warning");
            }

            // 3. Tampilkan konten yang dipilih
            document.getElementById(tabName).classList.remove("d-none");
            document.getElementById(tabName).classList.add("active");

            // 4. Tambahkan class active ke tombol yang diklik
            evt.currentTarget.classList.add("active");

            // 5. Opsional: Tambahkan border kuning ke parent <ol> yang sedang aktif
            evt.currentTarget.parentElement.classList.add("bg-secondary", "bg-opacity-10", "border-start", "border-4",
                "border-warning");
        }
    </script>

    @if (Request::is('sebaran-data-umkm') || Request::is('filter-skala'))

    <script>
        const exportUrlTemplate = "{{ route('admin.export.skala', ['skala' => ':skala']) }}";
        const filterUrlTemplate = "{{ route('admin.filter.skala') }}";
    </script>
    <script>
            // document.querySelectorAll('.skala-card').forEach(card => {
            //     card.addEventListener('click', function () {

            //         let skala = this.dataset.skala;

            //         fetch(`/filter-skala?skala=${skala}`)
            //             .then(response => response.text())
            //             .then(html => {
            //                 document.getElementById('tableContainer').innerHTML = html;
            //             });

            //     });
            // });
            let skala = '';
            // Klik card skala
            document.querySelectorAll('.skala-card').forEach(card => {

                card.addEventListener('click', function () {
               
                     skala = this.dataset.skala;
                     console.log(skala)

                    let titleMap = {
                        mikro: "Data Usaha Mikro",
                        kecil: "Data Usaha Kecil",
                        menengah: "Data Usaha Menengah"
                    };

                    document.getElementById('exportBtn').classList.remove('d-none')
                    const formSeach = document.getElementById('formSearch');
                        
                           formSeach.classList.remove('d-none');

                    // document.getElementById('exportBtn').href =
                    //     `/export-skala/${skala}`;

                    document.getElementById('exportBtn').href =
                        exportUrlTemplate.replace(':skala', skala);

                    document.getElementById('skalaTitle9').innerText = titleMap[skala];

                    // loadTable(`/filter-skala?skala=${skala}`);
                    loadTable(`${filterUrlTemplate}?skala=${skala}`);           

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
        document.getElementById('btnDoSearch').addEventListener('click', function() {
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
            // Panggil loadWilayah dengan kecamatan + kata kunci search
            const url = `${filterUrlTemplate}?skala=${encodeURIComponent(skala)}&search=${encodeURIComponent(searchValue)}`;
            loadTable(url);
        }

        document.getElementById('btnResetSearch').addEventListener('click', function() {
            document.getElementById('searchInputWilayah').value = '';
            loadTable(`${filterUrlTemplate}?skala=${encodeURIComponent(skala)}`);
        });
    </script>

    
    @elseif (Request::is('usaha-berdasarkan-wilayah'))

        {{-- usaha berdasarkan wilayah --}}

    <script>
            const exportWilayahTemplate = "{{ route('admin.export.wilayah', ['kecamatan' => ':kecamatan']) }}";
            const filterWilayahUrl = "{{ route('admin.filter.wilayah') }}";
    </script>
       <script>
           // 1. Daftarkan plugin secara global
           Chart.register(ChartDataLabels);
           const totalData = @json($identitasUsaha->count());
           const canvas = document.getElementById('businessChart');

           canvas.height = totalData * 8; // ⬅ ini kuncinya
        let kecamatan = "";
           const ctx = canvas.getContext('2d');

           const businessChart = new Chart(ctx, {
               type: 'bar',
               data: {
                   // labels: ['PASAR KEMIS', 'RAJEG', 'CIKUPA', 'TIGARAKSA', 'TELUKNAGA', 'BALARAJA', 'PANOGAN',
                   //     'PAKUHAJI', 'SEPATAN', 'CURUG'
                   // ],
                   labels: @json($identitasUsaha->pluck('kecamatan')).map(item => {
                               return item.replace(/^[0-9.]+\s*/, '');
                           }),
                   datasets: [{
                       // data: [19967, 18213, 16390, 15390, 14390, 13390, 12390, 11390, 11290, 11190],
                       data: @json($identitasUsaha->pluck('total')),
                       backgroundColor: '#7D13E8',
                       barThickness: 18,
                       categoryPercentage: 0.5,
                       barPercentage: 0.7
                   }]
               },
               options: {
                   indexAxis: 'y',
                   responsive: true,
                   // Tambahkan padding di sisi kanan agar angka tidak terpotong

                   layout: {
                       padding: {
                           right: 50
                       }
                   },

                    onClick: function (evt, elements) {
                       if (elements.length > 0) {

                           const index = elements[0].index;
                        kecamatan = this.data.labels[index];

                           document.getElementById('skalaTitle2').innerText =
                           "Data UMKM Kecamatan " + kecamatan;
                           const btn = document.getElementById('btnExportWilayah');
                           const formSeach = document.getElementById('formSearch');
                        
                           formSeach.classList.remove('d-none');
                           btn.classList.remove('d-none');

                           // ubah link export
                        //    btn.href = `/export-wilayah/${kecamatan}`;
                        //    btn.href =  exportWilayahTemplate.replace(':kecamatan', encodeURIComponent(kecamatan));

                        //    loadWilayah(`/filter-wilayah?kecamatan=${encodeURIComponent(kecamatan)}`);
                        updateExportUrl();
                        loadWilayah(`${filterWilayahUrl}?kecamatan=${encodeURIComponent(kecamatan)}`);
                       }
                   },

                   plugins: {
                       legend: {
                           display: false
                       },
                       // 2. Konfigurasi Label Angka
                       datalabels: {
                           anchor: 'end', // Posisi di ujung batang
                           align: 'end', // Muncul setelah batang berakhir
                           color: '#333',
                           font: {
                               weight: 'bold'
                           },
                           formatter: function(value) {
                               // Format angka menjadi ribuan dengan titik (19.967)
                               return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                           }
                       }
                   },
                   scales: {
                       x: {
                           display: false
                       }, // Sembunyikan garis bawah agar bersih
                       y: {
                           grid: {
                               display: false
                           },
                           ticks: {
                               font: {
                                   weight: 'bold',
                                   size: 11
                               }
                           }
                       }
                   }
               }
           });

        function loadWilayah(url) {
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainerWilayah').innerHTML = html;
                });
            }

            // Fungsi untuk update href tombol export
            function updateExportUrl() {
                const skala = document.getElementById('filterSkala').value;
                const search = document.getElementById('searchInputWilayah').value;

                let exportUrl = exportWilayahTemplate.replace(':kecamatan', encodeURIComponent(kecamatan));
                            
                 const params = new URLSearchParams();
                if (skala) params.append('skala', skala);
                if (search) params.append('search', search);
                            
                const queryString = params.toString();
                if (queryString) {
                    exportUrl += '?' + queryString;
                }            
                document.getElementById('btnExportWilayah').href = exportUrl;
            }

        document.addEventListener('click', function (e) {
            if (e.target.closest('#tableContainerWilayah .pagination a')) {
                e.preventDefault();

                let url = e.target.closest('a').getAttribute('href');


                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableContainerWilayah').innerHTML = html;
                    });
            }
        });

        // --- LOGIKA PENCARIAN AJAX ---
        document.getElementById('btnDoSearch').addEventListener('click', function() {
            performSearch();
            updateExportUrl(); // ← tambahkan ini

        });
        // Support tekan "Enter" di input search
        document.getElementById('searchInputWilayah').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
                document.getElementById('filterSkala').addEventListener('change', function() {
                    performSearch();
                    updateExportUrl();
            });

        function performSearch() {
            const searchValue = document.getElementById('searchInputWilayah').value;
            const skalaValue = document.getElementById('filterSkala').value; // Ambil nilai dropdown
            // Panggil loadWilayah dengan kecamatan + kata kunci search
            // const url = `${filterWilayahUrl}?kecamatan=${encodeURIComponent(kecamatan)}&search=${encodeURIComponent(searchValue)}`;
            const url = `${filterWilayahUrl}?kecamatan=${encodeURIComponent(kecamatan)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
            loadWilayah(url);
        }

        

        document.getElementById('btnResetSearch').addEventListener('click', function() {
            document.getElementById('searchInputWilayah').value = '';
            document.getElementById('filterSkala').value = ''; // Reset dropdown
            updateExportUrl(); // ← tambahkan ini

            loadWilayah(`${filterWilayahUrl}?kecamatan=${encodeURIComponent(kecamatan)}`);
        });

       </script>
       {{-- batas usaha berdasarkan wilayah --}}
    @elseif (Request::is('usaha-berdasarkan-wilayah-desa'))

        {{-- usaha berdasarkan wilayah --}}

    <script>
            const exportWilayahTemplateDesa = "{{ route('admin.export.wilayah.kelurahan', ['kelurahan' => ':kelurahan']) }}";
            const filterWilayahUrlDesa = "{{ route('admin.filter.wilayah.desa') }}";
    </script>
       <script>
           // 1. Daftarkan plugin secara global
           Chart.register(ChartDataLabels);
           const totalData = @json($identitasUsaha->count());
           const canvas = document.getElementById('businessChart');

           canvas.height = totalData * 8; 
            let kelurahan = '';
           const ctx = canvas.getContext('2d');

           const businessChart = new Chart(ctx, {
               type: 'bar',
               data: {
                   // labels: ['PASAR KEMIS', 'RAJEG', 'CIKUPA', 'TIGARAKSA', 'TELUKNAGA', 'BALARAJA', 'PANOGAN',
                   //     'PAKUHAJI', 'SEPATAN', 'CURUG'
                   // ],
                   labels: @json($identitasUsaha->pluck('kelurahan')).map(item => {
                               return item.replace(/^[0-9.]+\s*/, '');
                           }),
                   datasets: [{
                       // data: [19967, 18213, 16390, 15390, 14390, 13390, 12390, 11390, 11290, 11190],
                       data: @json($identitasUsaha->pluck('total')),
                       backgroundColor: '#7D13E8',
                       barThickness: 18,
                       categoryPercentage: 0.5,
                       barPercentage: 0.7
                   }]
               },
               options: {
                   indexAxis: 'y',
                   responsive: true,
                   // Tambahkan padding di sisi kanan agar angka tidak terpotong

                   layout: {
                       padding: {
                           right: 50
                       }
                   },

                    onClick: function (evt, elements) {
                       if (elements.length > 0) {

                           const index = elements[0].index;
                           kelurahan = this.data.labels[index];

                           document.getElementById('skalaTitle2').innerText =
                           "Data UMKM Keluarahan/Desa " + kelurahan;
                           const btn = document.getElementById('btnExportWilayah');
                           const formSeach = document.getElementById('formSearch');
                        
                           formSeach.classList.remove('d-none');
                           btn.classList.remove('d-none');

                           updateExportUrl();

                           // ubah link export
                        //    btn.href = `/export-wilayah/${kecamatan}`;
                        //    btn.href =  exportWilayahTemplateDesa.replace(':kecamatan', encodeURIComponent(kelurahan));

                        //    loadWilayah(`/filter-wilayah?kecamatan=${encodeURIComponent(kecamatan)}`);
                        loadWilayah(`${filterWilayahUrlDesa}?kelurahan=${encodeURIComponent(kelurahan)}`
);
                       }
                   },

                   plugins: {
                       legend: {
                           display: false
                       },
                       // 2. Konfigurasi Label Angka
                       datalabels: {
                           anchor: 'end', // Posisi di ujung batang
                           align: 'end', // Muncul setelah batang berakhir
                           color: '#333',
                           font: {
                               weight: 'bold'
                           },
                           formatter: function(value) {
                               // Format angka menjadi ribuan dengan titik (19.967)
                               return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                           }
                       }
                   },
                   scales: {
                       x: {
                           display: false
                       }, // Sembunyikan garis bawah agar bersih
                       y: {
                           grid: {
                               display: false
                           },
                           ticks: {
                               font: {
                                   weight: 'bold',
                                   size: 11
                               }
                           }
                       }
                   }
               }
           });

        function loadWilayah(url) {
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainerWilayah').innerHTML = html;
                });
            }
        function updateExportUrl() {
                const skala = document.getElementById('filterSkala').value;
                const search = document.getElementById('searchInputWilayah').value;

                let exportUrl = exportWilayahTemplateDesa.replace(':kelurahan', encodeURIComponent(kelurahan));
                            
                 const params = new URLSearchParams();
                if (skala) params.append('skala', skala);
                if (search) params.append('search', search);
                            
                const queryString = params.toString();
                if (queryString) {
                    exportUrl += '?' + queryString;
                }            
                document.getElementById('btnExportWilayah').href = exportUrl;
            }


        document.addEventListener('click', function (e) {
            if (e.target.closest('#tableContainerWilayah .pagination a')) {
                e.preventDefault();

                let url = e.target.closest('a').getAttribute('href');


                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableContainerWilayah').innerHTML = html;
                    });
            }
        });

         // --- LOGIKA PENCARIAN AJAX ---
        document.getElementById('btnDoSearch').addEventListener('click', function() {
            performSearch();
            updateExportUrl();
        });
        // Support tekan "Enter" di input search
        document.getElementById('searchInputWilayah').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
                updateExportUrl();
            }
        });

        document.getElementById('filterSkala').addEventListener('change', function() {
            performSearch();
            updateExportUrl();
        });


        function performSearch() {
            const searchValue = document.getElementById('searchInputWilayah').value;
            const skalaValue = document.getElementById('filterSkala').value; // Ambil nilai dropdown

            // Panggil loadWilayah dengan kecamatan + kata kunci search
            // const url = `${filterWilayahUrlDesa}?kelurahan=${encodeURIComponent(kelurahan)}&search=${encodeURIComponent(searchValue)}`;
            const url = `${filterWilayahUrlDesa}?kelurahan=${encodeURIComponent(kelurahan)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;

            loadWilayah(url);
        }

        document.getElementById('btnResetSearch').addEventListener('click', function() {
            document.getElementById('searchInputWilayah').value = '';
            document.getElementById('filterSkala').value =  ''
            updateExportUrl();
            loadWilayah(`${filterWilayahUrlDesa}?kelurahan=${encodeURIComponent(kelurahan)}`);
        });
        
       </script>
       {{-- batas usaha berdasarkan wilayah --}}

    
    @elseif(Request::is('usaha-berdasarkan-cluster-prioritas'))
    
    <script>
        const filterClusterUrl = "{{ route('admin.cluster.data') }}";
        const exportClusterUrl = "{{ route('admin.export.cluster.prioritas', ['cluster' => ':cluster']) }}";

    </script>

    <!-- usaha berdasarkan cluster -->
        <script>
            // Pastikan plugin sudah terdaftar (hanya perlu sekali di satu halaman)
            if (typeof ChartDataLabels !== 'undefined') {
                Chart.register(ChartDataLabels);
            }

            const clusterLabelsData = @json($cluster->pluck('kluster'));
            const clusterCountsData = @json($cluster->pluck('total'));
            const ctxCluster = document.getElementById('clusterChart').getContext('2d');
            let cluster = '';

            const clusterChart = new Chart(ctxCluster, {
                type: 'bar',
                data: {
                    labels: clusterLabelsData,
                    datasets: [{
                        data: clusterCountsData,
                        backgroundColor: '#7D13E8',
                        borderRadius: 5,
                        barThickness: 15,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            right: 60
                        } // Ruang ekstra untuk angka ribuan di kanan
                    },

                    onClick: function(evt, elements) {

                        if(elements.length === 0) return;

                        const index = elements[0].index;
                        cluster = this.data.labels[index];

                        document.getElementById('clusterTitle').innerText =
                            "Data Usaha Cluster " + cluster;

                        document.getElementById('btnExportWilayah').classList.remove('d-none');
                        const formSeach = document.getElementById('formSearch');
                        formSeach.classList.remove('d-none');
                        updateExportUrl();
                        loadTableCluster(`${filterClusterUrl}?cluster=${encodeURIComponent(cluster)}`
);
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            color: '#000',
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: (value) => value.toLocaleString('id-ID') // Format titik (contoh: 89.543)
                        }
                    },

                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: '#f0f0f0'
                            },
                            ticks: {
                                size: 10
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10,
                                    weight: '500'
                                },
                                color: '#333'
                            }
                        }
                    }
                }
            });


             // --- LOGIKA PENCARIAN AJAX ---
        document.getElementById('btnDoSearch').addEventListener('click', function() {
            performSearch();
            updateExportUrl();
        });
        // Support tekan "Enter" di input search
        document.getElementById('searchInputWilayah').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
                updateExportUrl();
            }
        });

        document.getElementById('filterSkala').addEventListener('change', function() {
             performSearch();
             updateExportUrl();
        });

        function performSearch() {
            const searchValue = document.getElementById('searchInputWilayah').value;
            const skalaValue = document.getElementById('filterSkala').value; // Ambil nilai dropdown

            // Panggil loadWilayah dengan kecamatan + kata kunci search
            // const url = `${filterClusterUrl}?cluster=${encodeURIComponent(cluster)}&search=${encodeURIComponent(searchValue)}`;
           const url = `${filterClusterUrl}?cluster=${encodeURIComponent(cluster)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;

            loadTableCluster(url);
        }

        document.getElementById('btnResetSearch').addEventListener('click', function() {
            document.getElementById('searchInputWilayah').value = '';
            document.getElementById('filterSkala').value = '';
            updateExportUrl();
            loadTableCluster(`${filterClusterUrl}?cluster=${encodeURIComponent(cluster)}`);
        });
        </script>
        <script>
            function loadTableCluster(url) {
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableCluster').innerHTML = html;
                    });
            }

             function updateExportUrl() {
                const skala = document.getElementById('filterSkala').value;
                const search = document.getElementById('searchInputWilayah').value;

                    let exportUrl = exportClusterUrl.replace(':cluster', encodeURIComponent(cluster));
                                
                    const params = new URLSearchParams();
                    if (skala) params.append('skala', skala);
                    if (search) params.append('search', search);
                                
                    const queryString = params.toString();
                    if (queryString) {
                        exportUrl += '?' + queryString;
                    }            
                document.getElementById('btnExportWilayah').href = exportUrl;
            }

            document.addEventListener('click', function (e) {
                if (e.target.closest('#tableCluster .pagination a')) {
                    e.preventDefault();

                    let url = e.target.closest('a').getAttribute('href');


                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('tableCluster').innerHTML = html;
                        });
                }
            });
        </script>
     <!-- usaha berdasarkan cluster -->
     @elseif(Request::is('usaha-berdasarkan-desil'))

        {{-- pengusaha berdasarkan desil --}}
        <script>
            // Pastikan Plugin Datalabels terdaftar jika belum
            if (typeof ChartDataLabels !== 'undefined') {
                Chart.register(ChartDataLabels);
            }

            const ctxDesil = document.getElementById('desilChart').getContext('2d');

            // Data sesuai gambar kedua
            // const desilLabels = [
            //     'Desil 1','Desil 2','Desil 3','Desil 4','Desil 5',
            //     'Desil 6','Desil 7','Desil 8','Desil 9','Desil 10'
            // ];
            // const desilValues = [24711, 24185, 23629, 22741, 22575, 22540, 21898, 21156, 20148, 17509];

            const desilChart = new Chart(ctxDesil, {
                type: 'bar',
                data: {
                    labels: @json($labelsDesils),
                    datasets: [{
                        data: @json($valuesDesils),
                        backgroundColor: '#4a6d8c', // Warna biru seragam
                        barThickness: 12, // Batang lebih ramping sesuai gambar
                        borderRadius: 2
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            right: 50,
                            left: 10
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            color: '#000',
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            formatter: (value) => value.toLocaleString('id-ID')
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: '#f0f0f0'
                            },
                            ticks: {
                                size: 10
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10,
                                    weight: '600'
                                },
                                color: '#444'
                            }
                        }
                    }
                }
            });
        </script>
        {{-- batas pengusaha berdasarkan desil --}}

    @elseif(Request::is('usaha-berdasarkan-kbli'))

    {{-- script kbli --}}
    <script>
        // Pastikan Plugin Datalabels terdaftar
        if (typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        const kbliLabels = @json($kbliChartData->pluck('kategori_kbli'));
        // console.log(kbliLabels);
        const kbliValues = @json($kbliChartData->pluck('total'));

        const ctxKbli = document.getElementById('kbliChart').getContext('2d');

        // Data dari gambar

        // Logika pewarnaan: 5 teratas Hijau, sisanya Biru
        const backgroundColors = kbliValues.map((value, index) =>
            index < 5 ? '#48a44c' : '#4a6d8c'
        );

        const kbliChart = new Chart(ctxKbli, {
            type: 'bar', // Batang Vertikal
            data: {
                labels: kbliLabels,
                datasets: [{
                    data: kbliValues,
                    backgroundColor: backgroundColors,
                    borderRadius: 4,
                    barThickness: 30,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: '#444',
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        formatter: (value) => value.toLocaleString('id-ID')
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: {
                            display: false
                        },
                        grid: {
                            color: '#f0f0f0',
                            drawTicks: false
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('id-ID');
                            }
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
    </script>
    {{-- batas script kbli --}}


    @elseif(Request::is('indikator-usaha-lainnya'))
    {{-- usaha lainnya --}}

    <!-- blade variable kepemilikan nib -->
    <script>
        const exportNibBaseUrl = "{{ route('admin.export.nib') }}";
        const exportGenderBaseUrl = "{{ route('admin.export.gender') }}";
        const exportTenagaKerjaBaseUrl = "{{ route('admin.export.tenaga-kerja') }}";
        const exportMetodeBaseUrl = "{{ route('admin.export.metode-pemasaran') }}";

        

        const filterNibUrl = "{{ route('admin.filter.nib') }}";
        const filterMetodePemasaranUsaha = "{{ route('admin.filter.metode.pemasaran.usaha') }}"
    </script>

   
    <!-- ===================== script berdasarkan nib ======================== -->
    <script>
        // Pastikan Plugin Datalabels terdaftar
        if (typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        // --- 1. CHART KEPEMILIKAN NIB (PIE) ---
        const punyaNIB = @json($punyaNIB);
        const tidakPunyaNIB = @json($tidakPunyaNIB);
        // let nibData = '';
        const ctxNib = document.getElementById('nibChart').getContext('2d');
        new Chart(ctxNib, {
            type: 'pie',
            data: {
                labels: ['Punya', 'Tidak'],
                datasets: [{
                    data: [punyaNIB, tidakPunyaNIB], // Sesuaikan dengan data asli Anda
                    backgroundColor: ['#d4a017', '#2b4c7e'], // Warna kuning & biru tua
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;

                        // nibData = this.data.labels[index];
                        currentActiveLabel = this.data.labels[index];
                        currentType = 'NIB'; // Set mode NIB

                        document.getElementById('detailTitle88').innerText = "Data UMKM - NIB " + currentActiveLabel;
                        document.getElementById('formSearch').classList.remove('d-none');
                        document.getElementById('btnExportNib').classList.remove('d-none');
                        performUniversalSearch();

                        // btn.href = `/export-nib/${encodeURIComponent(label)}`;
                        // loadNIB(`/filter-nib?status=${label}`);
                        //     btn.href =
                        // exportNibTemplate.replace(':status', encodeURIComponent(nibData));

                        // loadNIB(`${filterNibUrl}?status=${encodeURIComponent(nibData)}`);

                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            font: {
                                size: 11
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        },
                        formatter: (value, ctx) => {
                            let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return value > 10000 ? "" : percentage; // Hanya tampilkan yang kecil jika perlu
                        }
                    }
                }
            }
        });

        // --- 2. CHART METODE PEMASARAN (VERTICAL BAR) ---
        const pemasaranLabels = [
                'Digital',
                'NonDigital',
                'Perantara',
                'Pemerintah Pusat',
                'Provinsi',
                'Kabupaten',
                'Lainnya'
            ];

   const pemasaranValues = [
            {{ $pemasaran['toko_sendiri'] }},
            {{ $pemasaran['titip_jual'] }},
            {{ $pemasaran['reseller'] }},
            {{ $pemasaran['distributor'] }},
            {{ $pemasaran['marketplace'] }},
            {{ $pemasaran['media_sosial'] }},
            {{ $pemasaran['lainnya'] }}
        ];

        const ctxPemasaran = document.getElementById('pemasaranChart').getContext('2d');
        new Chart(ctxPemasaran, {
            type: 'bar',
            data: {
                labels: pemasaranLabels,
                datasets: [{
                    data: pemasaranValues,
                    backgroundColor: '#7D13E8',
                    borderRadius: 5,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                  onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;

                        // nibData = this.data.labels[index];
                        currentActiveLabel = this.data.labels[index];
                        currentType = 'PEMASARAN_USAHA'; // Set mode NIB

                        document.getElementById('detailTitle88').innerText = "Data Pemasaran Usaha " + currentActiveLabel;
                        document.getElementById('formSearch').classList.remove('d-none');
                        document.getElementById('btnExportNib').classList.remove('d-none');
                        performUniversalSearch();
                    }
                },
                layout: {
                    padding: {
                        top: 30   // kasih ruang di atas
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        formatter: (val) => val.toLocaleString('id-ID')
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0',
                            drawTicks: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            callback: (v) => v.toLocaleString('id-ID')
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10
                            },
                            // Memutar label jika terlalu panjang
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                }
            }
        });
    </script>

    <!-- blade route variable gender-->
    <script>
        const filterGenderUrl = "{{ route('admin.filter.gender') }}";
    </script>

    <!-- blade route variable jumlah tenaga kerja -->
    <script>
        const filterLaborUrl = "{{ route('admin.filter.tenaga.kerja') }}";
    </script>

    
    <!-- ===================== script berdasarkan gender ======================== -->
    <script>

        let dataGender = '';
        // Konfigurasi Umum untuk Donut Chart
        const donutOptions = {
            responsive: true,
            maintainAspectRatio: false,
            onClick: function(evt, elements) {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    // dataGender = this.data.labels[index];
                    currentActiveLabel = this.data.labels[index];
                    currentType = 'GENDER'; // Set mode GENDER
                    document.getElementById('detailTitle88').innerText = "Data Pengusaha - " + currentActiveLabel;
                    
                    document.getElementById('formSearch').classList.remove('d-none');
                    document.getElementById('btnExportNib').classList.remove('d-none');

                    // Set link export sesuai yang diklik
                    // btn.href = `/export-gender/${label}`;
                    // btn.href = exportGenderTemplate.replace(':gender', encodeURIComponent(dataGender));

                    // loadGender(`/filter-gender?gender=${label}` );
                    // loadGender(`${filterGenderUrl}?gender=${encodeURIComponent(dataGender)}`);
                    performUniversalSearch();
                }
            },
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    display: false
                }
            }
        };


        // --- 1. CHART JENIS KELAMIN pengusaha ---
        const lakiLaki = @json((int) $jenisKelamin->laki_laki);
        const perempuan = @json((int) $jenisKelamin->perempuan);
        const tidakDiketahui = @json((int) $jenisKelamin->tidak_diketahui);
        const ctxGender = document.getElementById('genderChart').getContext('2d');

        new Chart(ctxGender, {
            type: 'doughnut',
            data: {
                labels: ['Laki-Laki', 'Perempuan', 'Tidak Diketahui'],
                datasets: [{
                    data: [lakiLaki, perempuan, tidakDiketahui],
                    backgroundColor: ['#d4a017', '#2b4c7e', '#ff0000'],
                    borderWidth: 0
                }]
            },
            options: donutOptions
        });


        // --- 2. CHART TENAGA KERJA ---
        const laborData = [
                    {{ $tenagaKerja->dibayar ?? 0 }},
                    {{ $tenagaKerja->tidak_dibayar ?? 0 }}
            ];

        // const totalLabor = {{ $totalTenagaKerja ?? 0 }};
        let dataLabor = "";
        const ctxLabor = document.getElementById('laborChart').getContext('2d');
        new Chart(ctxLabor, {
            type: 'doughnut',
            data: {
                labels: ['Dibayar', 'Tidak Dibayar'],
                datasets: [{
                    data: laborData,
                    backgroundColor: ['#d4a017', '#2b4c7e'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive : true,
                maintainAspectRatio: false,
                onClick: function(evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        // dataLabor = this.data.labels[index];
                        currentActiveLabel = this.data.labels[index];
                        currentType = 'TENAGA_KERJA';
                        document.getElementById('detailTitle88').innerText = "Data Tenaga Kerja - " + currentActiveLabel;
                        const btn = document.getElementById('btnExportNib');
                        const formSeach = document.getElementById('formSearch');
                        
                        formSeach.classList.remove('d-none');
                        btn.classList.remove('d-none');
                        performUniversalSearch();
                    }
                },
                cutout: '70%',
                plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            display: false
                        }
                    }
            },
        });
 
    </script>

    <script>
       
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
        // 1. Variabel Global untuk melacak status aktif
        let currentType = ''; // 'NIB', 'GENDER', atau 'LABOR'
        let currentActiveLabel = '';

        // 2. Fungsi Load Data Universal
        function loadTableData(url) {
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tableContainer6').innerHTML = html;
                });
        }

        // 3. Fungsi Search & Filter Universal
        function performUniversalSearch() {
            const searchValue = document.getElementById('searchInputWilayah').value;
            const skalaValue = document.getElementById('filterSkala').value;
            
            let url = "";
            let exportUrl = "";


            if (currentType === 'NIB') {
                url = `${filterNibUrl}?status=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
                exportUrl = `${exportNibBaseUrl}?status=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
            } else if (currentType === 'GENDER') {
                url = `${filterGenderUrl}?gender=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
                exportUrl = `${exportGenderBaseUrl}?gender=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
            } else if (currentType === 'PEMASARAN_USAHA') {
                url = `${filterMetodePemasaranUsaha}?metode=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
                exportUrl = `${exportMetodeBaseUrl}?metode=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
            }else if (currentType === 'TENAGA_KERJA'){
                url = `${filterLaborUrl}?status=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;
                exportUrl = `${exportTenagaKerjaBaseUrl}?status=${encodeURIComponent(currentActiveLabel)}&search=${encodeURIComponent(searchValue)}&skala=${skalaValue}`;

            }

            if (url !== ""){
                loadTableData(url);
                 const btnExport = document.getElementById('btnExportNib');
                 btnExport.href = exportUrl;
            }
        }

        // 4. Update Event Listeners (Gunakan satu sumber)
        document.getElementById('btnDoSearch').addEventListener('click', performUniversalSearch);
        document.getElementById('filterSkala').addEventListener('change', performUniversalSearch);
        document.getElementById('searchInputWilayah').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') performUniversalSearch();
        });

        document.getElementById('btnResetSearch').addEventListener('click', function() {
        document.getElementById('searchInputWilayah').value = '';
        document.getElementById('filterSkala').value = '';
        performUniversalSearch(); // Jalankan ulang pencarian bersih
    });

    </script>

    
    @else

    {{-- batas usaha lainnya --}}
    @endif


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      lucide.createIcons();
    </script>

     {{-- delete cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data " + name + " akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user klik 'Ya', submit form-nya
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

    </script>
    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 4000, // Hilang otomatis dalam 3 detik
                showConfirmButton: false
            });
        </script>
    @endif
</body>
<!--end::Body-->

</html>
