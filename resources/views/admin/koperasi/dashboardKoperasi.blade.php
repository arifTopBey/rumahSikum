@extends('admin.main.main')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">

    <div class="card border-0 p-3 mb-4" style="border-radius: 8px; background: #eeeeee;">
        <div class="row g-3">
            <div class="col-md-6 d-flex align-items-center">
                <label class="fw-semibold me-3 text-secondary" style="font-size: 0.85rem; min-width: 130px;">Wilayah Keanggotaan</label>
                <select class="form-select form-select-sm bg-white" style="border-radius: 6px;">
                    <option>Semua Wilayah Keanggotaan</option>
                </select>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <label class="fw-semibold me-3 text-secondary" style="font-size: 0.85rem; min-width: 100px;">Jenis Koperasi</label>
                <select class="form-select form-select-sm bg-white" style="border-radius: 6px;">
                    <option>Semua Jenis Koperasi</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <small class="fw-bold text-dark" style="font-size: 0.85rem;">Status Data : {{ $tanggalData }}</small>
    </div>

    <div class="row g-2 mb-4 text-white text-center fw-semibold" style="font-size: 0.85rem;">
        <div class="col">
            <div class="p-3 shadow-sm" style="background-color: #3b82f6; border-radius: 6px;">
                <div>Koperasi Aktif</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($koperasiAktif) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 shadow-sm" style="background-color: #f97316; border-radius: 6px;">
                <div>Belum Bersertifikat</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($belumSertifikat) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 shadow-sm" style="background-color: #a3e635; border-radius: 6px;">
                <div>Sudah Bersertifikat</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($sudahSertifikat) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 shadow-sm" style="background-color: #0d9488; border-radius: 6px;">
                <div>Sertifikat Aktif</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($sertifikatAktif) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 shadow-sm" style="background-color: #dc2626; border-radius: 6px;">
                <div>Sertifikat Expired</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($sertifikatExp) }}</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-9">
            <div class="card border-0 p-4 shadow-sm" style="border-radius: 12px; background: white;">
                <div class="row g-4 row-cols-1 row-cols-md-3">

                    <div class="text-center d-flex flex-column align-items-center">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Anggota</span>
                        <div style="position: relative; height: 140px; width: 140px; cursor: pointer;">
                            <canvas id="donutAnggota"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Karyawan</span>
                        <div style="position: relative; height: 140px; width: 140px; cursor: pointer;">
                            <canvas id="donutKaryawan"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Manajer</span>
                        <div style="position: relative; height: 140px; width: 140px; cursor: pointer;">
                            <canvas id="donutManajer"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center mt-4">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Grade</span>
                        <div style="position: relative; height: 140px; width: 140px; cursor: pointer;">
                            <canvas id="donutGrade"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center mt-4">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">RAT</span>
                        <div style="position: relative; height: 140px; width: 140px; cursor: pointer;">
                            <canvas id="donutRAT"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center mt-4">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Modal Usaha (dalam Miliar)</span>
                        <div style="position: relative; height: 140px; width: 140px; cursor: pointer;">
                            <canvas id="donutModal"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3 d-flex flex-column justify-content-between gap-2">
            <div class="d-flex flex-column gap-2 mb-1">
                <div class="card border-0 p-2 text-center shadow-sm" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Anggota</small>
                    <div class="fw-bold text-dark" style="font-size: 1.1rem;">{{ number_format($totalAnggota) }}</div>
                </div>
                <div class="card border-0 p-2 text-center shadow-sm" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Karyawan</small>
                    <div class="fw-bold text-dark" style="font-size: 1.1rem;">{{ number_format($totalKaryawan) }}</div>
                </div>
                <div class="card border-0 p-2 text-center shadow-sm" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Manajer</small>
                    <div class="fw-bold text-dark" style="font-size: 1.1rem;">{{ number_format($totalManajer) }}</div>
                </div>
            </div>

            <div class="d-flex flex-column gap-2">
                <div class="card border-0 p-2 text-center shadow-sm" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Aset</small>
                    <div class="fw-bold text-dark" style="font-size: 1.1rem;">{{ number_format($totalAset, 2) }} Miliar</div>
                </div>
                <div class="card border-0 p-2 text-center shadow-sm" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Volume Usaha</small>
                    <div class="fw-bold text-dark" style="font-size: 1.1rem;">{{ number_format($totalVolume, 2) }} Miliar</div>
                </div>
                <div class="card border-0 p-2 text-center shadow-sm" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Sisa Hasil Usaha</small>
                    <div class="fw-bold text-dark" style="font-size: 1.1rem;">{{ number_format($totalSHU, 2) }} Miliar</div>
                </div>
            </div>
        </div>
    </div>

    <div id="dashboardTableContainer" class="card border-0 p-4 mt-4 shadow-sm d-none" style="border-radius: 12px; background: white;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold m-0 text-dark"><span id="selectedChartTitle">Detail Koperasi</span></h5>
            
            <div class="d-flex gap-2">
                <form action="{{ route('dashboard.chart.export') }}" method="POST" id="formExportChart">
                    @csrf
                    <input type="hidden" name="chart" id="exportChartName">
                    <input type="hidden" name="segment" id="exportSegmentName">
                    <button type="submit" class="btn btn-sm btn-success px-3" style="border-radius: 6px;">
                        <i class="fa fa-file-excel"></i> Export Excel
                    </button>
                </form>
                <button class="btn btn-sm btn-secondary" style="border-radius: 6px;" onclick="document.getElementById('dashboardTableContainer').classList.add('d-none')">Tutup Tabel</button>
            </div>
        </div>
        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
            <table class="table table-bordered table-striped table-hover align-middle mb-0" style="font-size: 0.85rem;">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th style="width: 20%;">NIK</th>
                        <th style="width: 40%;">Nama Koperasi</th>
                        <th style="width: 20%;">Kecamatan</th>
                        <th class="text-center" style="width: 15%;">Status</th>
                        <th class="text-center" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dashboardTableBody">
                    </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Fungsi Global Loader Data Detail ke Komponen Tabel Bawah Halaman
    function loadDashboardDetail(chartName, segmentName) {
        const container = document.getElementById('dashboardTableContainer');
        const tableBody = document.getElementById('dashboardTableBody');
        const titleSpan = document.getElementById('selectedChartTitle');

        // Salin parameter ke Form Export Excel Tersembunyi
        document.getElementById('exportChartName').value = chartName;
        document.getElementById('exportSegmentName').value = segmentName;

        // Tampilkan kontainer tabel & set tulisan loading awal
        container.classList.remove('d-none');
        titleSpan.innerText = "Detail Data: " + chartName + " (" + segmentName + ")";
        tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-4"><div class="spinner-border spinner-border-sm text-success" role="status"></div> Memuat data koperasi dari server...</td></tr>';
        
        // Scroll halaman secara smooth mengarah ke tabel detail di bawah
        container.scrollIntoView({ behavior: 'smooth' });

        // Request Fetch AJAX Data ke Backend Laravel Controller
        const url = "{{ route('dashboard.chart.detail') }}?chart=" + encodeURIComponent(chartName) + "&segment=" + encodeURIComponent(segmentName);
        
        fetch(url, {
            method: "GET",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = data.html;
        })
        .catch(error => {
            console.error("Error:", error);
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Gagal memuat baris data detail chart.</td></tr>';
        });
    }

    document.addEventListener("DOMContentLoaded", function() {

        // Base Configuration Options untuk 6 Grafik Donut
        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '78%',
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            onClick: function(evt, element) {
                if (element.length > 0) {
                    const chartElement = element[0];
                    const chartId = this.canvas.id;
                    const index = chartElement.index;
                    
                    // Identifikasi nama chart berdasarkan id canvas
                    let chartName = '';
                    if(chartId === 'donutAnggota') chartName = 'Anggota';
                    else if(chartId === 'donutKaryawan') chartName = 'Karyawan';
                    else if(chartId === 'donutManajer') chartName = 'Manajer';
                    else if(chartId === 'donutGrade') chartName = 'Grade';
                    else if(chartId === 'donutRAT') chartName = 'RAT';
                    else if(chartId === 'donutModal') chartName = 'Modal';

                    const segmentName = this.data.labels[index];
                    
                    // Trigger pembuat data di bawah
                    loadDashboardDetail(chartName, segmentName);
                }
            }
        };

        // 1. Donut Anggota
        new Chart(document.getElementById('donutAnggota'), {
            type: 'doughnut',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $anggotaPria }}, {{ $anggotaWanita }}],
                    backgroundColor: ['#3b82f6', '#dc2626'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 2. Donut Karyawan
        new Chart(document.getElementById('donutKaryawan'), {
            type: 'doughnut',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $karyawanPria }}, {{ $karyawanWanita }}],
                    backgroundColor: ['#3b82f6', '#f97316'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 3. Donut Manajer
        new Chart(document.getElementById('donutManajer'), {
            type: 'doughnut',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $manajerPria }}, {{ $manajerWanita }}],
                    backgroundColor: ['#f97316', '#22c55e'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 4. Donut Grade
        new Chart(document.getElementById('donutGrade'), {
            type: 'doughnut',
            data: {
                labels: ['Grade A', 'Grade B', 'Grade C1', 'Grade C2', 'Non Grade'],
                datasets: [{
                    data: [
                        {{ $gradeData['A'] }}, 
                        {{ $gradeData['B'] }}, 
                        {{ $gradeData['C1'] }}, 
                        {{ $gradeData['C2'] }}, 
                        {{ $gradeData['Non'] }}
                    ],
                    backgroundColor: ['#dc2626', '#3b82f6', '#22c55e', '#a855f7', '#e2e8f0'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 5. Donut RAT
        new Chart(document.getElementById('donutRAT'), {
            type: 'doughnut',
            data: {
                labels: ['Sudah RAT', 'Belum RAT'],
                datasets: [{
                    data: [{{ $sudahRAT }}, {{ $belumRAT }}],
                    backgroundColor: ['#22c55e', '#eab308'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 6. Donut Modal
        new Chart(document.getElementById('donutModal'), {
            type: 'doughnut',
            data: {
                labels: ['Modal Sendiri', 'Modal Luar'],
                datasets: [{
                    data: [{{ $modalSendiri }}, {{ $modalLuar }}],
                    backgroundColor: ['#3b82f6', '#dc2626'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });
    });
</script>
@endsection