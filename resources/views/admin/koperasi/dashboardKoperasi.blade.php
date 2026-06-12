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
        <small class="fw-bold text-dark" style="font-size: 0.85rem;">Status Data : 2026-01-25 00:23:29.060 : 1</small>
    </div>

    <div class="row g-2 mb-4 text-white text-center fw-semibold" style="font-size: 0.85rem;">
        <div class="col">
            <div class="p-3" style="background-color: #3b82f6; border-radius: 6px;">
                <div>Koperasi Aktif</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($koperasiAktif) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3" style="background-color: #f97316; border-radius: 6px;">
                <div>Belum Bersertifikat</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($belumSertifikat) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3" style="background-color: #a3e635; border-radius: 6px;">
                <div>Sudah Bersertifikat</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($sudahSertifikat) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3" style="background-color: #0d9488; border-radius: 6px;">
                <div>Sertifikat Aktif</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($sertifikatAktif) }}</div>
            </div>
        </div>
        <div class="col">
            <div class="p-3" style="background-color: #dc2626; border-radius: 6px;">
                <div>Sertifikat Expired</div>
                <div class="h4 fw-bold m-0 mt-1">{{ number_format($sertifikatExp) }}</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        
        <div class="col-lg-9">
            <div class="card border-0 p-4" style="border-radius: 12px; background: white;">
                <div class="row g-4 row-cols-1 row-cols-md-3">
                    
                    <div class="text-center d-flex flex-column align-items-center">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Anggota</span>
                        <div style="position: relative; height: 150px; width: 150px;">
                            <canvas id="donutAnggota"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Karyawan</span>
                        <div style="position: relative; height: 150px; width: 150px;">
                            <canvas id="donutKaryawan"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Manajer</span>
                        <div style="position: relative; height: 150px; width: 150px;">
                            <canvas id="donutManajer"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center mt-4">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Grade</span>
                        <div style="position: relative; height: 150px; width: 150px;">
                            <canvas id="donutGrade"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center mt-4">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">RAT</span>
                        <div style="position: relative; height: 150px; width: 150px;">
                            <canvas id="donutRAT"></canvas>
                        </div>
                    </div>

                    <div class="text-center d-flex flex-column align-items-center mt-4">
                        <span class="fw-bold text-secondary mb-3" style="font-size: 0.9rem;">Modal Usaha (dalam Miliar)</span>
                        <div style="position: relative; height: 150px; width: 150px;">
                            <canvas id="donutModal"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3 d-flex flex-column justify-content-between gap-3">
            
            <div class="d-flex flex-column gap-2 flex-grow-1 mb-2">
                <div class="card border-0 p-2 text-center" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted" style="font-size: 0.75rem;">Anggota</small>
                    <div class="fw-bold text-dark" style="font-size: 1rem;">{{ number_format($totalAnggota) }}</div>
                </div>
                <div class="card border-0 p-2 text-center" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted" style="font-size: 0.75rem;">Karyawan</small>
                    <div class="fw-bold text-dark" style="font-size: 1rem;">{{ number_format($totalKaryawan) }}</div>
                </div>
                <div class="card border-0 p-2 text-center" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted" style="font-size: 0.75rem;">Manajer</small>
                    <div class="fw-bold text-dark" style="font-size: 1rem;">{{ number_format($totalManajer) }}</div>
                </div>
            </div>

            <div class="d-flex flex-column gap-2 flex-grow-1">
                <div class="card border-0 p-2 text-center" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted" style="font-size: 0.75rem;">Aset</small>
                    <div class="fw-bold text-dark" style="font-size: 1rem;">{{ number_format($totalAset) }} Miliar</div>
                </div>
                <div class="card border-0 p-2 text-center" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted" style="font-size: 0.75rem;">Volume Usaha</small>
                    <div class="fw-bold text-dark" style="font-size: 1rem;">{{ number_format($totalVolume) }} Miliar</div>
                </div>
                <div class="card border-0 p-2 text-center" style="background-color: #f1f5f9; border-radius: 6px;">
                    <small class="text-muted" style="font-size: 0.75rem;">Sisa Hasil Usaha</small>
                    <div class="fw-bold text-dark" style="font-size: 1rem;">{{ number_format($totalSHU) }} Miliar</div>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%', 
            plugins: {
                legend: { display: false }
            }
        };

        // 1. Donut Anggota (Dinamis)
        new Chart(document.getElementById('donutAnggota'), {
            type: 'doughnut',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    // Mengambil data hitungan pria & wanita hasil query laravel
                    data: [{{ $anggotaPria }}, {{ $anggotaWanita }}],
                    backgroundColor: ['#2563eb', '#dc2626'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 2. Donut Karyawan (Dinamis)
        new Chart(document.getElementById('donutKaryawan'), {
            type: 'doughnut',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $karyawanPria }}, {{ $karyawanWanita }}],
                    backgroundColor: ['#f97316', '#2563eb'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 3. Donut Manajer (Dinamis)
        new Chart(document.getElementById('donutManajer'), {
            type: 'doughnut',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $manajerPria }}, {{ $manajerWanita }}],
                    backgroundColor: ['#16a34a', '#f97316'],
                    borderWidth: 0 
                }]
            },
            options: baseOptions
        });

        // 4. Donut Grade (Dinamis membaca Array Object)
        new Chart(document.getElementById('donutGrade'), {
            type: 'doughnut',
            data: {
                labels: ['Grade A', 'Grade B', 'Grade C', 'Non Grade'],
                datasets: [{
                    // Mengubah array PHP menjadi format array Javascript otomatis
                    data: {!! json_encode(array_values($gradeData)) !!},
                    backgroundColor: ['#dc2626', '#ea580c', '#eab308', '#7c3aed'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 5. Donut RAT (Dinamis)
        new Chart(document.getElementById('donutRAT'), {
            type: 'doughnut',
            data: {
                labels: ['Sudah RAT', 'Belum RAT'],
                datasets: [{
                    data: [{{ $sudahRAT }}, {{ $belumRAT }}],
                    backgroundColor: ['#16a34a', '#eab308'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 6. Donut Modal Usaha (Statis / Dinamis jika ada fieldnya)
        new Chart(document.getElementById('donutModal'), {
            type: 'doughnut',
            data: {
                labels: ['Modal Sendiri', 'Modal Luar'],
                datasets: [{
                    data: [927.54, 2038.94], // Sesuaikan variabel jika field modal tersedia
                    backgroundColor: ['#0284c7', '#dc2626'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });
    });
</script>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // Konfigurasi standar untuk seluruh Ring/Donut Chart
        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%', // Membuat chart berbentuk cincin tipis (donut)
            plugins: {
                legend: { display: false }
            }
        };

        // 1. Donut Anggota
        new Chart(document.getElementById('donutAnggota'), {
            type: 'doughnut',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [64998, 358332],
                    backgroundColor: ['#2563eb', '#dc2626'],
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
                    data: [1337, 610],
                    backgroundColor: ['#f97316', '#2563eb'],
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
                    data:[164, 41],
                    backgroundColor: ['#16a34a', '#f97316'],
                    borderWidth: 0 }]
                
            },
            options: baseOptions
        });

        // 4. Donut Grade
        new Chart(document.getElementById('donutGrade'), {
            type: 'doughnut',
            data: {
                labels: ['Grade A', 'Grade B', 'Grade C1', 'Grade C2', 'Non Grade'],
                datasets: [{
                    data: [0, 43, 1, 35, 869],
                    backgroundColor: ['#dc2626', '#ea580c', '#eab308', '#0d9488', '#7c3aed'],
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
                    data: [126, 818],
                    backgroundColor: ['#16a34a', '#eab308'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });

        // 6. Donut Modal Usaha
        new Chart(document.getElementById('donutModal'), {
            type: 'doughnut',
            data: {
                labels: ['Modal Sendiri', 'Modal Luar'],
                datasets: [{
                    data: [927.54, 2038.94],
                    backgroundColor: ['#0284c7', '#dc2626'],
                    borderWidth: 0
                }]
            },
            options: baseOptions
        });
    });

</script> -->
@endsection