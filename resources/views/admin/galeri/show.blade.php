@extends('layouts.admin')

@section('title', 'Detail Galeri')
@section('page-title', 'Detail Galeri')
@section('breadcrumb', 'Admin Panel / Galeri / Detail')

@push('styles')
<style>
    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 16px;
    }
    .photo-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .photo-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
        cursor: pointer;
    }
    .photo-item:hover img {
        transform: scale(1.05);
    }
    .photo-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        color: white;
        padding: 10px;
        font-size: 13px;
    }
</style>
@endpush

@section('content')
    <div class="card-premium animate-fade-in">
        <div class="card-header">
            <span><i class="fas fa-eye me-2" style="color: var(--accent);"></i> Detail Galeri</span>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="btn-sm-action btn-edit" title="Edit" style="width:auto;padding:6px 14px;">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;font-size:13px;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4 style="font-weight:700;">{{ $galeri->judul }}</h4>
                    <p class="text-muted" style="font-size:13px;">
                        <i class="fas fa-link me-1"></i> Slug: <code style="background:#f1f5f9;padding:3px 8px;border-radius:6px;">{{ $galeri->slug }}</code>
                    </p>
                    @if($galeri->deskripsi)
                        <p>{{ $galeri->deskripsi }}</p>
                    @endif
                </div>
                <div class="col-md-6 text-end">
                    <div class="mb-2">
                        <strong>Status:</strong>
                        @if($galeri->is_active)
                            <span class="badge-soft-success">Aktif</span>
                        @else
                            <span class="badge-soft-secondary">Tidak Aktif</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <strong>Jumlah Foto:</strong>
                        <span class="badge-soft-info">{{ $galeri->detailGaleri->count() }} foto</span>
                    </div>
                    <p class="text-muted" style="font-size:12px;">
                        Dibuat: {{ $galeri->created_at->format('d M Y H:i') }}<br>
                        Diupdate: {{ $galeri->updated_at->format('d M Y H:i') }}
                    </p>
                </div>
            </div>

            <hr style="border-color:var(--border-color);">

            <h5 style="font-weight:700;" class="mb-3">
                <i class="fas fa-images me-2" style="color: var(--accent);"></i> Foto-foto dalam Galeri
            </h5>

            @if($galeri->detailGaleri->count() > 0)
                <div class="photo-grid">
                    @foreach($galeri->detailGaleri as $detail)
                        <div class="photo-item">
                            <img src="{{ asset('storage/' . $detail->foto) }}"
                                 alt="{{ $detail->caption ?? $galeri->judul }}"
                                 data-bs-toggle="modal"
                                 data-bs-target="#photoModal{{ $detail->id }}">
                            @if($detail->caption)
                                <div class="photo-caption">{{ $detail->caption }}</div>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="photoModal{{ $detail->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content" style="border-radius:16px;overflow:hidden;">
                                    <div class="modal-header" style="border-bottom:1px solid var(--border-color);">
                                        <h5 class="modal-title" style="font-weight:600;">{{ $detail->caption ?? $galeri->judul }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center p-0">
                                        <img src="{{ asset('storage/' . $detail->foto) }}"
                                             alt="{{ $detail->caption ?? $galeri->judul }}"
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-images"></i></div>
                    <h5>Belum ada foto dalam galeri ini</h5>
                    <p>Tambahkan foto melalui halaman edit</p>
                </div>
            @endif
        </div>
    </div>
@endsection
