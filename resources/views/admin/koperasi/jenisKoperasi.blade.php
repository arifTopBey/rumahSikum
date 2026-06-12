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
                    <span>Produsen</span><span class="fw-bold">{{ number_format($jenisData['Produsen']) }} ({{ $jenisPersen['Produsen'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c;">
                    <span>Pemasaran</span><span class="fw-bold">{{ number_format($jenisData['Pemasaran']) }} ({{ $jenisPersen['Pemasaran'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #84cc16;">
                    <span>Konsumen</span><span class="fw-bold">{{ number_format($jenisData['Konsumen']) }} ({{ $jenisPersen['Konsumen'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #60a5fa;">
                    <span>Jasa</span><span class="fw-bold">{{ number_format($jenisData['Jasa']) }} ({{ $jenisPersen['Jasa'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #16a34a;">
                    <span>Simpan Pinjam</span><span class="fw-bold">{{ number_format($jenisData['Simpan Pinjam']) }} ({{ $jenisPersen['Simpan Pinjam'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #a855f7;">
                    <span>Kelurahan Merah Putih</span><span class="fw-bold">{{ number_format($jenisData['Kelurahan Merah Putih']) }} ({{ $jenisPersen['Kelurahan Merah Putih'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #1e3a8a;">
                    <span>Desa Merah Putih</span><span class="fw-bold">{{ number_format($jenisData['Desa Merah Putih']) }} ({{ $jenisPersen['Desa Merah Putih'] }}%)</span>
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
                    <span>Primer Kabupaten/Kota</span><span class="fw-bold">{{ number_format($bentukData['primer_kab']) }} ({{ $bentukPersen['primer_kab'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c;">
                    <span>Primer Provinsi</span><span class="fw-bold">{{ number_format($bentukData['primer_prov']) }} ({{ $bentukPersen['primer_prov'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #84cc16;">
                    <span>Primer Nasional</span><span class="fw-bold">{{ number_format($bentukData['primer_nas']) }} ({{ $bentukPersen['primer_nas'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #b91c1c; opacity: 0.85;">
                    <span>Sekunder Kabupaten/Kota</span><span class="fw-bold">{{ number_format($bentukData['sekunder_kab']) }} ({{ $bentukPersen['sekunder_kab'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c; opacity: 0.85;">
                    <span>Sekunder Provinsi</span><span class="fw-bold">{{ number_format($bentukData['sekunder_prov']) }} ({{ $bentukPersen['sekunder_prov'] }}%)</span>
                </div>
                <div class="d-flex justify-content-between text-white p-2" style="background-color: #84cc16; opacity: 0.85;">
                    <span>Sekunder Nasional</span><span class="fw-bold">{{ number_format($bentukData['sekunder_nas']) }} ({{ $bentukPersen['sekunder_nas'] }}%)</span>
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

        // 4. Chart Jenis Koperasi Dinamis (Pie Chart)
        new Chart(document.getElementById('chartJenisKoperasi'), {
            type: 'pie',
            data: {
                labels: ['Produsen', 'Pemasaran', 'Konsumen', 'Jasa', 'Simpan Pinjam', 'Kelurahan Merah Putih', 'Desa Merah Putih'],
                datasets: [{
                    data: [
                        {{ $jenisData['Produsen'] }}, 
                        {{ $jenisData['Pemasaran'] }}, 
                        {{ $jenisData['Konsumen'] }}, 
                        {{ $jenisData['Jasa'] }}, 
                        {{ $jenisData['Simpan Pinjam'] }}, 
                        {{ $jenisData['Kelurahan Merah Putih'] }}, 
                        {{ $jenisData['Desa Merah Putih'] }}
                    ],
                    backgroundColor: ['#b91c1c', '#ea580c', '#84cc16', '#60a5fa', '#16a34a', '#a855f7', '#1e3a8a'],
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        // Tentukan batas atas grafik balok otomatis (maksimum data + padding space)
        const maxVal = Math.max({{ $bentukData['primer_kab'] }}, {{ $bentukData['sekunder_kab'] }}, 100);
        const yMaxAxis = Math.ceil(maxVal / 100) * 100 + 100;

        // 5. Chart Bentuk Koperasi Dinamis (Grouped Bar Chart)
        new Chart(document.getElementById('chartBentukKoperasi'), {
            type: 'bar',
            data: {
                labels: ['Kabupaten/Kota', 'Provinsi', 'Nasional'],
                datasets: [
                    {
                        label: 'Primer',
                        data: [{{ $bentukData['primer_kab'] }}, {{ $bentukData['primer_prov'] }}, {{ $bentukData['primer_nas'] }}],
                        backgroundColor: '#b91c1c',
                        borderRadius: 4
                    },
                    {
                        label: 'Sekunder',
                        data: [{{ $bentukData['sekunder_kab'] }}, {{ $bentukData['sekunder_prov'] }}, {{ $bentukData['sekunder_nas'] }}],
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
                        max: yMaxAxis,
                        grid: {
                            color: '#f1f5f9'
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
    });
</script>
@endsection