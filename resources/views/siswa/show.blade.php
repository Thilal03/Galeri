@extends('layouts.admin')

@section('title', 'Detail Siswa - ' . $siswa->nama_siswa)
@section('page-title', 'Detail Siswa')
@section('breadcrumb', 'Admin Panel / Data Siswa / Detail')

@section('content')
    <div class="row">
        {{-- Profile Card --}}
        <div class="col-lg-4 mb-4">
            <div class="card-premium animate-fade-in">
                <div class="card-body text-center" style="padding: 40px 24px;">
                    {{-- Avatar --}}
                    <div style="width:90px;height:90px;border-radius:20px;background:linear-gradient(135deg,#f59e0b,#f97316);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:36px;margin:0 auto 20px;box-shadow:0 8px 25px rgba(245,158,11,0.35);">
                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                    </div>

                    <h4 style="font-weight:700;margin-bottom:6px;">{{ $siswa->nama_siswa }}</h4>
                    <span class="badge-soft-success" style="font-size:14px;padding:6px 16px;">{{ $siswa->kelas }}</span>

                    {{-- Guru Info --}}
                    <div style="background:var(--bg-secondary);border-radius:14px;padding:18px;margin-top:28px;">
                        <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:10px;">
                            <i class="fas fa-chalkboard-teacher me-1"></i> Guru Pembimbing
                        </div>
                        @if($siswa->guru)
                            <div class="d-flex align-items-center gap-3 justify-content-center">
                                <div style="width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:16px;flex-shrink:0;">
                                    {{ strtoupper(substr($siswa->guru->nama_guru, 0, 1)) }}
                                </div>
                                <div style="text-align:left;">
                                    <div style="font-weight:700;font-size:14px;">{{ $siswa->guru->nama_guru }}</div>
                                    <div style="font-size:12px;color:var(--text-secondary);">{{ $siswa->guru->keahlian }}</div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted" style="font-size:13px;">Belum ditentukan</span>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-2 mt-4 justify-content-center">
                        @if(in_array(auth()->user()->role, ['admin', 'guru']))
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-accent" style="flex:1;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                        <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;flex:1;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Info --}}
        <div class="col-lg-8">
            <div class="card-premium animate-fade-in mb-4">
                <div class="card-header">
                    <span><i class="fas fa-info-circle me-2" style="color: var(--accent);"></i> Informasi Siswa</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-user me-1"></i> Nama Lengkap
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $siswa->nama_siswa }}</div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-school me-1"></i> Kelas
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $siswa->kelas }}</div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-chalkboard-teacher me-1"></i> Guru Pembimbing
                            </div>
                            <div style="font-weight:600;font-size:15px;">
                                @if($siswa->guru)
                                    <a href="{{ route('guru.show', $siswa->guru->id) }}" style="color:var(--primary);text-decoration:none;">
                                        {{ $siswa->guru->nama_guru }}
                                        <i class="fas fa-external-link-alt ms-1" style="font-size:11px;"></i>
                                    </a>
                                @else
                                    <span class="text-muted">Belum ditentukan</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-star me-1"></i> Keahlian Guru
                            </div>
                            <div style="font-weight:600;font-size:15px;">
                                @if($siswa->guru)
                                    <span class="badge-soft-info">{{ $siswa->guru->keahlian }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-calendar me-1"></i> Terdaftar Sejak
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $siswa->created_at->format('d F Y') }}</div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-clock me-1"></i> Terakhir Diperbarui
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $siswa->updated_at->format('d F Y, H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions Card (Admin Only) --}}
            @if(in_array(auth()->user()->role, ['admin', 'guru']))
                <div class="card-premium animate-fade-in">
                    <div class="card-header">
                        <span><i class="fas fa-bolt me-2" style="color: var(--accent);"></i> Aksi Cepat</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-accent">
                                <i class="fas fa-edit me-1"></i> Edit Data Siswa
                            </a>
                            @if($siswa->guru)
                                <a href="{{ route('guru.show', $siswa->guru->id) }}" class="btn btn-outline-primary" style="border-radius:10px;font-weight:600;">
                                    <i class="fas fa-chalkboard-teacher me-1"></i> Lihat Guru Pembimbing
                                </a>
                            @endif
                            <form action="{{ route('siswa.delete', $siswa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" style="border-radius:10px;font-weight:600;">
                                    <i class="fas fa-trash me-1"></i> Hapus Siswa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
