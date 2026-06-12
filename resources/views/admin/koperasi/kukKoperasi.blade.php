@extends('admin.main.main')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">

    <div class="row g-3 mt-1">
        <div class="col-lg-4">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #2b3a61;">KUK</h6>

                <div class="mx-auto mb-4" style="position: relative; height: 220px; width: 220px;">
                    <canvas id="chartKUK"></canvas>
                </div>

                <div class="mt-auto d-flex flex-column gap-1" style="font-size: 0.75rem; border-radius: 8px; overflow: hidden;">
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #b91c1c;">
                        <span>KUK 1</span><span class="fw-bold">{{ $kuk1 }} ({{ $pctKuk1 }}%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #ea580c;">
                        <span>KUK 2</span><span class="fw-bold">{{ $kuk2 }} ({{ $pctKuk2 }}%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #84cc16;">
                        <span>KUK 3</span><span class="fw-bold">{{ $kuk3 }} ({{ $pctKuk3 }}%)</span>
                    </div>
                    @if($kuk4 > 0)
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #2563eb;">
                        <span>KUK 4</span><span class="fw-bold">{{ $kuk4 }} ({{ $pctKuk4 }}%)</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #2b3a61;">Keterangan KUK</h6>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 0.75rem; border-color: #f1f5f9;">
                        <thead class="table-light text-secondary" style="font-size: 0.8rem;">
                            <tr>
                                <th style="width: 8%;" class="text-center">KUK</th>
                                <th style="width: 92%;">Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center fw-bold text-secondary">1</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    <strong class="text-dark">Sektor Riil:</strong> Jumlah Anggota kurang dari 5.000 atau Modal Sendiri kurang dari Rp250.000.000 atau Jumlah Aset kurang dari Rp2.500.000.000.<br>
                                    <strong class="text-dark">Simpan Pinjam:</strong> Jumlah Anggota kurang dari 5.000 atau Modal Sendiri kurang dari Rp2.500.000.000 atau Jumlah Aset kurang dari Rp15.000.000.000.
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold text-secondary">2</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    <strong class="text-dark">Sektor Riil:</strong> Jumlah Anggota 5.000 - 9.000 atau Modal Sendiri Rp250.000.000 - Rp15.000.000.000 atau Jumlah Aset Rp2.500.000.000 - Rp100.000.000.000.<br>
                                    <strong class="text-dark">Simpan Pinjam:</strong> Jumlah Anggota 5.000 - 10.000 atau Modal Sendiri Rp2.500.000.000 - Rp15.000.000.000 atau Jumlah Aset Rp15.000.000.000 - Rp100.000.000.000.
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold text-secondary">3</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    <strong class="text-dark">Sektor Riil:</strong> Jumlah Anggota 9.000 - 35.000 atau Modal Sendiri Rp15.000.000.000 - Rp40.000.000.000 atau Jumlah Aset Rp100.000.000.000 - Rp500.000.000.000.<br>
                                    <strong class="text-dark">Simpan Pinjam:</strong> Jumlah Anggota 10.000 - 30.000 atau Modal Sendiri Rp15.000.000.000 - Rp50.000.000.000 atau Jumlah Aset Rp100.000.000.000 - Rp500.000.000.000.
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold text-secondary">4</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    <strong class="text-dark">Sektor Riil:</strong> Jumlah Anggota lebih dari 35.000 atau Modal Sendiri lebih dari Rp40.000.000.000 atau Jumlah Aset lebih dari Rp500.000.000.000.<br>
                                    <strong class="text-dark">Simpan Pinjam:</strong> Jumlah Anggota lebih dari 30.000 atau Modal Sendiri lebih dari Rp50.000.000.000 atau Jumlah Aset lebih dari Rp500.000.000.000.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Ambil data persentase dari Laravel Controller
       const dataKuk = [{{ $pctKuk1 }}, {{ $pctKuk2 }}, {{ $pctKuk3 }}, {{ $pctKuk4 }}];

        new Chart(document.getElementById('chartKUK'), {
            type: 'pie',
            data: {
                labels: ['KUK 1', 'KUK 2', 'KUK 3', 'KUK 4'],
                datasets: [{
                    data: dataKuk,
                    backgroundColor: ['#b91c1c', '#ea580c', '#84cc16', '#2563eb'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

    });
</script>

<!-- <script>
    
    document.addEventListener("DOMContentLoaded", function() {
        
        // 6. Chart KUK (Klasifikasi Usaha Koperasi)
        new Chart(document.getElementById('chartKUK'), {
            type: 'pie',
            data: {
                labels: ['KUK 1', 'KUK 2', 'KUK 3'],
                datasets: [{
                    data: [85.67, 14.17, 0.16],
                    backgroundColor: ['#b91c1c', '#ea580c', '#84cc16'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });
        
    });
</script> -->
@endsection