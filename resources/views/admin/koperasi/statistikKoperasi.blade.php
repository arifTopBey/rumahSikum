@extends('admin.main.main')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #2b3a61;">Statistik Koperasi</h4>
            <small class="text-muted">Status Data : {{ $tanggalData }}</small>
        </div>
        <button class="btn btn-outline-secondary btn-sm px-3 d-flex align-items-center gap-2" style="border-radius: 8px;">
            <i class="bi bi-funnel"></i> Filter
        </button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-4 col-md-5 d-flex flex-column gap-3">
            <div class="card border-0 text-white text-center p-3" style="background-color: #3b82f6; border-radius: 12px; min-height: 110px;">
                <div class="fw-semibold" style="font-size: 0.95rem;">Koperasi Aktif</div>
                <div class="display-6 fw-bold my-auto">{{ number_format($koperasiAktif) }}</div>
            </div>
            <div class="card border-0 text-white text-center p-3" style="background-color: #c2410c; border-radius: 12px; min-height: 110px;">
                <div class="fw-semibold" style="font-size: 0.95rem;">Belum Bersertifikat NIK</div>
                <div class="display-6 fw-bold mt-1 mb-0">{{ number_format($belumSertifikat) }}</div>
                <small style="font-size: 0.75rem; opacity: 0.9;">{{ $pctBelumSertifikat }}% dari {{ number_format($koperasiAktif) }} Koperasi Aktif</small>
            </div>
        </div>

        <div class="col-lg-8 col-md-7">
            <div class="card border-0 text-white h-100 overflow-hidden" style="background-color: #16a34a; border-radius: 12px;">
                <div class="text-center p-3 border-bottom border-white border-opacity-20" style="min-height: 110px;">
                    <div class="fw-semibold" style="font-size: 0.95rem;">Bersertifikat NIK</div>
                    <div class="display-6 fw-bold mt-1 mb-0">{{ number_format($sudahSertifikat) }}</div>
                    <small style="font-size: 0.75rem; opacity: 0.9;">{{ $pctSudahSertifikat }}% dari {{ number_format($koperasiAktif) }} Koperasi Aktif</small>
                </div>
                <div class="row g-0 flex-grow-1 text-center">
                    <div class="col-6 p-3 border-end border-white border-opacity-20">
                        <div class="fw-semibold" style="font-size: 0.85rem;">Sertifikat NIK Aktif</div>
                        <div class="h3 fw-bold my-1">{{ number_format($sertifikatAktif) }}</div>
                        <div style="font-size: 0.7rem; opacity: 0.9;">{{ $pctSertifikatAktif }}% dari {{ number_format($sudahSertifikat) }} Koperasi Bersertifikat</div>
                    </div>
                    <div class="col-6 p-3">
                        <div class="fw-semibold" style="font-size: 0.85rem;">Sertifikat NIK Expired</div>
                        <div class="h3 fw-bold my-1">{{ number_format($sertifikatExpired) }}</div>
                        <div style="font-size: 0.7rem; opacity: 0.9;">{{ $pctSertifikatExpired }}% dari {{ number_format($sudahSertifikat) }} Koperasi Bersertifikat</div>
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
                        <span>Pria</span><span class="fw-bold">{{ number_format($anggotaPria) }} (37.60%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #b91c1c;">
                        <span>Wanita</span><span class="fw-bold">{{ number_format($anggotaWanita) }} (62.40%)</span>
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
                        <span>Pria</span><span class="fw-bold">{{ number_format($karyawanPria) }} (71.03%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #4f46e5;">
                        <span>Wanita</span><span class="fw-bold">{{ number_format($karyawanWanita) }} (28.97%)</span>
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
                        <span>Pria</span><span class="fw-bold">{{ number_format($manajerPria) }} (77.78%)</span>
                    </div>
                    <div class="d-flex justify-content-between text-white p-2" style="background-color: #60a5fa;">
                        <span>Wanita</span><span class="fw-bold">{{ number_format($manajerWanita) }} (22.22%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 d-flex flex-column gap-3 justify-content-between">
            <div class="card border-0 p-3 text-center d-flex flex-column justify-content-center flex-grow-1" style="border-radius: 12px; background: white; min-height: 90px;">
                <small class="text-muted fw-semibold">Anggota</small>
                <h4 class="fw-bold m-0 mt-1" style="color: #1e293b;">{{ number_format($totalAnggota) }}</h4>
            </div>
            <div class="card border-0 p-3 text-center d-flex flex-column justify-content-center flex-grow-1" style="border-radius: 12px; background: white; min-height: 90px;">
                <small class="text-muted fw-semibold">Karyawan</small>
                <h4 class="fw-bold m-0 mt-1" style="color: #1e293b;">{{ number_format($totalKaryawan) }}</h4>
            </div>
            <div class="card border-0 p-3 text-center d-flex flex-column justify-content-center flex-grow-1" style="border-radius: 12px; background: white; min-height: 90px;">
                <small class="text-muted fw-semibold">Manajer</small>
                <h4 class="fw-bold m-0 mt-1" style="color: #1e293b;">{{ number_format($totalManajer) }}</h4>
            </div>
        </div>
    </div>

    <div id="demografiTableContainer" class="card border-0 p-4 mt-4 shadow-sm d-none" style="border-radius: 12px; background: white;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold m-0 text-dark"><span id="selectedDemografiTitle">-</span></h5>
            <button class="btn btn-sm btn-secondary" onclick="document.getElementById('demografiTableContainer').classList.add('d-none')">Tutup Tabel</button>
        </div>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 0.85rem;">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th class="text-center" style="width: 5px;">No</th>
                        <th>NIK</th>
                        <th>Nama Koperasi</th>
                        <th>Wilayah / Alamat</th>
                        <th class="text-center">Jumlah Kontribusi</th>
                        <th class="text-center">Status</th>
                         <th class="text-center">Detail</th>

                    </tr>
                </thead>
                <tbody id="demografiTableBody">
                    </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function loadDemografiDetail(type, gender) {
            const container = document.getElementById('demografiTableContainer');
            const tableBody = document.getElementById('demografiTableBody');
            const titleSpan = document.getElementById('selectedDemografiTitle');

            container.classList.remove('d-none');
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary"></div> Memuat data koperasi...</td></tr>';
            titleSpan.innerText = "Daftar Koperasi: " + type + " " + gender;

            container.scrollIntoView({ behavior: 'smooth' });

            fetch("{{ route('koperasi.getDemografiDetail') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ type: type, gender: gender })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                tableBody.innerHTML = data.html;
                titleSpan.innerText = data.title;
            })
            .catch(error => {
                console.error("Error:", error);
                tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Gagal memuat data detail.</td></tr>';
            });
        }



        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        };

        // 1. Chart Anggota Dinamis
        new Chart(document.getElementById('chartAnggota'), {
            type: 'pie',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $anggotaPria }}, {{ $anggotaWanita }}],
                    backgroundColor: ['#3b82f6', '#b91c1c'],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const gender = chart.data.labels[dataIndex]; // 'Pria' atau 'Wanita'
                        loadDemografiDetail('Anggota', gender);
                    }
                }
            }
        });

        // 2. Chart Karyawan Dinamis
        new Chart(document.getElementById('chartKaryawan'), {
            type: 'pie',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $karyawanPria }}, {{ $karyawanWanita }}],
                    backgroundColor: ['#ea580c', '#4f46e5'],
                    borderWidth: 1
                }]
            },
            options: {
                 ...chartOptions,
                 onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const gender = chart.data.labels[dataIndex];
                        loadDemografiDetail('Karyawan', gender);
                    }
                }
            }
        });

        // 3. Chart Manajer Dinamis
        new Chart(document.getElementById('chartManajer'), {
            type: 'pie',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [{{ $manajerPria }}, {{ $manajerWanita }}],
                    backgroundColor: ['#16a34a', '#60a5fa'],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                onClick: (e, activeEls, chart) => {
                    if (activeEls.length > 0) {
                        const dataIndex = activeEls[0].index;
                        const gender = chart.data.labels[dataIndex];
                        loadDemografiDetail('Manajer', gender);
                    }
                }
            }
        });
    });
</script>
@endsection