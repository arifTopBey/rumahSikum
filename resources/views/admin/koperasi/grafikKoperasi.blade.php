@extends('admin.main.main')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3 text-center" style="color: #334155;">Bentuk Koperasi</h6>
                <div style="position: relative; height: 280px; width: 100%;">
                    <canvas id="chartBentukHori"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3 text-center" style="color: #334155;">Sektor Usaha</h6>
                <div style="position: relative; height: 280px; width: 100%;">
                    <canvas id="chartSektorUsaha"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 p-4" style="border-radius: 12px; background: white;">
        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-xl-4 text-center">
            
            <div class="d-flex flex-column align-items-center">
                <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Jenis Koperasi</span>
                <div style="position: relative; height: 160px; width: 160px;">
                    <canvas id="chartJenisKopBottom"></canvas>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center">
                <span class="fw-bold text-secondary mb-1" style="font-size: 0.9rem;">Simpan Pinjam</span>
                <small class="text-muted mb-2" style="font-size: 0.75rem;">(exclude self-declare)</small>
                <div style="position: relative; height: 160px; width: 160px;">
                    <canvas id="chartSimpanPinjam"></canvas>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center">
                <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Pola Pengelolaan</span>
                <div style="position: relative; height: 160px; width: 160px;">
                    <canvas id="chartPolaPengelolaan"></canvas>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center">
                <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Pengurus dan Pengawas</span>
                <div style="position: relative; height: 160px; width: 160px;">
                    <canvas id="chartPengurusPengawas"></canvas>
                </div>
            </div>

        </div>
    </div>


    <div id="detailTableContainer" class="card border-0 p-4 mt-4 shadow-sm d-none" style="border-radius: 12px; background: white;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold m-0 text-dark">Daftar Koperasi: <span id="selectedCategoryName" class="text-primary">-</span></h5>
            <!-- <div class="d-flex gap-2">
                <a class="btn btn-sm btn-success">Export Excel</a>
                <button class="btn btn-sm btn-secondary" onclick="document.getElementById('detailTableContainer').classList.add('d-none')">Tutup Tabel</button>
            </div> -->
            <div class="d-flex gap-2">
                <form action="{{ route('koperasi.export.grafik.koperasi') }}" method="POST" id="formExportExcel">
                        @csrf
                        <input type="hidden" name="type" id="exportType">
                        <input type="hidden" name="value" id="exportValue">
                        <input type="hidden" name="datasetLabel" id="exportDatasetLabel">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </button>
                </form>
    
                <button class="btn btn-sm btn-secondary" onclick="document.getElementById('detailTableContainer').classList.add('d-none')">Tutup Tabel</button>
            </div>
        </div>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 0.85rem;">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th class="text-center" style="width: 5px;">No</th>
                        <th>NIK</th>
                        <th>Nama Koperasi</th>
                        <th>Wilayah/Alamat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Detail</th>

                    </tr>
                </thead>
                <tbody id="detailTableBody">
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // function loadKoperasiDetail(type, value, datasetLabel = '') {
    //     const container = document.getElementById('detailTableContainer');
    //     const tableBody = document.getElementById('detailTableBody');
    //     const titleSpan = document.getElementById('selectedCategoryName');

    //     container.classList.remove('d-none');
    //     tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary"></div> Memuat data...</td></tr>';
    //     titleSpan.innerText = value + (datasetLabel ? ' [' + datasetLabel + ']' : '');

    //     container.scrollIntoView({ behavior: 'smooth' });

    //     fetch("{{ route('koperasi.getListByChart') }}", {
    //         method: "POST",
    //         headers: {
    //             "Content-Type": "application/json",
    //             "X-CSRF-TOKEN": "{{ csrf_token() }}"
    //         },
    //         body: JSON.stringify({ type: type, value: value, datasetLabel: datasetLabel })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         tableBody.innerHTML = data.html;
    //         titleSpan.innerText = data.title;
    //     })
    //     .catch(error => {
    //         console.log("Error:", error);
    //         tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat data detail.</td></tr>';
    //     });
    // }

    function loadKoperasiDetail(type, value, datasetLabel = '') {
    const container = document.getElementById('detailTableContainer');
    const tableBody = document.getElementById('detailTableBody');
    const titleSpan = document.getElementById('selectedCategoryName');

    // ISI INPUT TERSEMBUNYI UNTUK FORM EXCEL
    document.getElementById('exportType').value = type;
    document.getElementById('exportValue').value = value;
    document.getElementById('exportDatasetLabel').value = datasetLabel;

    container.classList.remove('d-none');
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary"></div> Memuat data...</td></tr>';
    titleSpan.innerText = value + (datasetLabel ? ' [' + datasetLabel + ']' : '');

    container.scrollIntoView({ behavior: 'smooth' });

    fetch("{{ route('koperasi.getListByChart') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ type: type, value: value, datasetLabel: datasetLabel })
    })
    .then(response => response.json())
    .then(data => {
        tableBody.innerHTML = data.html;
        titleSpan.innerText = data.title;
    })
    .catch(error => {
        console.log("Error:", error);
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat data detail.</td></tr>';
    });
}


    document.addEventListener("DOMContentLoaded", function() {

        const paletteColors = ['#dc2626', '#a855f7', '#64748b', '#f97316', '#3b82f6', '#10b981', '#ec4899', '#4f46e5'];

        // ==========================================
        // 1. CHART BENTUK KOPERASI (HORIZONTAL BAR)
        // ==========================================
        new Chart(document.getElementById('chartBentukHori'), {
            type: 'bar',
            data: {
                labels: ['Primer Provinsi', 'Sekunder Nasional', 'Sekunder Kabupaten/Kota'],
                datasets: [
                    {
                        label: 'Primer',
                        data: [
                            {{ $bentukData['Primer Provinsi']['primer'] }}, 
                            {{ $bentukData['Sekunder Nasional']['primer'] }}, 
                            {{ $bentukData['Sekunder Kabupaten/Kota']['primer'] }}
                        ],
                        backgroundColor: '#facc15'
                    },
                    {
                        label: 'Sekunder',
                        data: [
                            {{ $bentukData['Primer Provinsi']['sekunder'] }}, 
                            {{ $bentukData['Sekunder Nasional']['sekunder'] }}, 
                            {{ $bentukData['Sekunder Kabupaten/Kota']['sekunder'] }}
                        ],
                        backgroundColor: '#ef4444'
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12 } }
                },
                scales: {
                    x: { grid: { color: '#f1f5f9' } },
                    y: { grid: { display: false } }
                },
               
                onClick: (e, activeEls, chart) => {
                        if (activeEls.length > 0) {
                            const dataIndex = activeEls[0].index;
                            const datasetIndex = activeEls[0].datasetIndex;
                            const label = chart.data.labels[dataIndex];
                            const datasetLabel = chart.data.datasets[datasetIndex].label; // 'Primer' atau 'Sekunder'
                            loadKoperasiDetail('Bentuk_Koperasi', label, datasetLabel);
                        }
                }
            },
        });

        // ==========================================
        // 2. CHART SEKTOR USAHA (VERTICAL BAR)
        // ==========================================
        new Chart(document.getElementById('chartSektorUsaha'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelsSektor) !!},
                datasets: [{
                    label: 'Sektor Usaha',
                    data: {!! json_encode($dataSektor) !!},
                    backgroundColor: paletteColors,
                    borderRadius: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false }, ticks: { font: { size: 9 } } }
                },
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const label = chart.data.labels[dataIndex];
                        loadKoperasiDetail('Sektor_Usaha', label);
                    }
                }
            }
        });

        // Konfigurasi Standar Ring Chart
        const doughnutOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } }
        };

        // ==========================================
        // 3. CHART JENIS KOPERASI (PIE)
        // ==========================================
        new Chart(document.getElementById('chartJenisKopBottom'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($labelsJenis) !!},
                datasets: [{
                    data: {!! json_encode($dataJenis) !!},
                    backgroundColor: paletteColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 9 } } } },
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const label = chart.data.labels[dataIndex];
                        loadKoperasiDetail('Jenis_Koperasi', label);
                    }
                }
            }
        });

        // ==========================================
        // 4. CHART SIMPAN PINJAM (DOUGHNUT)
        // ==========================================
        new Chart(document.getElementById('chartSimpanPinjam'), {
            type: 'doughnut',
            data: {
                labels: ['USP', 'USPPS', 'KSP', 'KSPPS'],
                datasets: [{
                    data:[{{ $usp }}, {{ $uspps }}, {{ $ksp }}, {{ $kspps }}],
                    backgroundColor: ['#2563eb', '#dc2626', '#a3e635', '#0d9488']
                }]
            },
            options: doughnutOptions
        });

        // ==========================================
        // 5. CHART POLA PENGELOLAAN (DOUGHNUT)
        // ==========================================
        new Chart(document.getElementById('chartPolaPengelolaan'), {
            type: 'doughnut',
            data: {
                labels: ['Konvensional', 'Syariah'],
                datasets: [{
                    data: [{{ $polaKonvensional }}, {{ $polaSyariah }}],
                    backgroundColor: ['#2563eb', '#dc2626']
                }]
            },
            options:    {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } },
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const label = chart.data.labels[dataIndex];
                        loadKoperasiDetail('Pola_Pengelolaan', label);
                    }
                }
            }
        });

        // ==========================================
        // 6. CHART PENGURUS DAN PENGAWAS (DOUGHNUT)
        // ==========================================
        new Chart(document.getElementById('chartPengurusPengawas'), {
            type: 'doughnut',
            data: {
                labels: ['Pengurus', 'Pengawas'],
                datasets: [{
                    data: [{{ $totalPengurus }}, {{ $totalPengawas }}],
                    backgroundColor: ['#ea580c', '#2563eb']
                }]
            },
            options: doughnutOptions
        });

    });
</script>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {

        // ==========================================
        // 1. CHART BENTUK KOPERASI (HORIZONTAL BAR)
        // ==========================================
        new Chart(document.getElementById('chartBentukHori'), {
            type: 'bar',
            data: {
                labels: ['Primer Provinsi', 'Sekunder Nasional', 'Sekunder Kabupaten/Kota'],
                datasets: [
                    {
                        label: 'Primer',
                        data: [125, 5, 626],
                        backgroundColor: '#facc15' // Kuning
                    },
                    {
                        label: 'Sekunder',
                        data: [0, 190, 4],
                        backgroundColor: '#ef4444' // Merah
                    }
                ]
            },
            options: {
                indexAxis: 'y', // Mengubah menjadi horizontal bar
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12 } }
                },
                scales: {
                    x: { max: 700, grid: { color: '#f1f5f9' } },
                    y: { grid: { display: false } }
                }
            }
        });

        // ==========================================
        // 2. CHART SEKTOR USAHA (VERTICAL BAR)
        // ==========================================
        new Chart(document.getElementById('chartSektorUsaha'), {
            type: 'bar',
            data: {
                labels: ['Pemerintahan', 'Jasa Kesehatan', 'Jasa Pendidikan', 'Pengelolaan Air', 'Pertanian & Perikanan'],
                datasets: [{
                    label: 'Sektor Usaha',
                    data: [25, 180, 20, 25, 345],
                    backgroundColor: ['#dc2626', '#a855f7', '#64748b', '#f97316', '#3b82f6'],
                    borderRadius: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { max: 400, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false }, ticks: { font: { size: 9 } } }
                }
            }
        });

        // Konfigurasi Standar Ring Chart
        const doughnutOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } }
        };

        // ==========================================
        // 3. CHART JENIS KOPERASI (PIE)
        // ==========================================
        new Chart(document.getElementById('chartJenisKopBottom'), {
            type: 'pie',
            data: {
                labels: ['Desa Merah Putih', 'Jasa', 'Kelurahan Merah Putih', 'Konsumen', 'Pemasaran', 'Produsen', 'Simpan Pinjam'],
                datasets: [{
                    data: [247, 56, 28, 408, 11, 58, 140],
                    backgroundColor: ['#4f46e5', '#38bdf8', '#fb7185', '#0d9488', '#ec4899', '#a3e635', '#eab308']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 9 } } } }
            }
        });

        // ==========================================
        // 4. CHART SIMPAN PINJAM (DOUGHNUT)
        // ==========================================
        new Chart(document.getElementById('chartSimpanPinjam'), {
            type: 'doughnut',
            data: {
                labels: ['USP', 'USPPS', 'KSP', 'KSPPS'],
                datasets: [{
                    data:[ 8, 0, 130, 10],
                    backgroundColor: ['#2563eb', '#dc2626', '#a3e635', '#0d9488']
                }]
            },
            options: doughnutOptions
        });

        // ==========================================
        // 5. CHART POLA PENGELOLAAN (DOUGHNUT)
        // ==========================================
        new Chart(document.getElementById('chartPolaPengelolaan'), {
            type: 'doughnut',
            data: {
                labels: ['Konvensional', 'Syariah'],
                datasets: [{
                    data: [933, 15],
                    backgroundColor: ['#2563eb', '#dc2626']
                }]
            },
            options: doughnutOptions
        });

        // ==========================================
        // 6. CHART PENGURUS DAN PENGAWAS (DOUGHNUT)
        // ==========================================
        new Chart(document.getElementById('chartPengurusPengawas'), {
            type: 'doughnut',
            data: {
                labels: ['Pengurus', 'Pengawas'],
                datasets: [{
                    data: [3614, 2468],
                    backgroundColor: ['#ea580c', '#2563eb']
                }]
            },
            options: doughnutOptions
        });

    });
</script> -->
@endsection