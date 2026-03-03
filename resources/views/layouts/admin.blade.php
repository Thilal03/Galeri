<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Galeri Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: linear-gradient(135deg, #6366f1, #8b5cf6);
            --accent: #6366f1;
            --accent-light: #818cf8;
            --bg-main: #f1f5f9;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: #fff;
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand .brand-icon {
            width: 42px;
            height: 42px;
            background: var(--sidebar-active);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .sidebar-brand .brand-sub {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 400;
        }

        .sidebar-menu {
            padding: 16px 12px;
            flex: 1;
        }

        .menu-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #475569;
            padding: 0 12px;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        .menu-label:first-child {
            margin-top: 0;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 2px;
            position: relative;
        }

        .nav-link-custom:hover {
            color: #fff;
            background: var(--sidebar-hover);
        }

        .nav-link-custom.active {
            color: #fff;
            background: var(--sidebar-active);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .nav-link-custom .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-footer .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
            margin-bottom: 8px;
        }

        .sidebar-footer .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .sidebar-footer .user-name {
            font-size: 13px;
            font-weight: 600;
        }

        .sidebar-footer .user-role {
            font-size: 11px;
            color: #64748b;
        }

        /* ===================== MAIN CONTENT ===================== */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===================== TOP BAR ===================== */
        .topbar {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-left h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .topbar-left .breadcrumb-text {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-primary);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
        }

        .hamburger:hover {
            background: var(--border-color);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ===================== PAGE CONTENT ===================== */
        .page-content {
            padding: 28px;
        }

        /* ===================== PREMIUM CARDS ===================== */
        .card-premium {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        .card-premium:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .card-premium .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 20px 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-premium .card-body {
            padding: 24px;
        }

        /* ===================== BUTTONS ===================== */
        .btn-accent {
            background: var(--sidebar-active);
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-accent:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            color: #fff;
        }

        .btn-sm-action {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.2s ease;
            font-size: 13px;
        }

        .btn-sm-action:hover {
            transform: translateY(-1px);
        }

        .btn-view { background: rgba(59,130,246,0.1); color: var(--info); }
        .btn-view:hover { background: var(--info); color: #fff; }
        .btn-edit { background: rgba(245,158,11,0.1); color: var(--warning); }
        .btn-edit:hover { background: var(--warning); color: #fff; }
        .btn-delete { background: rgba(239,68,68,0.1); color: var(--danger); }
        .btn-delete:hover { background: var(--danger); color: #fff; }

        /* ===================== TABLE ===================== */
        .table-premium {
            margin: 0;
        }

        .table-premium thead th {
            background: #f8fafc;
            border-bottom: 2px solid var(--border-color);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            padding: 14px 16px;
            white-space: nowrap;
        }

        .table-premium tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .table-premium tbody tr {
            transition: background 0.15s ease;
        }

        .table-premium tbody tr:hover {
            background: #f8fafc;
        }

        /* ===================== BADGE ===================== */
        .badge-soft-success {
            background: rgba(34,197,94,0.1);
            color: #16a34a;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        .badge-soft-info {
            background: rgba(59,130,246,0.1);
            color: #2563eb;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        .badge-soft-secondary {
            background: rgba(100,116,139,0.1);
            color: #475569;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        /* ===================== FORM ===================== */
        .form-control-premium {
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control-premium:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }

        .form-label-premium {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        /* ===================== ALERTS ===================== */
        .alert-premium {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-premium.alert-success {
            background: rgba(34,197,94,0.1);
            color: #15803d;
        }

        .alert-premium.alert-danger {
            background: rgba(239,68,68,0.1);
            color: #dc2626;
        }

        /* ===================== EMPTY STATE ===================== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state .empty-icon {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .empty-state h5 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* ===================== OVERLAY ===================== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .hamburger {
                display: block;
            }
        }

        /* ===================== ANIMATIONS ===================== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.4s ease-out;
        }

        /* ===================== STAT CARDS ===================== */
        .stat-card {
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            color: #fff;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }

        .stat-card .stat-icon {
            font-size: 28px;
            opacity: 0.8;
            margin-bottom: 12px;
        }

        .stat-card .stat-value {
            font-size: 28px;
            font-weight: 800;
        }

        .stat-card .stat-label {
            font-size: 13px;
            opacity: 0.8;
            margin-top: 4px;
        }

        .stat-galeri { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
        .stat-guru { background: linear-gradient(135deg, #3b82f6, #06b6d4); }
        .stat-siswa { background: linear-gradient(135deg, #f59e0b, #f97316); }

        /* ===================== TOPBAR USER DROPDOWN ===================== */
        .topbar-user-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: #fff;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .topbar-user-btn:hover,
        .topbar-user-btn:focus,
        .topbar-user-btn.show {
            background: #f8fafc;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            color: var(--text-primary);
        }

        .topbar-user-btn::after {
            font-size: 10px;
            margin-left: 2px;
        }

        .topbar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            flex-shrink: 0;
        }

        .topbar-username {
            font-weight: 600;
            font-size: 13px;
        }

        .dropdown-premium {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            padding: 8px;
            min-width: 220px;
            animation: dropdownFadeIn 0.2s ease;
        }

        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-premium .dropdown-header {
            padding: 12px 12px 8px;
        }

        .dropdown-premium .dropdown-item {
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.15s ease;
        }

        .dropdown-premium .dropdown-item:hover {
            background: #f1f5f9;
        }

        .dropdown-premium .dropdown-item.text-danger:hover {
            background: rgba(239, 68, 68, 0.08);
        }

        .dropdown-premium .dropdown-divider {
            margin: 4px 0;
            border-color: var(--border-color);
        }

        /* ===================== SIDEBAR FOOTER HOVER ===================== */
        .sidebar-footer .user-info:hover {
            background: rgba(255,255,255,0.1) !important;
            border-radius: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    @stack('styles')
    
</head>
<body>
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div>
                <div class="brand-text">{{ in_array(auth()->user()->role, ['admin', 'guru']) ? 'Admin Panel' : 'Panel Sekolah' }}</div>
                <div class="brand-sub">Manajemen Sekolah</div>
            </div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Menu Utama</div>

            <a href="{{ route('dashboard') }}" class="nav-link-custom @if(request()->routeIs('dashboard')) active @endif">
                <span class="nav-icon"><i class="fas fa-th-large"></i></span>
                <span>Dashboard</span>
            </a>

            @if(in_array(auth()->user()->role, ['admin', 'guru']))
                <a href="{{ route('admin.galeri.index') }}" class="nav-link-custom @if(request()->routeIs('admin.galeri.*')) active @endif">
                    <span class="nav-icon"><i class="fas fa-images"></i></span>
                    <span>Galeri</span>
                </a>
            @endif

            @if(auth()->user()->role !== 'admin')
                <a href="{{ route('dashboard.galeri') }}" class="nav-link-custom @if(request()->routeIs('dashboard.galeri')) active @endif">
                    <span class="nav-icon"><i class="fas fa-photo-video"></i></span>
                    <span>Lihat Galeri</span>
                </a>
            @endif

            <a href="{{ route('guru.index') }}" class="nav-link-custom @if(request()->routeIs('guru.*')) active @endif">
                <span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span>
                <span>Data Guru</span>
            </a>

            <a href="{{ route('siswa.index') }}" class="nav-link-custom @if(request()->routeIs('siswa.*')) active @endif">
                <span class="nav-icon"><i class="fas fa-user-graduate"></i></span>
                <span>Data Siswa</span>
            </a>

            <div class="menu-label">Lainnya</div>

            <a href="{{ route('profile.show') }}" class="nav-link-custom @if(request()->routeIs('profile.*')) active @endif">
                <span class="nav-icon"><i class="fas fa-user-circle"></i></span>
                <span>Profil Saya</span>
            </a>

            <a href="/" class="nav-link-custom">
                <span class="nav-icon"><i class="fas fa-home"></i></span>
                <span>Lihat Website</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('profile.show') }}" class="user-info" style="text-decoration: none; color: inherit; cursor: pointer; transition: background 0.2s ease;">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="user-role">{{ auth()->user()->role === 'admin' ? 'Administrator' : (auth()->user()->role === 'guru' ? 'Guru' : 'User') }}</div>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link-custom w-100 border-0 text-start" style="cursor:pointer; color: #f87171;" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='transparent'">
                    <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="hamburgerBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <div class="breadcrumb-text">@yield('breadcrumb', 'Admin Panel')</div>
                </div>
            </div>
            <div class="topbar-right">
                <span class="text-muted d-none d-md-inline" style="font-size: 13px;">
                    <i class="fas fa-calendar-alt me-1"></i>
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>

                {{-- User Dropdown --}}
                <div class="dropdown">
                    <button class="btn topbar-user-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="topbar-avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="d-none d-md-inline topbar-username">{{ Auth::user()->name ?? 'User' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-premium">
                        <li class="dropdown-header">
                            <div style="font-weight: 700; font-size: 14px;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 12px; color: var(--text-secondary);">{{ Auth::user()->email }}</div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fas fa-user-circle me-2" style="color: var(--accent);"></i> Profil Saya
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/">
                                <i class="fas fa-home me-2" style="color: var(--info);"></i> Lihat Website
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content animate-fade-in">
            {{-- Global Error Message --}}
            @if(session('error'))
                <div class="alert alert-premium alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const hamburger = document.getElementById('hamburgerBtn');

        hamburger?.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Auto dismiss alerts
        document.querySelectorAll('.alert-dismissible').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                alert.style.transition = 'all 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            }, 4000);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Foto %1 dari %2'
        });
    </script>
    @stack('scripts')
</body>
</html>
