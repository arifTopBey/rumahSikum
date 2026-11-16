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

    <div id="gradeTableContainer" class="card border-0 p-4 mt-4 shadow-sm d-none" style="border-radius: 12px; background: white;">
       <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0 text-dark"><span id="selectedGradeTitle">-</span></h5>
        
        <div class="d-flex gap-2">
            <form action="{{ route('koperasi.exportExcelGrade') }}" method="POST" id="formExportGrade">
                @csrf
                <input type="hidden" name="grade" id="exportGradeCode">
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </button>
            </form>

            <button class="btn btn-sm btn-secondary" onclick="document.getElementById('gradeTableContainer').classList.add('d-none')">Tutup Tabel</button>
        </div>
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
                <tbody id="gradeTableBody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        


        // function loadGradeDetail(gradeCode) {
        //     const container = document.getElementById('gradeTableContainer');
        //     const tableBody = document.getElementById('gradeTableBody');
        //     const titleSpan = document.getElementById('selectedGradeTitle');

        //     // Munculkan kontainer loader awal
        //     container.classList.remove('d-none');
        //     tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary"></div> Memuat data koperasi...</td></tr>';
            
        //     // Lakukan scroll halus ke arah tabel
        //     container.scrollIntoView({ behavior: 'smooth' });

        //     // Request ke Controller Laravel
        //     fetch("{{ route('koperasi.getGradeDetail') }}", {
        //         method: "POST",
        //         headers: {
        //             "Content-Type": "application/json",
        //             "X-CSRF-TOKEN": "{{ csrf_token() }}"
        //         },
        //         body: JSON.stringify({ grade: gradeCode })
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         tableBody.innerHTML = data.html;
        //         titleSpan.innerText = data.title;
        //     })
        //     .catch(error => {
        //         console.error("Error:", error);
        //         tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat data detail grade.</td></tr>';
        //     });
        // }

        function loadGradeDetail(gradeCode) {
    const container = document.getElementById('gradeTableContainer');
    const tableBody = document.getElementById('gradeTableBody');
    const titleSpan = document.getElementById('selectedGradeTitle');

    // SALIN PARAMETER KODE GRADE KE DALAM INPUT ELEMEN FORM EXPORT
    document.getElementById('exportGradeCode').value = gradeCode;

    // Munculkan kontainer loader awal
    container.classList.remove('d-none');
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary"></div> Memuat data koperasi...</td></tr>';
    
    // Lakukan scroll halus ke arah tabel
    container.scrollIntoView({ behavior: 'smooth' });

    // Request ke Controller Laravel
    fetch("{{ route('koperasi.getGradeDetail') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ grade: gradeCode })
    })
    .then(response => response.json())
    .then(data => {
        tableBody.innerHTML = data.html;
        titleSpan.innerText = data.title;
    })
    .catch(error => {
        console.error("Error:", error);
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat data detail grade.</td></tr>';
    });
}


        // Buat mapping data dinamis dari Controller
        const labelsData = ['Grade A', 'Grade B', 'Grade C1', 'Grade C2', 'Grade C3'];
        const valuesData = [{{ $pctA }}, {{ $pctB }}, {{ $pctC1 }}, {{ $pctC2 }}, {{ $pctC3 }}];
        const colorsData = ['#10b981', '#7091c4', '#4b9e24', '#7a587a', '#2d4b82'];

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
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const rawLabel = chart.data.labels[dataIndex]; // Ambil nama label (misal: 'Grade B')
                        
                        // Ambil kode grade murni dengan menghapus kata 'Grade ' (misal menjadi 'B' atau 'C1')
                        const gradeCode = rawLabel.replace('Grade ', '').trim();
                        
                        loadGradeDetail(gradeCode);
                    }
                },
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