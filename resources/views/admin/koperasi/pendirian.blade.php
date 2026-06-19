@extends('admin.main.main')

@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                    <h6 class="fw-bold mb-3 text-center" style="color: #334155;">Pendirian</h6>
                    <div style="position: relative; height: 230px; width: 100%;">
                        <canvas id="chartPendirian"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                    <h6 class="fw-bold mb-3 text-center" style="color: #334155;">Perubahan</h6>
                    <div style="position: relative; height: 230px; width: 100%;">
                        <canvas id="chartPerubahan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                    <h6 class="fw-bold mb-3 text-center" style="color: #334155;">Lembaga Pengesahan</h6>
                    <div class="mx-auto" style="position: relative; height: 180px; width: 180px;">
                        <canvas id="chartLembagaPengesahan"></canvas>
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-3" style="font-size: 0.75rem;">
                        <div><span class="badge rounded-circle p-1 me-1" style="background-color: #4f46e5;">&nbsp;</span>
                            Pengesahan AHU ({{ $pengesahanAHU }})</div>
                        <div><span class="badge rounded-circle p-1 me-1" style="background-color: #f97316;">&nbsp;</span>
                            Pengesahan Lainnya ({{ $pengesahanLainnya }})</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                    <h6 class="fw-bold mb-3 text-center" style="color: #334155;">Pertumbuhan Koperasi (Aktif)</h6>
                    <div style="position: relative; height: 220px; width: 100%;">
                        <canvas id="chartPertumbuhan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div id="pendirianTableContainer" class="card border-0 p-4 mt-4 shadow-sm d-none" style="border-radius: 12px; background: white;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold m-0 text-dark">Detail Data: <span id="selectedCategoryName" class="text-primary">-</span></h5>
            <button class="btn btn-sm btn-secondary" onclick="document.getElementById('pendirianTableContainer').classList.add('d-none')">Tutup Tabel</button>
        </div>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 0.85rem;">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th class="text-center" style="width: 5px;">No</th>
                        <th>NIK</th>
                        <th>Nama Koperasi</th>
                        <th>Wilayah / Alamat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Detail</th>

                    </tr>
                </thead>
                <tbody id="pendirianTableBody">
                    </tbody>
            </table>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        function loadPendirianDetail(type, year, value = '') {
            const container = document.getElementById('pendirianTableContainer');
            const tableBody = document.getElementById('pendirianTableBody');
            const titleSpan = document.getElementById('selectedCategoryName');

            container.classList.remove('d-none');
            tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary"></div> Memuat detail data...</td></tr>';
            
            container.scrollIntoView({ behavior: 'smooth' });

            fetch("{{ route('koperasi.getPendirianDetail') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ type: type, year: year, value: value })
            })
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = data.html;
                titleSpan.innerText = data.title;
            })
            .catch(error => {
                console.error("Error:", error);
                tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat data detail.</td></tr>';
            });
        }


        const barColors = ['#4f46e5', '#b91c1c', '#a3e635', '#2dd4bf', '#7c3aed', '#5cadd3', '#f97316'];

        // ==========================================
        // 1. CHART PENDIRIAN (Dinamis)
        // ==========================================
        new Chart(document.getElementById('chartPendirian'), {
            type: 'bar',
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024', '2025', '2026'],
                datasets: [{
                    label: 'Pendirian',
                    data: {!! json_encode($dataPendirian) !!},
                    backgroundColor: barColors,
                    barPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false } }
                },
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const year = chart.data.labels[dataIndex];
                        loadPendirianDetail('Pendirian', year);
                    }
                }
            }
        });

        // ==========================================
        // 2. CHART PERUBAHAN (Dinamis)
        // ==========================================
        new Chart(document.getElementById('chartPerubahan'), {
            type: 'bar',
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024', '2025', '2026'],
                datasets: [{
                    label: 'Perubahan',
                    data: {!! json_encode($dataPerubahan) !!},
                    backgroundColor: barColors,
                    barPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false } }
                },
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const year = chart.data.labels[dataIndex];
                        loadPendirianDetail('Perubahan', year);
                    }
                }
            }
        });

        // ==========================================
        // 3. CHART LEMBAGA PENGESAHAN (Dinamis)
        // ==========================================
        new Chart(document.getElementById('chartLembagaPengesahan'), {
            type: 'doughnut',
            data: {
                labels: ['Pengesahan AHU', 'Pengesahan Lainnya'],
                datasets: [{
                    data: [{{ $pengesahanAHU }}, {{ $pengesahanLainnya }}],
                    backgroundColor: ['#4f46e5', '#f97316'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { display: false } },
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const value = chart.data.labels[dataIndex]; // 'Pengesahan AHU' atau 'Pengesahan Lainnya'
                        loadPendirianDetail('Pengesahan', '', value);
                    }
                }
            }
        });

        // ==========================================
        // 4. CHART PERTUMBUHAN KOPERASI (Dinamis)
        // ==========================================
        const labelsPertumbuhan = {!! json_encode($labelsPertumbuhan) !!};
        const dataPertumbuhan = {!! json_encode($dataPertumbuhan) !!};

        const repeatingColors = [];
        for (let i = 0; i < labelsPertumbuhan.length; i++) {
            repeatingColors.push(barColors[i % barColors.length]);
        }

        new Chart(document.getElementById('chartPertumbuhan'), {
            type: 'bar',
            data: {
                labels: labelsPertumbuhan,
                datasets: [{
                    label: 'Koperasi Aktif',
                    data: dataPertumbuhan,
                    backgroundColor: repeatingColors,
                    barPercentage: 0.85
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {

                    y: { grid: { color: '#f1f5f9' } },
                    x: { 
                        grid: { display: false },
                        ticks: {
                            font: { size: 9 },
                            callback: function(val, index) {
                                const year = labelsPertumbuhan[index];
                                return ['2001', '2004', '2007', '2010', '2013', '2016', '2019', '2022', '2025'].includes(year) ? year : '';
                            },
                            autoSkip: false
                        }
                    },
                       
                },
                 onClick: (e, activeEls, chart) => {
                        if (activeEls.length > 0) {
                            const dataIndex = activeEls[0].index;
                            const year = chart.data.labels[dataIndex]; // Mendapatkan tahun bar yang diklik (misal 2015)
                            loadPendirianDetail('Pertumbuhan', year);
                        }
                    }
            }
        });

    });
</script>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {

            // Palet Warna Multi-color untuk Grafik Batang Sejajar
            const barColors = ['#4f46e5', '#b91c1c', '#a3e635', '#2dd4bf', '#7c3aed', '#5cadd3', '#f97316'];

            // ==========================================
            // 1. CHART PENDIRIAN
            // ==========================================
            new Chart(document.getElementById('chartPendirian'), {
                type: 'bar',
                data: {
                    labels: ['2020', '2021', '2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                        label: 'Pendirian',
                        data: [35, 60, 55, 33, 38, 345, 5],
                        backgroundColor: barColors,
                        barPercentage: 0.8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { max: 400, grid: { color: '#f1f5f9' }, ticks: { stepSize: 200 } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // ==========================================
            // 2. CHART PERUBAHAN
            // ==========================================
            new Chart(document.getElementById('chartPerubahan'), {
                type: 'bar',
                data: {
                    labels: ['2020', '2021', '2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                        label: 'Perubahan',
                        data: [10, 18, 46, 50, 59, 43, 3],
                        backgroundColor: barColors,
                        barPercentage: 0.8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { max: 100, grid: { color: '#f1f5f9' }, ticks: { stepSize: 50 } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // ==========================================
            // 3. CHART LEMBAGA PENGESAHAN (DOUGHNUT)
            // ==========================================
            new Chart(document.getElementById('chartLembagaPengesahan'), {
                type: 'doughnut',
                data: {
                    labels: ['Pengesahan AHU', 'Pengesahan Lainnya'],
                    datasets: [{
                        data: [582, 366],
                        backgroundColor: ['#4f46e5', '#f97316'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: { legend: { display: false } }
                }
            });

            // ==========================================
            // 4. CHART PERTUMBUHAN KOPERASI (AKTIF)
            // ==========================================
            // Mengenerate label tahun secara berurutan dari 2001 hingga 2026
            const labelsPertumbuhan = [];
            for (let th = 2001; th <= 2026; th++) {
                labelsPertumbuhan.push(th.toString());
            }

            // Data dummy pertumbuhan akumulatif naik bertahap hingga mendekati angka 1.000
            const dataPertumbuhan = [
                80, 85, 90, 95, 100, 105, 110, 120, 125, 140,
                150, 165, 175, 190, 220, 250, 270, 320, 360, 400,
                460, 510, 550, 580, 940, 945
            ];

            // Skema warna berulang (repeating) untuk mengisi 26 batang diagram
            const repeatingColors = [];
            for (let i = 0; i < labelsPertumbuhan.length; i++) {
                repeatingColors.push(barColors[i % barColors.length]);
            }

            new Chart(document.getElementById('chartPertumbuhan'), {
                type: 'bar',
                data: {
                    labels: labelsPertumbuhan,
                    datasets: [{
                        label: 'Koperasi Aktif',
                        data: dataPertumbuhan,
                        backgroundColor: repeatingColors,
                        barPercentage: 0.85
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { max: 1000, grid: { color: '#f1f5f9' }, ticks: { stepSize: 500 } },
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 9 },
                                // Hanya menampilkan tahun tertentu agar sumbu X tidak terlalu padat
                                callback: function (val, index) {
                                    const year = labelsPertumbuhan[index];
                                    return ['2001', '2004', '2007', '2010', '2013', '2016', '2019', '2022', '2025'].includes(year) ? year : '';
                                },
                                autoSkip: false
                            }
                        }
                    }
                }
            });

        });
    </script> -->
@endsection