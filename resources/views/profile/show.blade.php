@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')
@section('breadcrumb', 'Panel / Profil')

@section('content')
    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-premium alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Profile Card --}}
        <div class="col-lg-4">
            <div class="card-premium profile-card">
                <div class="profile-cover">
                    <div class="profile-cover-pattern"></div>
                </div>
                <div class="card-body text-center" style="margin-top: -50px; position: relative; z-index: 2;">
                    <div class="profile-avatar-lg mx-auto">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h4 class="mt-3 mb-1" style="font-weight: 700;">{{ $user->name }}</h4>
                    <p class="text-muted mb-2" style="font-size: 14px;">
                        <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                    </p>
                    <span class="profile-role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                        <i class="fas {{ $user->role === 'admin' ? 'fa-shield-alt' : ($user->role === 'guru' ? 'fa-chalkboard-teacher' : 'fa-user') }} me-1"></i>
                        {{ $user->role === 'admin' ? 'Administrator' : ($user->role === 'guru' ? 'Guru' : 'User') }}
                    </span>

                    <div class="profile-stats mt-4">
                        <div class="stat-item">
                            <div class="stat-number">
                                <i class="fas fa-calendar-alt" style="font-size: 14px; color: var(--accent);"></i>
                            </div>
                            <div class="stat-text">Bergabung {{ $user->created_at->translatedFormat('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logout Card --}}
            <div class="card-premium mt-4">
                <div class="card-body">
                    <h6 style="font-weight: 700; margin-bottom: 12px;">
                        <i class="fas fa-sign-out-alt me-2" style="color: var(--danger);"></i>Keluar Akun
                    </h6>
                    <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 16px;">
                        Anda akan keluar dari sistem dan perlu login kembali untuk mengakses.
                    </p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-logout w-100" onclick="return confirm('Yakin ingin logout?')">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Profile --}}
        <div class="col-lg-8">
            {{-- Update Profile Form --}}
            <div class="card-premium mb-4">
                <div class="card-header">
                    <span><i class="fas fa-user-edit me-2" style="color: var(--accent);"></i> Edit Profil</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label-premium">
                                <i class="fas fa-user me-1" style="color: var(--accent);"></i> Nama Lengkap
                            </label>
                            <input type="text"
                                   class="form-control form-control-premium @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label-premium">
                                <i class="fas fa-envelope me-1" style="color: var(--accent);"></i> Alamat Email
                            </label>
                            <input type="email"
                                   class="form-control form-control-premium @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label-premium">
                                <i class="fas fa-user-tag me-1" style="color: var(--accent);"></i> Role
                            </label>
                            <input type="text"
                                   class="form-control form-control-premium"
                                   value="{{ $user->role === 'admin' ? 'Administrator' : ($user->role === 'guru' ? 'Guru' : 'User') }}"
                                   disabled
                                   readonly>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i>Role hanya bisa diubah oleh administrator melalui database.
                            </small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Update Password Form --}}
            <div class="card-premium">
                <div class="card-header">
                    <span><i class="fas fa-lock me-2" style="color: var(--warning);"></i> Ubah Password</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="current_password" class="form-label-premium">
                                <i class="fas fa-key me-1" style="color: var(--warning);"></i> Password Saat Ini
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-premium @error('current_password') is-invalid @enderror"
                                       id="current_password"
                                       name="current_password"
                                       required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password" style="border-radius: 0 10px 10px 0; border-color: var(--border-color);">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label-premium">
                                <i class="fas fa-lock me-1" style="color: var(--warning);"></i> Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-premium @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password" style="border-radius: 0 10px 10px 0; border-color: var(--border-color);">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i>Minimal 8 karakter
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label-premium">
                                <i class="fas fa-check-double me-1" style="color: var(--warning);"></i> Konfirmasi Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-premium"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation" style="border-radius: 0 10px 10px 0; border-color: var(--border-color);">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning-custom">
                                <i class="fas fa-key"></i> Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Profile Cover */
    .profile-cover {
        height: 120px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
        border-radius: 16px 16px 0 0;
        position: relative;
        overflow: hidden;
    }

    .profile-cover-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 40%),
            radial-gradient(circle at 60% 80%, rgba(255,255,255,0.06) 0%, transparent 30%);
    }

    /* Profile Avatar Large */
    .profile-avatar-lg {
        width: 90px;
        height: 90px;
        border-radius: 20px;
        background: linear-gradient(135deg, #6366f1, #ec4899);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        font-size: 28px;
        border: 4px solid #fff;
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-avatar-lg:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(99, 102, 241, 0.45);
    }

    /* Role Badge */
    .profile-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .role-admin {
        background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(139,92,246,0.15));
        color: #6366f1;
    }

    .role-user {
        background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(16,185,129,0.15));
        color: #16a34a;
    }

    /* Profile Stats */
    .profile-stats {
        padding: 16px 0 8px;
        border-top: 1px solid var(--border-color);
    }

    .stat-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .stat-text {
        font-size: 13px;
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Buttons */
    .btn-logout {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-logout:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        color: #fff;
    }

    .btn-warning-custom {
        background: linear-gradient(135deg, #f59e0b, #f97316);
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
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-warning-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        color: #fff;
    }

    /* Toggle Password Button */
    .toggle-password {
        background: transparent;
        border-left: none !important;
    }

    .toggle-password:hover {
        background: rgba(99, 102, 241, 0.05);
        color: var(--accent);
    }

    /* Profile Card Animation */
    .profile-card {
        overflow: hidden;
        animation: slideInLeft 0.5s ease-out;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 991px) {
        .profile-avatar-lg {
            width: 70px;
            height: 70px;
            font-size: 22px;
            border-radius: 16px;
        }

        .profile-cover {
            height: 100px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Toggle Password Visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endpush
