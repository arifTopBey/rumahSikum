@extends('admin.main.main')

@section('content')
<div class="container-fluid px-4 py-5 bg-light min-vh-100">
    <!-- Header Section: Fokus pada Kejelasan -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h3 class="fw-800 text-dark mb-1">Manajemen Pengguna</h3>
            <p class="text-muted mb-0">Total <span class="fw-bold text-primary">{{ $users->total() }}</span> akun terdaftar di sistem.</p>
        </div>
        
        <!-- Form Pencarian Dinamis -->
        <div class="d-flex gap-2">
            <form action="{{ route('admin.daftar.pengguna.index') }}" method="GET" class="d-flex gap-2">
                <div class="search-wrapper position-relative">
                    <i data-lucide="search" class="search-icon"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           class="form-control ps-5 rounded-3 border-0 shadow-sm" 
                           placeholder="Cari nama atau email..." 
                           style="width: 280px; height: 45px;">
                </div>
                @if(request('search'))
                    <a href="{{ route('admin.daftar.pengguna.index') }}" class="btn btn-light border rounded-3 px-3 d-flex align-items-center shadow-sm" title="Reset Pencarian">
                        <i data-lucide="x" size="18"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="row g-4 mb-5">
        @php
            // Catatan: count() di sini menghitung dari total data paginasi atau keseluruhan tergantung kebutuhan
            $stats = [
                ['label' => 'Administrator', 'count' => \App\Models\User::where('user_role', 'admin')->count(), 'icon' => 'shield', 'color' => 'primary'],
                ['label' => 'Mitra UMKM', 'count' => \App\Models\User::where('user_role', 'vendor')->count(), 'icon' => 'store', 'color' => 'success'],
                ['label' => 'Pelanggan', 'count' => \App\Models\User::where('user_role', 'user')->count(), 'icon' => 'users', 'color' => 'info']
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
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
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
                    @forelse($users as $user)
                    <tr class="user-row">
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle bg-{{ $user->user_role == 'admin' ? 'primary' : ($user->user_role == 'vendor' ? 'success' : 'info') }} text-white fw-bold">
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

                                 <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 py-2 mt-2">
                                    <li>
                                        <h6 class="dropdown-header smaller text-muted fw-bold text-uppercase">Opsi Pengguna</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2 px-3" href="{{ route('admin.daftar.pengguna.detail', $user->id) }}">
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
                                    @if($user->id != auth()->user()->id)
                                        <li>
                                            <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('admin.daftar.pengguna.delete', $user->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')" type="button" class="dropdown-item d-flex align-items-center py-2 px-3 text-danger">
                                                    <i data-lucide="trash-2" size="14" class="me-3"></i>Hapus Akun
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i data-lucide="users-x" size="48" class="mb-2 text-secondary opacity-50"></i>
                            <p class="mb-0">Tidak ada data pengguna yang ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modern & Responsive Pagination Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 px-2">
        <div class="text-muted small">
            Menampilkan 
            <span class="fw-bold text-dark">{{ $users->firstItem() ?? 0 }}</span> sampai 
            <span class="fw-bold text-dark">{{ $users->lastItem() ?? 0 }}</span> dari 
            <span class="fw-bold text-dark">{{ $users->total() }}</span> total data
        </div>
        <div>
            {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
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

    /* Table Customization */
    .table-header-custom tr {
        display: table-row !important;
    }

    .table-header-custom th {
        display: table-cell !important;
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

    .user-row {
        display: table-row !important;
        transition: background 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    .user-row:hover { background-color: #f8fafc; }

    .user-row td {
        display: table-cell !important;
        border-bottom: 1px solid #f8fafc;
    }

    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        overflow-y: visible !important;
    }

    /* Styling Tambahan untuk Paginasi Laravel agar menyatu dengan Tema */
    .pagination {
        margin-bottom: 0;
    }
    .pagination .page-item .page-link {
        border-radius: 8px;
        margin: 0 3px;
        color: #64748b;
        border: 1px solid #e2e8f0;
        font-size: 0.85rem;
        padding: 6px 12px;
    }
    .pagination .page-item.active .page-link {
        background-color: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }
    .pagination .page-item .page-link:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }
</style>

<script>
    // Initialize Lucide Icons
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection