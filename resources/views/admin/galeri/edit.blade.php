@extends('layouts.admin')

@section('title', 'Edit Galeri')
@section('page-title', 'Edit Galeri')
@section('breadcrumb', 'Admin Panel / Galeri / Edit')

@push('styles')
<style>
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
    .preview-item, .existing-photo {
        position: relative;
        width: 150px;
        display: inline-block;
        margin-bottom: 5px;
    }
    .preview-item img, .existing-photo img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
    }
    .preview-item .remove-btn, .existing-photo .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: var(--danger);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        z-index: 10;
    }
    .preview-item .remove-btn:hover, .existing-photo .remove-btn:hover {
        background: var(--danger);
        opacity: 0.8;
    }
</style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-premium animate-fade-in">
                <div class="card-header">
                    <span><i class="fas fa-edit me-2" style="color: var(--accent);"></i> Edit Galeri</span>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;font-size:13px;">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-premium alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-premium alert-danger mb-4">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- Existing photos section - OUTSIDE the main form to avoid nested forms --}}
                    <div class="mb-4">
                        <label class="form-label-premium">Foto yang Sudah Ada</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($galeri->detailGaleri as $detail)
                                <div class="existing-photo" id="photo-{{ $detail->id }}">
                                    <img src="{{ asset('storage/' . $detail->foto) }}" alt="{{ $detail->caption }}">
                                    <form action="{{ route('admin.galeri.photo.delete', $detail->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @if($detail->caption)
                                        <p class="text-center small mt-1 mb-0">{{ $detail->caption }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Main update form - no nested forms inside --}}
                    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="judul" class="form-label-premium">Judul Galeri <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-premium @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $galeri->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label-premium">Deskripsi</label>
                            <textarea class="form-control form-control-premium @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="fotos" class="form-label-premium">Tambah Foto Baru (Opsional)</label>
                            <input type="file" class="form-control form-control-premium @error('fotos.*') is-invalid @enderror" id="fotos" name="fotos[]" multiple accept="image/*" onchange="previewImages(event)">
                            @error('fotos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Pilih satu atau lebih foto untuk ditambahkan</small>
                            <div id="preview-container" class="preview-container"></div>
                        </div>

                        <div id="captions-container"></div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $galeri->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktifkan galeri</label>
                        </div>

                        <div class="d-flex gap-3 pt-2">
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-save"></i> Update Galeri
                            </button>
                            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function previewImages(event) {
        const files = Array.from(event.target.files);
        const previewContainer = document.getElementById('preview-container');
        const captionsContainer = document.getElementById('captions-container');

        previewContainer.innerHTML = '';
        captionsContainer.innerHTML = '';

        files.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}">
                    <button type="button" class="remove-btn" onclick="removeImage(${index})">&times;</button>
                `;
                previewContainer.appendChild(previewItem);
            };

            reader.readAsDataURL(file);

            const captionDiv = document.createElement('div');
            captionDiv.className = 'mb-3';
            captionDiv.innerHTML = `
                <label class="form-label-premium">Caption Foto Baru ${index + 1} (Opsional)</label>
                <input type="text" class="form-control form-control-premium" name="captions[]" placeholder="Masukkan caption untuk foto ${index + 1}">
            `;
            captionsContainer.appendChild(captionDiv);
        });
    }

    function removeImage(index) {
        const dt = new DataTransfer();
        const input = document.getElementById('fotos');
        const files = Array.from(input.files);

        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });

        input.files = dt.files;
        previewImages({ target: input });
    }
</script>
@endpush
