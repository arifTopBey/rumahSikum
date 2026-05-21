
@extends('admin.main.main')

@section('content')
<div class="row g-3 mt-1">
        <div class="col-lg-4">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #2b3a61;">Jenis Koperasi</h6>
                
                <div class="mx-auto mb-3" style="position: relative; height: 220px; width: 220px;">
                    <canvas id="chartJenisKoperasi"></canvas>
                </div>

                <div class="mt-auto d-flex flex-column gap-1" style="font-size: 0.75rem; border-radius: 8px; overflow: hidden;">
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #b91c1c;">
                        <span>Produsen</span><span class="fw-bold">26 (4.14%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c;">
                        <span>Pemasaran</span><span class="fw-bold">6 (0.96%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #84cc16;">
                        <span>Konsumen</span><span class="fw-bold">239 (38.06%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #60a5fa;">
                        <span>Jasa</span><span class="fw-bold">10 (1.59%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #16a34a;">
                        <span>Simpan Pinjam</span><span class="fw-bold">72 (11.46%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #a855f7;">
                        <span>Kelurahan Merah Putih</span><span class="fw-bold">28 (4.46%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #1e3a8a;">
                        <span>Desa Merah Putih</span><span class="fw-bold">247 (39.33%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #2b3a61;">Bentuk Koperasi</h6>
                
                <div class="mb-4" style="position: relative; height: 240px; width: 100%;">
                    <canvas id="chartBentukKoperasi"></canvas>
                </div>

                <div class="d-flex flex-column gap-1" style="font-size: 0.75rem; border-radius: 8px; overflow: hidden;">
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #b91c1c;">
                        <span>Primer Kabupaten/Kota</span><span class="fw-bold">626 (99.68%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c;">
                        <span>Primer Provinsi</span><span class="fw-bold">0 (0.00%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #84cc16;">
                        <span>Primer Nasional</span><span class="fw-bold">0 (0.00%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #b91c1c; opacity: 0.85;">
                        <span>Sekunder Kabupaten/Kota</span><span class="fw-bold">2 (0.32%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c; opacity: 0.85;">
                        <span>Sekunder Provinsi</span><span class="fw-bold">0 (0.00%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #84cc16; opacity: 0.85;">
                        <span>Sekunder Nasional</span><span class="fw-bold">0 (0.00%)</span>
                    </div>
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

        // 4. Chart Jenis Koperasi (Pie Chart)
        new Chart(document.getElementById('chartJenisKoperasi'), {
            type: 'pie',
            data: {
                labels: ['Produsen', 'Pemasaran', 'Konsumen', 'Jasa', 'Simpan Pinjam', 'Kelurahan Merah Putih', 'Desa Merah Putih'],
                datasets: [{
                    data: [4.14, 0.96, 38.06, 1.59, 11.46, 4.46, 39.33],
                    backgroundColor: ['#b91c1c', '#ea580c', '#84cc16', '#60a5fa', '#16a34a', '#a855f7', '#1e3a8a'],
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        // 5. Chart Bentuk Koperasi (Grouped Bar Chart)
        new Chart(document.getElementById('chartBentukKoperasi'), {
            type: 'bar',
            data: {
                labels: ['Kabupaten/Kota', 'Provinsi', 'Nasional'],
                datasets: [
                    {
                        label: 'Primer',
                        data: [626, 0, 0],
                        backgroundColor: '#b91c1c',
                        borderRadius: 4
                    },
                    {
                        label: 'Sekunder',
                        data: [2, 0, 0],
                        backgroundColor: '#ea580c',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 12,
                            font: { size: 11 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 800,
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            stepSize: 200
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }) 
</script>
@endsection