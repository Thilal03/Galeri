@extends('layouts.admin')

@section('title', 'Manajemen Galeri')
@section('page-title', 'Manajemen Galeri')
@section('breadcrumb', 'Admin Panel / Galeri')

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
            <p class="text-muted mb-0" style="font-size: 14px;">Kelola galeri foto</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-accent">
            <i class="fas fa-plus"></i> Tambah Galeri
        </a>
    </div>

    {{-- Table Card --}}
    <div class="card-premium">
        <div class="card-header">
            <span><i class="fas fa-images me-2" style="color: var(--accent);"></i> Daftar Galeri</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Thumbnail</th>
                            <th>Judul</th>
                            <th>Slug</th>
                            <th>Jumlah Foto</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galeri as $index => $item)
                            <tr>
                                <td>{{ $galeri->firstItem() + $index }}</td>
                                <td>
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                             alt="{{ $item->judul }}"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:10px;">
                                    @else
                                        <div style="width:60px;height:60px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td style="font-weight:600;">{{ $item->judul }}</td>
                                <td><code style="font-size:12px;background:#f1f5f9;padding:4px 8px;border-radius:6px;">{{ $item->slug }}</code></td>
                                <td>
                                    <span class="badge-soft-info">{{ $item->detailGaleri->count() }} foto</span>
                                </td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge-soft-success">Aktif</span>
                                    @else
                                        <span class="badge-soft-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td style="font-size:13px;color:var(--text-secondary);">{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.galeri.show', $item->id) }}" class="btn-sm-action btn-view" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn-sm-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm-action btn-delete" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-icon"><i class="fas fa-images"></i></div>
                                        <h5>Belum ada data galeri</h5>
                                        <p>Mulai tambahkan galeri foto baru</p>
                                        <a href="{{ route('admin.galeri.create') }}" class="btn btn-accent mt-3">
                                            <i class="fas fa-plus"></i> Tambah Galeri
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($galeri->hasPages())
                <div class="p-3 border-top">
                    {{ $galeri->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
