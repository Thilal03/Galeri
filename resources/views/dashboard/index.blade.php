@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Panel / Dashboard')

@section('content')
    {{-- Welcome Banner --}}
    <div class="welcome-banner mb-4">
        <div class="welcome-content">
            <div>
                <h2 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                <p class="welcome-subtitle">
                    @if(in_array(Auth::user()->role, ['admin', 'guru']))
                        Kelola data galeri, guru, dan siswa dari dashboard admin Anda.
                    @else
                        Lihat informasi galeri, data guru, dan data siswa di sini.
                    @endif
                </p>
            </div>
            <div class="welcome-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card stat-galeri animate-fade-in">
                <div class="stat-icon"><i class="fas fa-images"></i></div>
                <div class="stat-value">{{ $totalGaleri }}</div>
                <div class="stat-label">Total Galeri</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-guru animate-fade-in" style="animation-delay: 0.1s;">
                <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="stat-value">{{ $totalGuru }}</div>
                <div class="stat-label">Total Guru</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-siswa animate-fade-in" style="animation-delay: 0.2s;">
                <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="stat-value">{{ $totalSiswa }}</div>
                <div class="stat-label">Total Siswa</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Tabel Data Guru --}}
        <div class="col-lg-6">
            <div class="card-premium animate-fade-in" style="animation-delay: 0.3s;">
                <div class="card-header">
                    <span><i class="fas fa-chalkboard-teacher me-2" style="color: var(--info);"></i> Data Guru</span>
                    <a href="{{ route('guru.index') }}" class="btn-view-all">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-premium">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Guru</th>
                                    <th>Keahlian</th>
                                    <th>Siswa</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guru as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-sm avatar-guru">
                                                    {{ strtoupper(substr($item->nama_guru, 0, 1)) }}
                                                </div>
                                                <span style="font-weight: 600;">{{ $item->nama_guru }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-soft-info">{{ $item->keahlian }}</span>
                                        </td>
                                        <td>
                                            <span class="badge-soft-secondary">{{ $item->siswas->count() }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('guru.show', $item->id) }}" class="btn-sm-action btn-view" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty-state-sm">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                                <span>Belum ada data guru</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Data Siswa --}}
        <div class="col-lg-6">
            <div class="card-premium animate-fade-in" style="animation-delay: 0.4s;">
                <div class="card-header">
                    <span><i class="fas fa-user-graduate me-2" style="color: var(--warning);"></i> Data Siswa</span>
                    <a href="{{ route('siswa.index') }}" class="btn-view-all">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-premium">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-sm avatar-siswa">
                                                    {{ strtoupper(substr($item->nama_siswa, 0, 1)) }}
                                                </div>
                                                <span style="font-weight: 600;">{{ $item->nama_siswa }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-soft-success">{{ $item->kelas }}</span>
                                        </td>
                                        <td>
                                            @if($item->guru)
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-xs avatar-guru">
                                                        {{ strtoupper(substr($item->guru->nama_guru, 0, 1)) }}
                                                    </div>
                                                    <span style="font-size: 13px;">{{ $item->guru->nama_guru }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted" style="font-size: 13px;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('siswa.show', $item->id) }}" class="btn-sm-action btn-view" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty-state-sm">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Belum ada data siswa</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
        border-radius: 20px;
        padding: 32px 36px;
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: 30%;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .welcome-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .welcome-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.3px;
    }

    .welcome-subtitle {
        font-size: 14px;
        opacity: 0.85;
        margin: 0;
        max-width: 500px;
    }

    .welcome-icon {
        font-size: 56px;
        opacity: 0.25;
    }

    /* Avatar Small */
    .avatar-sm {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        flex-shrink: 0;
    }

    .avatar-xs {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 10px;
        flex-shrink: 0;
    }

    .avatar-guru {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
    }

    .avatar-siswa {
        background: linear-gradient(135deg, #f59e0b, #f97316);
    }

    /* View All Button */
    .btn-view-all {
        font-size: 13px;
        font-weight: 600;
        color: var(--accent);
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-view-all:hover {
        color: var(--accent-light);
        gap: 4px;
    }

    /* Empty State Small */
    .empty-state-sm {
        text-align: center;
        padding: 30px 16px;
        color: var(--text-secondary);
        font-size: 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .empty-state-sm i {
        font-size: 28px;
        color: #cbd5e1;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .welcome-banner {
            padding: 24px 20px;
        }

        .welcome-title {
            font-size: 20px;
        }

        .welcome-icon {
            display: none;
        }
    }
</style>
@endpush
