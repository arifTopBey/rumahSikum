@extends('admin.main.main')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #2b3a61;">Statistik Koperasi</h4>
            <small class="text-muted">Status Data : 25 Januari 2026 08:38:36</small>
        </div>
        <button class="btn btn-outline-secondary btn-sm px-3 d-flex align-items-center gap-2" style="border-radius: 8px;">
            <i class="bi bi-funnel"></i> Filter
        </button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-4 col-md-5 d-flex flex-column gap-3">
            <div class="card border-0 text-white text-center p-3" style="background-color: #3b82f6; border-radius: 12px; min-height: 110px;">
                <div class="fw-semibold" style="font-size: 0.95rem;">Koperasi Aktif</div>
                <div class="display-6 fw-bold my-auto">628</div>
            </div>
            <div class="card border-0 text-white text-center p-3" style="background-color: #c2410c; border-radius: 12px; min-height: 110px;">
                <div class="fw-semibold" style="font-size: 0.95rem;">Belum Bersertifikat NIK</div>
                <div class="display-6 fw-bold mt-1 mb-0">497</div>
                <small style="font-size: 0.75rem; opacity: 0.9;">79.14% dari 628 Koperasi Aktif</small>
            </div>
        </div>

        <div class="col-lg-8 col-md-7">
            <div class="card border-0 text-white h-100 overflow-hidden" style="background-color: #16a34a; border-radius: 12px;">
                <div class="text-center p-3 border-bottom border-white border-opacity-20" style="min-height: 110px; content-visibility: auto;">
                    <div class="fw-semibold" style="font-size: 0.95rem;">Bersertifikat NIK</div>
                    <div class="display-6 fw-bold mt-1 mb-0">131</div>
                    <small style="font-size: 0.75rem; opacity: 0.9;">20.86% dari 628 Koperasi Aktif</small>
                </div>
                <div class="row g-0 flex-grow-1 text-center">
                    <div class="col-6 p-3 border-end border-white border-opacity-20">
                        <div class="fw-semibold" style="font-size: 0.85rem;">Sertifikat NIK Aktif</div>
                        <div class="h3 fw-bold my-1">41</div>
                        <div style="font-size: 0.7rem; opacity: 0.9;">31.3% dari 131 Koperasi Bersertifikat NIK</div>
                    </div>
                    <div class="col-6 p-3">
                        <div class="fw-semibold" style="font-size: 0.85rem;">Sertifikat NIK Expired</div>
                        <div class="h3 fw-bold my-1">90</div>
                        <div style="font-size: 0.7rem; opacity: 0.9;">68.7% dari 131 Koperasi Bersertifikat NIK</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #334155;">Anggota</h6>
                <div class="mx-auto mb-3" style="position: relative; height: 160px; width: 160px;">
                    <canvas id="chartAnggota"></canvas>
                </div>
                <div class="mt-auto overflow-hidden" style="border-radius: 6px; font-size: 0.75rem;">
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #3b82f6;">
                        <span>Pria</span><span class="fw-bold">9,159 (37.60%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #b91c1c;">
                        <span>Wanita</span><span class="fw-bold">15,199 (62.40%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #334155;">Karyawan</h6>
                <div class="mx-auto mb-3" style="position: relative; height: 160px; width: 160px;">
                    <canvas id="chartKaryawan"></canvas>
                </div>
                <div class="mt-auto overflow-hidden" style="border-radius: 6px; font-size: 0.75rem;">
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c;">
                        <span>Pria</span><span class="fw-bold">103 (71.03%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #4f46e5;">
                        <span>Wanita</span><span class="fw-bold">42 (28.97%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #334155;">Manajer</h6>
                <div class="mx-auto mb-3" style="position: relative; height: 160px; width: 160px;">
                    <canvas id="chartManajer"></canvas>
                </div>
                <div class="mt-auto overflow-hidden" style="border-radius: 6px; font-size: 0.75rem;">
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #16a34a;">
                        <span>Pria</span><span class="fw-bold">7 (77.78%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #60a5fa;">
                        <span>Wanita</span><span class="fw-bold">2 (22.22%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 d-flex flex-column gap-3 justify-content-between">
            <div class="card border-0 p-3 text-center d-flex flex-column justify-content-center flex-grow-1" style="border-radius: 12px; background: white; min-height: 90px;">
                <small class="text-muted fw-semibold">Anggota</small>
                <h4 class="fw-bold m-0 mt-1" style="color: #1e293b;">24,358</h4>
            </div>
            <div class="card border-0 p-3 text-center d-flex flex-column justify-content-center flex-grow-1" style="border-radius: 12px; background: white; min-height: 90px;">
                <small class="text-muted fw-semibold">Karyawan</small>
                <h4 class="fw-bold m-0 mt-1" style="color: #1e293b;">145</h4>
            </div>
            <div class="card border-0 p-3 text-center d-flex flex-column justify-content-center flex-grow-1" style="border-radius: 12px; background: white; min-height: 90px;">
                <small class="text-muted fw-semibold">Manajer</small>
                <h4 class="fw-bold m-0 mt-1" style="color: #1e293b;">9</h4>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        };

        // 1. Chart Anggota
        new Chart(document.getElementById('chartAnggota'), {
            type: 'pie',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [37.6, 62.4],
                    backgroundColor: ['#3b82f6', '#b91c1c'],
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        // 2. Chart Karyawan
        new Chart(document.getElementById('chartKaryawan'), {
            type: 'pie',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [71.0, 29.0],
                    backgroundColor: ['#ea580c', '#4f46e5'],
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        // 3. Chart Manajer
        new Chart(document.getElementById('chartManajer'), {
            type: 'pie',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [77.8, 22.2],
                    backgroundColor: ['#16a34a', '#60a5fa'],
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });
    });
</script>
@endsection