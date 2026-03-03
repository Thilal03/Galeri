@extends('layouts.admin')

@section('title', 'Lihat Galeri')
@section('page-title', 'Lihat Galeri')
@section('breadcrumb', 'Panel / Galeri Foto')

@section('content')
    {{-- Galeri Albums --}}
    @if($galeri->count() > 0)
        @foreach($galeri as $album)
            <div class="card-premium animate-fade-in mb-4" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                <div class="card-header" data-bs-toggle="collapse" data-bs-target="#album-{{ $album->id }}" aria-expanded="true" style="cursor:pointer;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="album-thumb">
                            @if($album->thumbnail)
                                <img src="{{ asset('storage/' . $album->thumbnail) }}" alt="{{ $album->judul }}">
                            @else
                                <i class="fas fa-images"></i>
                            @endif
                        </div>
                        <div>
                            <span style="font-weight:700;font-size:15px;">{{ $album->judul }}</span>
                            <div class="album-meta">
                                <i class="fas fa-images me-1"></i> {{ $album->detailGaleri->count() }} foto
                                <span class="mx-2">·</span>
                                <i class="fas fa-calendar me-1"></i> {{ $album->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down album-chevron"></i>
                </div>

                <div class="collapse show" id="album-{{ $album->id }}">
                    <div class="card-body">
                        @if($album->deskripsi)
                            <p class="album-desc">{{ $album->deskripsi }}</p>
                        @endif

                        @if($album->detailGaleri->count() > 0)
                            <div class="photo-grid">
                                @foreach($album->detailGaleri as $foto)
                                    <a href="{{ asset('storage/' . $foto->foto) }}" 
                                       data-lightbox="album-{{ $album->id }}" 
                                       data-title="{{ $foto->caption ?? $album->judul }}"
                                       class="photo-item">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" 
                                             alt="{{ $foto->caption ?? $album->judul }}">
                                        <div class="photo-hover">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                        @if($foto->caption)
                                            <div class="photo-caption">{{ $foto->caption }}</div>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4" style="color:var(--text-secondary);">
                                <i class="fas fa-image mb-2" style="font-size:28px;color:#cbd5e1;"></i>
                                <p class="mb-0">Album ini belum memiliki foto</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="card-premium animate-fade-in">
            <div class="card-body text-center py-5">
                <i class="fas fa-images mb-3" style="font-size:48px;color:#cbd5e1;"></i>
                <h5 style="font-weight:700;color:var(--text-primary);">Belum Ada Galeri</h5>
                <p style="color:var(--text-secondary);margin:0;">Galeri foto akan ditampilkan di sini</p>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .album-thumb {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        overflow: hidden;
        background: linear-gradient(135deg, #e2e8f0, #f1f5f9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 16px;
        flex-shrink: 0;
    }

    .album-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .album-meta {
        font-size: 12px;
        color: var(--text-secondary);
        margin-top: 2px;
    }

    .album-chevron {
        font-size: 12px;
        color: var(--text-secondary);
        transition: transform 0.3s ease;
    }

    [aria-expanded="false"] .album-chevron {
        transform: rotate(-90deg);
    }

    .album-desc {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0 0 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    /* Photo Grid */
    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
    }

    .photo-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        height: 180px;
        display: block;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .photo-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .photo-item:hover img {
        transform: scale(1.06);
    }

    .photo-hover {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .photo-item:hover .photo-hover {
        opacity: 1;
    }

    .photo-hover i {
        color: #fff;
        font-size: 26px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .photo-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 8px 12px;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: #fff;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .photo-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 8px;
        }
        .photo-item {
            height: 130px;
        }
    }
</style>
@endpush
