@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')
@section('breadcrumb', 'Admin Panel / Data Siswa')

@section('content')
    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-premium alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0" style="font-size: 14px;">
                @if(in_array(auth()->user()->role, ['admin', 'guru']))
                    Kelola data siswa dan kelasnya
                @else
                    Lihat data siswa dan kelasnya
                @endif
            </p>
        </div>
        @if(in_array(auth()->user()->role, ['admin', 'guru']))
            <a href="{{ route('siswa.create') }}" class="btn btn-accent">
                <i class="fas fa-plus"></i> Tambah Siswa
            </a>
        @endif
    </div>

    {{-- Table Card --}}
    <div class="card-premium">
        <div class="card-header">
            <span><i class="fas fa-user-graduate me-2" style="color: var(--accent);"></i> Daftar Siswa</span>
            <span class="badge-soft-info">{{ $siswa->count() }} siswa</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Guru Pembimbing</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#f59e0b,#f97316);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;flex-shrink:0;">
                                            {{ strtoupper(substr($item->nama_siswa, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:600;">{{ $item->nama_siswa }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-soft-success">{{ $item->kelas }}</span>
                                </td>
                                <td>
                                    @if($item->guru)
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:10px;flex-shrink:0;">
                                                {{ strtoupper(substr($item->guru->nama_guru, 0, 1)) }}
                                            </div>
                                            <span style="font-size:13px;">{{ $item->guru->nama_guru }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted" style="font-size:13px;">Belum ada</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('siswa.show', $item->id) }}" class="btn-sm-action btn-view" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(in_array(auth()->user()->role, ['admin', 'guru']))
                                            <a href="{{ route('siswa.edit', $item->id) }}" class="btn-sm-action btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('siswa.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm-action btn-delete" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-icon"><i class="fas fa-user-graduate"></i></div>
                                        <h5>Belum ada data siswa</h5>
                                        <p>
                                            @if(in_array(auth()->user()->role, ['admin', 'guru']))
                                                Mulai tambahkan data siswa baru
                                            @else
                                                Belum ada data siswa yang tersedia
                                            @endif
                                        </p>
                                        @if(in_array(auth()->user()->role, ['admin', 'guru']))
                                            <a href="{{ route('siswa.create') }}" class="btn btn-accent mt-3">
                                                <i class="fas fa-plus"></i> Tambah Siswa
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
