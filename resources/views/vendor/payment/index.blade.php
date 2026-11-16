@extends('admin.main.main')

@section('content')
<div class="container pb-5" style="margin-top: 80px;">

    <!-- HEADER PAGE -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h4 class="fw-800 text-dark mb-1 d-flex align-items-center gap-2">
                <i data-lucide="wallet" class="text-primary" size="28"></i> Kelola Metode Pembayaran
            </h4>
            <p class="text-muted small mb-0">Daftar rekening bank dan QRIS aktif yang akan digunakan pembeli untuk melakukan pembayaran.</p>
        </div>
        <div class="d-flex gap-2">
            <!-- Modal Trigger Buttons -->
            <button type="button" class="btn btn-outline-primary rounded-3 fw-bold small d-flex align-items-center gap-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddBank">
                <i data-lucide="plus-circle" size="16"></i> Tambah Bank
            </button>
            <button type="button" class="btn btn-primary rounded-3 fw-bold small d-flex align-items-center gap-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddQris">
                <i data-lucide="qr-code" size="16"></i> Tambah QRIS
            </button>
        </div>
    </div>

    <!-- NOTIFIKASI SUCCESS/ERROR -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
            <i data-lucide="check-circle" size="18" class="me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

      @if ($errors->any())
        <div class="alert alert-danger mt-4 rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>  
    @endif

    <div class="row g-4">
        
        <!-- SECTION 1: METODE TRANSFER BANK -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                    <h6 class="fw-800 text-dark mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="landmark" class="text-primary" size="20"></i> Rekening Transfer Bank
                    </h6>
                    <span class="badge bg-light text-muted fw-bold rounded-pill border px-3 py-2 smaller">
                        {{ $bankPayments->count() }} Rekening Terdaftar
                    </span>
                </div>

                @if($bankPayments->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i data-lucide="credit-card" size="40" class="opacity-50 mb-2"></i>
                        <p class="small mb-2">Belum ada rekening bank yang ditambahkan.</p>
                        <button class="btn btn-sm btn-link text-primary fw-bold p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalAddBank">
                            + Tambah Rekening Sekarang
                        </button>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach($bankPayments as $bank)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border rounded-3 p-3 position-relative {{ $bank->is_active ? 'bg-white border-primary' : 'bg-light opacity-75' }}">
                                    
                                    <!-- BADGE ACTIVE / INACTIVE -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            @if($bank->logo_bank)
                                                <img src="{{ route('show.thumbnail.produk.private', $bank->logo_bank) }}" alt="{{ $bank->nama_bank }}" class="img-fluid" style="max-height: 24px; object-fit: contain;">
                                                <!-- <img src="{{ asset('storage/' . $bank->logo_bank) }}" alt="{{ $bank->nama_bank }}" class="img-fluid" style="max-height: 24px; object-fit: contain;"> -->
                                            @else
                                                <span class="badge bg-primary text-white fw-bold px-2 py-1 rounded-2 smaller">{{ $bank->nama_bank }}</span>
                                            @endif
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="switchBank{{ $bank->id }}" 
                                                   {{ $bank->is_active ? 'checked' : '' }} 
                                                   onchange="togglePaymentStatus({{ $bank->id }})">
                                        </div>
                                    </div>

                                    <!-- DETAIL REKENING -->
                                    <div class="mb-3">
                                        <span class="smaller text-muted d-block">Nomor Rekening:</span>
                                        <span class="fw-800 text-dark fs-6 font-monospace">{{ $bank->nomor_rekening }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="smaller text-muted d-block">Atas Nama (Pemilik):</span>
                                        <span class="fw-bold text-dark small">{{ $bank->nama_pemilik }}</span>
                                    </div>

                                    <!-- ACTION BUTTONS -->
                                    <div class="d-flex justify-content-end gap-2 border-top pt-2 mt-auto">
                                        <!-- <button class="btn btn-sm btn-light text-dark rounded-2 fw-bold" 
                                                onclick="editBank({{ json_encode($bank) }})" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEditBank">
                                            <i data-lucide="edit-3" size="14"></i> Edit
                                        </button> -->
                                        <form id="delete-form-{{ $bank->id }}" action="{{ route('vendor.payment.destroy', $bank->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus rekening ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete('{{ $bank->id }}', '{{ $bank->nama_bank }}')"  type="button" class="btn btn-sm btn-light text-danger rounded-2 fw-bold">
                                                <i data-lucide="trash-2" size="14"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- SECTION 2: METODE QRIS -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                    <h6 class="fw-800 text-dark mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="qr-code" class="text-primary" size="20"></i> Pembayaran QRIS Toko
                    </h6>
                    <span class="badge bg-light text-muted fw-bold rounded-pill border px-3 py-2 smaller">
                        {{ $qrisPayments->count() }} QRIS Terdaftar
                    </span>
                </div>

                @if($qrisPayments->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i data-lucide="qr-code" size="40" class="opacity-50 mb-2"></i>
                        <p class="small mb-2">Belum ada gambar QRIS yang diunggah.</p>
                        <button class="btn btn-sm btn-link text-primary fw-bold p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalAddQris">
                            + Unggah QRIS Sekarang
                        </button>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach($qrisPayments as $qris)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border rounded-3 p-3 position-relative {{ $qris->is_active ? 'bg-white border-primary' : 'bg-light opacity-75' }}">
                                    
                                    <!-- BADGE ACTIVE / SWITCH -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-success text-white fw-bold px-2 py-1 rounded-2 smaller">QRIS Code</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="switchQris{{ $qris->id }}" 
                                                   {{ $qris->is_active ? 'checked' : '' }} 
                                                   onchange="togglePaymentStatus({{ $qris->id }})">
                                        </div>
                                    </div>

                                    <!-- DETAIL QRIS & TAMPILAN GAMBAR -->
                                    <div class="text-center mb-3">
                                        <img src="{{ route('show.thumbnail.produk.private', $qris->gambar_qris) }}" class="img-fluid rounded-3 border p-2 bg-white" style="max-height: 160px; object-fit: contain;">
                                        <!-- <img src="{{ asset('storage/' . $qris->gambar_qris) }}" alt="{{ $qris->nama_qris }}" class="img-fluid rounded-3 border p-2 bg-white" style="max-height: 160px; object-fit: contain;"> -->
                                        <h6 class="fw-bold text-dark mt-2 mb-0 small">{{ $qris->nama_qris }}</h6>
                                    </div>

                                    <!-- ACTION BUTTONS -->
                                    <div class="d-flex justify-content-end gap-2 border-top pt-2 mt-auto">
                                        <form id="delete-form-{{ $qris->id }}" action="{{ route('vendor.payment.destroy', $qris->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete('{{ $qris->id }}', '{{ $qris->nama_qris }}')" type="button" class="btn btn-sm btn-light text-danger rounded-2 fw-bold w-100">
                                                <i data-lucide="trash-2" size="14"></i> Hapus QRIS
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

</div>

<!-- MODAL TAMBAH BANK -->
<div class="modal fade" id="modalAddBank" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom pb-3">
                <h6 class="modal-title fw-800 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="landmark" class="text-primary" size="18"></i> Tambah Rekening Bank
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('vendor.payment.store-bank') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Bank</label>
                        <select name="nama_bank" class="form-select form-control-custom" required>
                            <option value="">-- Pilih Bank --</option>
                            <option value="BCA">Bank BCA</option>
                            <option value="Mandiri">Bank Mandiri</option>
                            <option value="BRI">Bank BRI</option>
                            <option value="BNI">Bank BNI</option>
                            <option value="BSI">Bank BSI</option>
                            <option value="CIMB">CIMB Niaga</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nomor Rekening</label>
                        <input type="text" name="nomor_rekening" class="form-control form-control-custom" placeholder="Contoh: 1234567890" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Pemilik Rekening</label>
                        <input type="text" name="nama_pemilik" class="form-control form-control-custom" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Logo Bank (Opsional)</label>
                        <input type="file" name="logo_bank" class="form-control form-control-custom" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer border-top pt-2">
                    <button type="button" class="btn btn-light rounded-3 fw-bold small" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 fw-bold small px-4">Simpan Bank</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH QRIS -->
<div class="modal fade" id="modalAddQris" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom pb-3">
                <h6 class="modal-title fw-800 text-dark d-flex align-items-center gap-2">
                    <i data-lucide="qr-code" class="text-primary" size="18"></i> Unggah Kode QRIS
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('vendor.payment.store-qris') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama / Merchant QRIS</label>
                        <input type="text" name="nama_qris" class="form-control form-control-custom" placeholder="Contoh: QRIS Toko Berkah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">File Gambar QRIS (JPG/PNG)</label>
                        <input type="file" name="gambar_qris" class="form-control form-control-custom" accept="image/png, image/jpeg" required>
                        <span class="smaller text-muted mt-1 d-block">Pastikan barcode QRIS terlihat jelas agar pembeli dapat melakukan scan tanpa kendala.</span>
                    </div>
                </div>
                <div class="modal-footer border-top pt-2">
                    <button type="button" class="btn btn-light rounded-3 fw-bold small" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 fw-bold small px-4">Simpan QRIS</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.72rem; }
    .form-control-custom {
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        border: 1px solid #e2e8f0;
        font-size: 0.875rem;
    }
    .form-control-custom:focus {
        border-color: #7728a8;
        box-shadow: 0 0 0 3px rgba(119, 40, 168, 0.15);
    }
    .font-monospace {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});

// AJAX Toggle Active Status
function togglePaymentStatus(id) {
    fetch(`/vendor/metode-pembayaran/${id}/toggle-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Jika berhasil diaktifkan, matikan toggle switch lain pada grup/tipe yang sama
            if (data.is_active) {
                let switches = document.querySelectorAll('.form-check-input');
                switches.forEach(sw => {
                    // Matikan semua switch kecuali milik item yang di-click
                    if (sw.id !== 'switchBank' + id && sw.id !== 'switchQris' + id) {
                        // Hanya matikan switch dalam kategori/tipe yang sama
                        if (
                            (data.type === 'transfer_bank' && sw.id.startsWith('switchBank')) ||
                            (data.type === 'qris' && sw.id.startsWith('switchQris'))
                        ) {
                            sw.checked = false;
                            
                            // Efek visual card non-aktif
                            let card = sw.closest('.card');
                            if(card) {
                                card.classList.remove('bg-white', 'border-primary');
                                card.classList.add('bg-light', 'opacity-75');
                            }
                        }
                    }
                });
            }

            // Ubah tampilan visual card yang baru saja di-toggle
            let currentSwitch = document.getElementById(data.type === 'transfer_bank' ? 'switchBank' + id : 'switchQris' + id);
            if (currentSwitch) {
                let currentCard = currentSwitch.closest('.card');
                if (data.is_active) {
                    currentCard.classList.remove('bg-light', 'opacity-75');
                    currentCard.classList.add('bg-white', 'border-primary');
                } else {
                    currentCard.classList.remove('bg-white', 'border-primary');
                    currentCard.classList.add('bg-light', 'opacity-75');
                }
            }
        } else {
            alert('Gagal mengubah status metode pembayaran.');
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan koneksi.', error);
    });
}
</script>
@endsection