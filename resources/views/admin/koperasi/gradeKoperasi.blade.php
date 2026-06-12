@extends('admin.main.main')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">

    <div class="row g-3 mt-1">
        <div class="col-lg-4">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #2b3a61;">Grade</h6>

                <div class="mx-auto mb-4" style="position: relative; height: 220px; width: 220px;">
                    <canvas id="chartGrade"></canvas>
                </div>

                <div class="mt-auto d-flex flex-column gap-1" style="font-size: 0.75rem; border-radius: 8px; overflow: hidden;">
                    @if($gradeA > 0)
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #10b981;">
                        <span>Grade A</span><span class="fw-bold">{{ $gradeA }} ({{ $pctA }}%)</span>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #7091c4;">
                        <span>Grade B</span><span class="fw-bold">{{ $gradeB }} ({{ $pctB }}%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #4b9e24;">
                        <span>Grade C1</span><span class="fw-bold">{{ $gradeC1 }} ({{ $pctC1 }}%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #7a587a;">
                        <span>Grade C2</span><span class="fw-bold">{{ $gradeC2 }} ({{ $pctC2 }}%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #2d4b82;">
                        <span>Grade C3</span><span class="fw-bold">{{ $gradeC3 }} ({{ $pctC3 }}%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 p-3 h-100" style="border-radius: 12px; background: white;">
                <h6 class="fw-bold mb-3" style="color: #2b3a61;">Keterangan Grade</h6>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 0.75rem; border-color: #f1f5f9;">
                        <thead class="table-light text-secondary" style="font-size: 0.8rem;">
                            <tr>
                                <th style="width: 10%;" class="text-center">Grade</th>
                                <th style="width: 90%;">Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center fw-bold text-secondary">A</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    Koperasi bersertifikat dan melaporkan hasil RAT 3 Tahun Buku Terakhir berturut-turut.
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold text-secondary">B</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    Koperasi bersertifikat dan melaporkan hasil RAT minimal 2 kali Tahun Buku dalam 3 Tahun Terakhir.
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold text-secondary">C1</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    Koperasi bersertifikat yang baru berdiri dalam 3 Tahun terakhir dan melaporkan hasil RAT minimal 1 kali Tahun Buku dalam 3 Tahun Terakhir.
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold text-secondary">C2</td>
                                <td class="text-muted" style="line-height: 1.6;">
                                    Koperasi bersertifikat yang berdiri lebih dari 3 Tahun dan melaporkan hasil RAT minimal 1 kali Tahun Buku dalam 3 Tahun Terakhir.
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
        
        // Buat mapping data dinamis dari Controller
        const labelsData = ['Grade A', 'Grade B', 'Grade C1', 'Grade C2', 'Grade C3'];
        const valuesData = [{{ $pctA }}, {{ $pctB }}, {{ $pctC1 }}, {{ $pctC2 }}, {{ $pctC3 }}];
        const colorsData = ['#10b981', '#7091c4', '#4b9e24', '#7a587a', '#2d4b82'];

        // Filter data: Jika nilai persentase 0, hilangkan dari chart agar legenda/potongan tidak menumpuk
        const filteredLabels = [];
        const filteredValues = [];
        const filteredColors = [];

        valuesData.forEach((val, index) => {
            if (val > 0) {
                filteredLabels.push(labelsData[index]);
                filteredValues.push(val);
                filteredColors.push(colorsData[index]);
            }
        });
        
        // Inisialisasi Pie Chart Grade
        new Chart(document.getElementById('chartGrade'), {
            type: 'pie',
            data: {
                labels: filteredLabels,
                datasets: [{
                    data: filteredValues,
                    backgroundColor: filteredColors,
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
</script>


<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {

        // 7. Chart Grade
        new Chart(document.getElementById('chartGrade'), {
            type: 'pie',
            data: {
                labels: ['Grade B', 'Grade C1', 'Grade C2', 'Grade C3'],
                datasets: [{
                    data: [13.08, 0.77, 19.23, 66.92],
                    backgroundColor: ['#7091c4', '#4b9e24', '#7a587a', '#2d4b82'],
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
</script> -->
@endsection