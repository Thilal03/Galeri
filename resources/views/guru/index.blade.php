@extends('layouts.admin')

@section('title', 'Data Guru')
@section('page-title', 'Data Guru')
@section('breadcrumb', 'Admin Panel / Data Guru')

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
                    Kelola data guru dan keahliannya
                @else
                    Lihat data guru dan keahliannya
                @endif
            </p>
        </div>
        @if(in_array(auth()->user()->role, ['admin', 'guru']))
            <a href="{{ route('guru.create') }}" class="btn btn-accent">
                <i class="fas fa-plus"></i> Tambah Guru
            </a>
        @endif
    </div>

    {{-- Table Card --}}
    <div class="card-premium">
        <div class="card-header">
            <span><i class="fas fa-chalkboard-teacher me-2" style="color: var(--accent);"></i> Daftar Guru</span>
            <span class="badge-soft-info">{{ $guru->count() }} guru</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Guru</th>
                            <th>Keahlian</th>
                            <th>Jumlah Siswa</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guru as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;flex-shrink:0;">
                                            {{ strtoupper(substr($item->nama_guru, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:600;">{{ $item->nama_guru }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-soft-info">{{ $item->keahlian }}</span>
                                </td>
                                <td>
                                    <span class="badge-soft-secondary">{{ $item->siswas->count() ?? 0 }} siswa</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('guru.show', $item->id) }}" class="btn-sm-action btn-view" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(in_array(auth()->user()->role, ['admin', 'guru']))
                                            <a href="{{ route('guru.edit', $item->id) }}" class="btn-sm-action btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('guru.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
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
                                        <div class="empty-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                                        <h5>Belum ada data guru</h5>
                                        <p>
                                            @if(in_array(auth()->user()->role, ['admin', 'guru']))
                                                Mulai tambahkan data guru baru
                                            @else
                                                Belum ada data guru yang tersedia
                                            @endif
                                        </p>
                                        @if(in_array(auth()->user()->role, ['admin', 'guru']))
                                            <a href="{{ route('guru.create') }}" class="btn btn-accent mt-3">
                                                <i class="fas fa-plus"></i> Tambah Guru
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
