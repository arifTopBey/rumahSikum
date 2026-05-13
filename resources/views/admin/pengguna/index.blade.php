@extends('admin.main.main')

@section('content')
<div class="container-fluid px-4 py-5 bg-light min-vh-100">
    <!-- Header Section: Fokus pada Kejelasan -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h3 class="fw-800 text-dark mb-1">Manajemen Pengguna</h3>
            <p class="text-muted mb-0">Total <span class="fw-bold text-primary">{{ $users->count() }}</span> akun terdaftar di sistem.</p>
        </div>
        <div class="d-flex gap-2">
            <div class="search-wrapper">
                <i data-lucide="search" class="search-icon"></i>
                <input type="text" class="form-control ps-5 rounded-3 border-0 shadow-sm" placeholder="Cari nama atau email..." style="width: 280px; height: 45px;">
            </div>
            <!-- <button class="btn btn-primary rounded-3 px-4 shadow-sm fw-bold d-flex align-items-center">
                <i data-lucide="plus" class="me-2" size="18"></i> Pengguna Baru
            </button> -->
        </div>
    </div>

    <div class="row g-4 mb-5">
        @php
            $stats = [
                ['label' => 'Administrator', 'count' => $users->where('role', 'admin')->count(), 'icon' => 'shield', 'color' => 'primary'],
                ['label' => 'Mitra UMKM', 'count' => $users->where('role', 'vendor')->count(), 'icon' => 'store', 'color' => 'success'],
                ['label' => 'Pelanggan', 'count' => $users->where('role', 'user')->count(), 'icon' => 'users', 'color' => 'info']
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted smaller fw-bold text-uppercase mb-1">{{ $stat['label'] }}</p>
                        <h2 class="fw-800 mb-0">{{ $stat['count'] }}</h2>
                    </div>
                    <div class="icon-shape bg-{{ $stat['color'] }} bg-opacity-10 text-{{ $stat['color'] }} rounded-3 p-3">
                        <i data-lucide="{{ $stat['icon'] }}"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Table Card: Clean Layout -->
  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="min-width: 1000px;">
            <thead class="table-header-custom">
                <tr>
                    <th class="ps-4">PROFIL</th>
                    <th>INFORMASI KONTAK</th>
                    <th>ROLE</th>
                    <th>STATUS</th>
                    <th>TANGGAL GABUNG</th>
                    <th class="pe-4 text-end">KELOLA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="user-row">
                    <td class="ps-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-circle bg-{{ $user->role == 'admin' ? 'primary' : ($user->role == 'vendor' ? 'success' : 'info') }} text-white fw-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                <div class="smaller text-muted">ID: #USR-{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="small text-dark">{{ $user->email }}</span>
                            <span class="smaller text-muted">{{ $user->phone ?? '-' }}</span>
                        </div>
                    </td>
                    <td>
                         <span class="role-badge role-{{ $user->user_role }}">
                            {{ ucfirst($user->user_role) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="status-indicator active"></span>
                            <span class="small fw-medium">Active</span>
                        </div>
                    </td>
                    <td>
                        <span class="small text-muted">{{ $user->created_at->format('M d, Y') }}</span>
                    </td>
                    <td class="pe-4 text-end">
                        <!-- Dropdown Button -->
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle p-2" data-bs-toggle="dropdown">
                                <i data-lucide="more-vertical" size="16"></i>
                            </button>

                            <!-- Menu dropdown -->
                             <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 py-2 mt-2">
                                <li>
                                    <h6 class="dropdown-header smaller text-muted fw-bold text-uppercase">Opsi Pengguna</h6>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="#">
                                        <i data-lucide="eye" size="16" class="me-3 text-primary"></i>
                                        <span class="small fw-medium">Lihat Detail</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="#">
                                        <i data-lucide="edit" size="16" class="me-3 text-success"></i>
                                        <span class="small fw-medium">Edit Profil</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="#">
                                        <i data-lucide="shield-alert" size="16" class="me-3 text-warning"></i>
                                        <span class="small fw-medium">Reset Password</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider opacity-50"></li>
                                <li>
                                    <button class="dropdown-item d-flex align-items-center py-2 px-3 text-danger" onclick="return confirm('Apakah Anda yakin?')">
                                        <i data-lucide="trash-2" size="16" class="me-3"></i>
                                        <span class="small fw-bold">Hapus Akun</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.7rem; letter-spacing: 0.05rem; }

    /* Search Style */
    .search-wrapper { position: relative; }
    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        width: 18px;
    }

    /* Avatar Style */
    .avatar-circle {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    /* Role Badges */
    .role-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
    }
    .role-admin { background: #eff6ff; color: #2563eb; }
    .role-vendor { background: #f0fdf4; color: #16a34a; }
    .role-user { background: #f8fafc; color: #64748b; }

    /* Status Indicator */
    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
    .status-indicator.active { background: #22c55e; box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2); }

    /* Table Hover Effects */
    .user-row { transition: background 0.2s ease; border-bottom: 1px solid #f1f5f9; }
    .user-row:hover { background-color: #f8fafc; }
    .table thead th { border-bottom: 2px solid #f1f5f9; }

    /* Dropdown Customization */
    .dropdown-item { transition: all 0.2s; }
    .dropdown-item:hover { background-color: #f1f5f9; color: #000; }

    .table {
        width: 100%;
        min-width: 900px; 
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        white-space: nowrap; 
        vertical-align: middle;
        background-color: #f8fafc; 
        border-top: none;
    }

    .smaller { 
        font-size: 0.75rem; 
        letter-spacing: 0.05rem; 
    }

    
    .table-responsive {
        overflow-x: auto;
        overflow-y: visible !important;
    }

    <style>
    /* Paksa table-header untuk berbaris ke samping */
    .table-header-custom tr {
        display: table-row !important; /* Paksa baris tetap horizontal */
    }

    .table-header-custom th {
        display: table-cell !important; /* Paksa cell tetap cell, bukan block */
        background-color: #f8fafc;
        padding-top: 20px !important;
        padding-bottom: 20px !important;
        color: #64748b !important;
        font-size: 0.75rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.05rem;
        border-bottom: 1px solid #f1f5f9 !important;
        white-space: nowrap;
    }

    /* Memastikan body tabel juga konsisten */
    .user-row {
        display: table-row !important;
    }

    .user-row td {
        display: table-cell !important;
        border-bottom: 1px solid #f8fafc;
    }

    /* Perbaikan avatar sesuai screenshot */
    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Pastikan table-responsive tidak merusak tabel */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>


<script>
    // Initialize Lucide Icons
    lucide.createIcons();
</script>
@endsection