<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Sekolah - Beranda</title>
    <meta name="description" content="Galeri Sekolah - Platform manajemen dan galeri foto sekolah modern">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #f59e0b;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ===================== NAVBAR ===================== */
        .navbar-custom {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding: 16px 0;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .nav-brand {
            font-size: 22px;
            font-weight: 800;
            color: var(--dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-brand .brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
        }

        .nav-link-custom {
            color: var(--text-secondary) !important;
            font-weight: 500;
            font-size: 15px;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover {
            color: var(--primary) !important;
            background: rgba(99,102,241,0.08);
        }

        .btn-login-nav {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff !important;
            padding: 9px 22px !important;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(99,102,241,0.3);
        }

        .btn-login-nav:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99,102,241,0.4);
        }

        /* Nav User Dropdown */
        .nav-user-dropdown {
            position: relative;
        }

        .nav-user-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.08);
            background: #fff;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-user-btn:hover {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.08);
        }

        .nav-user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 11px;
        }

        .nav-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            padding: 8px;
            min-width: 210px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px);
            transition: all 0.2s ease;
            z-index: 1000;
        }

        .nav-user-dropdown:hover .nav-dropdown-menu,
        .nav-dropdown-menu:hover {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown-header {
            padding: 10px 12px 8px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 4px;
        }

        .nav-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            text-decoration: none;
            transition: background 0.15s;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
        }

        .nav-dropdown-item:hover {
            background: #f1f5f9;
            color: var(--text-primary);
        }

        .nav-dropdown-item.text-danger {
            color: #ef4444;
        }

        .nav-dropdown-item.text-danger:hover {
            background: rgba(239,68,68,0.06);
        }

        .nav-dropdown-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 4px 0;
        }

        /* ===================== HERO ===================== */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        }

        .hero-bg-shapes {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .hero-bg-shapes .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
        }

        .shape-1 {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: var(--secondary);
            bottom: -100px;
            left: -100px;
            animation: float 10s ease-in-out infinite reverse;
        }

        .shape-3 {
            width: 300px;
            height: 300px;
            background: var(--accent);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: float 12s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(5deg); }
            66% { transform: translateY(10px) rotate(-3deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #fff;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.9);
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }

        .hero-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        .hero-title .gradient-text {
            background: linear-gradient(135deg, var(--primary-light), var(--secondary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 18px;
            color: rgba(255,255,255,0.7);
            line-height: 1.7;
            max-width: 520px;
            margin-bottom: 36px;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(99,102,241,0.4);
            border: none;
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(99,102,241,0.5);
            color: #fff;
        }

        .btn-hero-secondary {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
            color: #fff;
        }

        .btn-hero-outline {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.3);
            color: rgba(255,255,255,0.7);
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-hero-outline:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.5);
            color: #fff;
            transform: translateY(-2px);
        }

        .hero-image-wrapper {
            position: relative;
        }

        .hero-card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 24px;
            backdrop-filter: blur(20px);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .stat-item {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
        }

        .stat-item .stat-icon {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .stat-item .stat-value {
            font-size: 26px;
            font-weight: 800;
        }

        .stat-item .stat-label {
            font-size: 12px;
            opacity: 0.7;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===================== FEATURES ===================== */
        .features-section {
            padding: 100px 0;
            background: #f8fafc;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(99,102,241,0.08);
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 14px;
        }

        .section-subtitle {
            font-size: 16px;
            color: var(--text-secondary);
            max-width: 550px;
            margin: 0 auto 50px;
        }

        .feature-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 32px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: transparent;
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 20px;
            color: #fff;
        }

        .feature-card h5 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.7;
            margin: 0;
        }

        /* ===================== CTA ===================== */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--primary);
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.2;
            top: -200px;
            right: -200px;
        }


        /* ===================== ANIMATIONS ===================== */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }


        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            .hero-stats {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
            .stat-item .stat-value {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNav">
        <div class="container">
            <a class="nav-brand" href="/">
                <div class="brand-icon"><i class="fas fa-graduation-cap"></i></div>
                <span>GaleriSekolah</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{ in_array(auth()->user()->role, ['admin', 'guru']) ? route('admin.galeri.index') : route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <div class="nav-user-dropdown">
                                <div class="nav-user-btn">
                                    <div class="nav-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down" style="font-size:10px;opacity:0.5;"></i>
                                </div>
                                <div class="nav-dropdown-menu">
                                    <div class="nav-dropdown-header">
                                        <div style="font-weight:700;font-size:14px;">{{ Auth::user()->name }}</div>
                                        <div style="font-size:12px;color:var(--text-secondary);">{{ Auth::user()->email }}</div>
                                    </div>
                                    <a href="{{ route('profile.show') }}" class="nav-dropdown-item">
                                        <i class="fas fa-user-circle" style="color:var(--primary);width:16px;"></i> Profil Saya
                                    </a>
                                    <a href="{{ in_array(auth()->user()->role, ['admin', 'guru']) ? route('admin.galeri.index') : route('dashboard') }}" class="nav-dropdown-item">
                                        <i class="fas fa-th-large" style="color:var(--primary);width:16px;"></i> Dashboard
                                    </a>
                                    <div class="nav-dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                                        @csrf
                                        <button type="submit" class="nav-dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt" style="width:16px;"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a class="nav-link btn-login-nav" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <span class="dot"></span>
                            Platform Galeri Sekolah Modern
                        </div>
                        <h1 class="hero-title">
                            Jelajahi <span class="gradient-text">Galeri Foto</span> Sekolah Kami
                        </h1>
                        <p class="hero-description">
                            Platform galeri foto sekolah yang modern dan interaktif. Kelola data guru, siswa, dan dokumentasi kegiatan sekolah secara digital.
                        </p>
                        @guest
                        <div class="hero-buttons">
                            <a href="{{ route('login') }}" class="btn-hero-primary">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="btn-hero-secondary">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="hero-image-wrapper fade-up">
                        <div class="hero-card">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,var(--primary),var(--secondary));display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px;">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <div style="font-weight:700;font-size:16px;">Data Sekolah</div>
                                    <div style="font-size:12px;opacity:0.6;">Ringkasan informasi</div>
                                </div>
                            </div>
                            <div class="hero-stats">
                                <div class="stat-item">
                                    <div class="stat-icon">📸</div>
                                    <div class="stat-value">{{ \App\Models\Galeri::where('is_active', 1)->count() }}</div>
                                    <div class="stat-label">Galeri</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">👨‍🏫</div>
                                    <div class="stat-value">{{ \App\Models\guru::count() }}</div>
                                    <div class="stat-label">Guru</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">🎓</div>
                                    <div class="stat-value">{{ \App\Models\siswa::count() }}</div>
                                    <div class="stat-label">Siswa</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">🖼️</div>
                                    <div class="stat-value">{{ \App\Models\DetailGaleri::count() }}</div>
                                    <div class="stat-label">Foto</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center">
                <div class="section-badge"><i class="fas fa-star"></i> Fitur Unggulan</div>
                <h2 class="section-title">Kelola Sekolah dengan Mudah</h2>
                <p class="section-subtitle">
                    Platform all-in-one untuk mengelola gallery foto, data guru, dan data siswa secara modern dan efisien.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 fade-up">
                    <div class="feature-card">
                        <div class="feature-icon" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);">
                            <i class="fas fa-images"></i>
                        </div>
                        <h5>Galeri Foto</h5>
                        <p>Kelola galeri foto sekolah dengan mudah. Upload, edit, dan organisasikan koleksi foto kegiatan sekolah.</p>
                    </div>
                </div>
                <div class="col-md-4 fade-up" style="transition-delay: 0.1s;">
                    <div class="feature-card">
                        <div class="feature-icon" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h5>Data Guru</h5>
                        <p>Manajemen data guru secara lengkap termasuk nama, keahlian, dan jumlah siswa yang dibimbing.</p>
                    </div>
                </div>
                <div class="col-md-4 fade-up" style="transition-delay: 0.2s;">
                    <div class="feature-card">
                        <div class="feature-icon" style="background:linear-gradient(135deg,#f59e0b,#f97316);">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h5>Data Siswa</h5>
                        <p>Pencatatan data siswa yang terhubung dengan guru pembimbing, lengkap dengan informasi kelas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center position-relative" style="z-index:2;">
            <h2 style="font-size:32px;font-weight:800;margin-bottom:14px;">Mulai Kelola Data Sekolah Anda</h2>
            <p style="font-size:16px;opacity:0.7;max-width:500px;margin:0 auto 30px;">
                Login ke dashboard admin untuk mulai mengelola galeri foto, data guru, dan data siswa.
            </p>
            @guest
            <a href="{{ route('login') }}" class="btn-hero-primary">
                <i class="fas fa-sign-in-alt"></i> Login Sekarang
            </a>
            @else
            <a href="{{ in_array(auth()->user()->role, ['admin', 'guru']) ? route('admin.galeri.index') : route('dashboard') }}" class="btn-hero-primary">
                <i class="fas fa-th-large"></i> Buka Dashboard
            </a>
            @endguest
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Fade-in on scroll
        const fadeElements = document.querySelectorAll('.fade-up');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        fadeElements.forEach(el => observer.observe(el));

        // Initial animation for hero card
        setTimeout(() => {
            document.querySelector('.hero-image-wrapper')?.classList.add('visible');
        }, 300);
    </script>
</body>
</html>
