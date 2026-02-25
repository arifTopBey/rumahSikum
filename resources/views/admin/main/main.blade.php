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
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('css/adminlte.css') }}" />

    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    {{-- leaft cdn --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
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

        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Kementrian UMKM</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2026&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">Kementrian UMKM</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
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

    {{-- usaha berdasarkan wilayah --}}
    <script>
        // 1. Daftarkan plugin secara global
        Chart.register(ChartDataLabels);

        const ctx = document.getElementById('businessChart').getContext('2d');

        const businessChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['PASAR KEMIS', 'RAJEG', 'CIKUPA', 'TIGARAKSA', 'TELUKNAGA', 'BALARAJA', 'PANOGAN',
                    'PAKUHAJI', 'SEPATAN', 'CURUG'
                ],
                datasets: [{
                    data: [19967, 18213, 16390, 15390, 14390, 13390, 12390, 11390, 11290, 11190],
                    backgroundColor: '#4a6d8c',
                    barThickness: 25,
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
    </script>
    {{-- batas usaha berdasarkan wilayah --}}



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

    {{-- usaha berdasarkan culuster --}}
    <script>
        // Pastikan plugin sudah terdaftar (hanya perlu sekali di satu halaman)
        if (typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        const ctxCluster = document.getElementById('clusterChart').getContext('2d');

        // Data dari gambar kedua
        const clusterLabels = [
            'PARIWISATA',
            'KULINER',
            'HANDICRAFT',
            'PERTAMBANGAN, ENERGI & ENERGI TERBARUKAN',
            'MBG(MAKAN BERGIZI GRATIS)',
            'PERUMAHAN RAKYAT',
            'KESEHATAN DAN KECANTIKAN',
            'INDUSTRI OLAHRAGA',
            'SEKTOR SUPPLY CHAIN OTOMOTIF'
        ];
        const clusterValues = [89543, 57564, 2764, 909, 906, 691, 372, 18, 4];

        const clusterChart = new Chart(ctxCluster, {
            type: 'bar',
            data: {
                labels: clusterLabels,
                datasets: [{
                    data: clusterValues,
                    backgroundColor: '#4a6d8c',
                    borderRadius: 5, // Membuat ujung bar sedikit membulat
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
    </script>
    {{-- usaha berdasarkan culuster --}}

    {{-- pengusaha berdasarkan desil --}}
    <script>
        // Pastikan Plugin Datalabels terdaftar jika belum
        if (typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        const ctxDesil = document.getElementById('desilChart').getContext('2d');

        // Data sesuai gambar kedua
        const desilLabels = [
            'DESIL 8', 'DESIL 9', 'DESIL 3', 'DESIL 6', 'DESIL 5',
            'DESIL 4', 'DESIL 7', 'DESIL 10', 'DESIL 2', 'DESIL 1'
        ];
        const desilValues = [24711, 24185, 23629, 22741, 22575, 22540, 21898, 21156, 20148, 17509];

        const desilChart = new Chart(ctxDesil, {
            type: 'bar',
            data: {
                labels: desilLabels,
                datasets: [{
                    data: desilValues,
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

    {{-- script kbli --}}
    <script>
        // Pastikan Plugin Datalabels terdaftar
        if (typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        const ctxKbli = document.getElementById('kbliChart').getContext('2d');

        // Data dari gambar
        const kbliLabels = ['G', 'I', 'S', 'C', 'H', 'E', 'J', 'N', 'F', 'L', 'P', 'Q', 'D'];
        const kbliValues = [117191, 72802, 16075, 15121, 6038, 4783, 2821, 2125, 1819, 1591, 1304, 1123, 972];

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

    {{-- usaha lainnya --}}
    <script>
        // Pastikan Plugin Datalabels terdaftar
        if (typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        // --- 1. CHART KEPEMILIKAN NIB (PIE) ---
        const ctxNib = document.getElementById('nibChart').getContext('2d');
        new Chart(ctxNib, {
            type: 'pie',
            data: {
                labels: ['Punya', 'Tidak'],
                datasets: [{
                    data: [5338, 240000], // Sesuaikan dengan data asli Anda
                    backgroundColor: ['#d4a017', '#2b4c7e'], // Warna kuning & biru tua
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
        const ctxPemasaran = document.getElementById('pemasaranChart').getContext('2d');
        new Chart(ctxPemasaran, {
            type: 'bar',
            data: {
                labels: ['Non Digital (Pasar)', 'Digital (E-Commerce)', 'Lainnya', 'Perantara', 'Vendor Prov',
                    'Vendor Pusat'
                ],
                datasets: [{
                    data: [160166, 23039, 6883, 2118, 8, 4],
                    backgroundColor: '#4a6d8c',
                    borderRadius: 5,
                    barThickness: 40
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

    <script>
        // Konfigurasi Umum untuk Donut Chart
        const donutOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%', // Membuat lubang di tengah (Donut)
            plugins: {
                legend: {
                    display: false
                }, // Kita pakai legend kustom di HTML
                datalabels: {
                    display: false
                } // Matikan label di dalam chart agar bersih
            }
        };

        // --- 1. CHART JENIS KELAMIN ---
        const ctxGender = document.getElementById('genderChart').getContext('2d');
        new Chart(ctxGender, {
            type: 'doughnut',
            data: {
                labels: ['Laki-Laki', 'Perempuan', 'Tidak Diketahui'],
                datasets: [{
                    data: [135696, 106618, 1], // Data simulasi berdasarkan persentase foto
                    backgroundColor: ['#d4a017', '#2b4c7e', '#ff0000'],
                    borderWidth: 0
                }]
            },
            options: donutOptions
        });

        // --- 2. CHART TENAGA KERJA ---
        const ctxLabor = document.getElementById('laborChart').getContext('2d');
        new Chart(ctxLabor, {
            type: 'doughnut',
            data: {
                labels: ['Dibayar', 'Tidak Dibayar'],
                datasets: [{
                    data: [104412, 243628], // Data simulasi (30% vs 70%)
                    backgroundColor: ['#d4a017', '#2b4c7e'],
                    borderWidth: 0
                }]
            },
            options: donutOptions
        });
    </script>
    {{-- batas usaha lainnya --}}
</body>
<!--end::Body-->

</html>
