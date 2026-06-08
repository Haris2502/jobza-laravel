<div id="sidebar" class="active">
    <div class="sidebar-wrapper active shadow-sm">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="/dashboard" class="d-flex align-items-center text-decoration-none">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                            <i class="bi bi-briefcase-fill text-white fs-6"></i>
                        </div>
                        <span class="fw-bolder text-dark" style="font-size: 1.2rem; letter-spacing: -0.5px;">Job<span class="text-primary">za</span></span>
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle text-muted"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Utama</li>

                <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title">Manajemen Loker</li>

                <li class="sidebar-item {{ request()->is('admin/jobs/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.jobs.create') }}" class='sidebar-link'>
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Kelola Jobs</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('admin/reels') ? 'active' : '' }}">
                    <a href="{{ route('admin.reels.index') }}" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Kelola Reels</span>
                    </a>
                </li>

                <li class="sidebar-title">Pengaturan</li>

                <li class="sidebar-item {{ request()->is('admin/profile') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Profil</span>
                    </a>
                </li>

                <li class="sidebar-item">
    <a href="{{ route('logout') }}" class="sidebar-link custom-logout-link">
        <i class="bi bi-box-arrow-right text-danger"></i>
        <span class="text-danger fw-semibold">Logout</span>
    </a>
</li>
            </ul>
        </div>

        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>

<style>
    /* Styling Tambahan agar terlihat Premium */
    .sidebar-wrapper {
        background-color: #fff !important;
        border-right: 1px solid #f1f1f1;
    }
    .sidebar-item.active .sidebar-link {
        background-color: #435ebe !important;
        box-shadow: 0 4px 10px rgba(67, 94, 190, 0.25);
    }
    .sidebar-link {
        transition: all 0.3s ease;
        border-radius: 10px !important;
        margin: 0.2rem 0.8rem !important;
    }
    .sidebar-link:hover {
        background-color: #f0f3ff !important;
        transform: translateX(5px);
    }
    .sidebar-title {
        font-size: 0.7rem !important;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        font-weight: 700 !important;
        color: #adb5bd !important;
        margin-top: 1.5rem !important;
    }
    .text-danger:hover {
        background-color: #fff5f5 !important;
    }
    .custom-logout-link {
        transition: all 0.2s ease-in-out;
    }

    /* Efek ketika menu logout disorot (hover) */
    .sidebar-item:hover .custom-logout-link {
        background-color: #fef2f2 !important; /* Warna merah muda transparan yang lembut */
    }

    .custom-logout-link:hover i,
    .custom-logout-link:hover span {
        color: #dc2626 !important; /* Warna merah yang sedikit lebih tegas saat hover */
    }
</style>
</div>
