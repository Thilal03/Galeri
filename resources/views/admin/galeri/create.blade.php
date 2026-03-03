@extends('layouts.admin')

@section('title', 'Tambah Galeri')
@section('page-title', 'Tambah Galeri')
@section('breadcrumb', 'Admin Panel / Galeri / Tambah')

@push('styles')
<style>
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    .preview-item {
        position: relative;
        width: 150px;
    }
    .preview-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
    }
    .preview-item .remove-btn {
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
    }
</style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-premium animate-fade-in">
                <div class="card-header">
                    <span><i class="fas fa-plus-circle me-2" style="color: var(--accent);"></i> Tambah Galeri Baru</span>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;font-size:13px;">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
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

                    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="judul" class="form-label-premium">Judul Galeri <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-premium @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Slug akan dibuat otomatis dari judul</small>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label-premium">Deskripsi</label>
                            <textarea class="form-control form-control-premium @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="fotos" class="form-label-premium">Upload Foto <span class="text-danger">*</span></label>
                            <input type="file" class="form-control form-control-premium @error('fotos.*') is-invalid @enderror" id="fotos" name="fotos[]" multiple accept="image/*" required onchange="previewImages(event)">
                            @error('fotos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Pilih satu atau lebih foto (Format: JPG, PNG, GIF. Max: 2MB per foto)</small>
                            <div id="preview-container" class="preview-container"></div>
                        </div>

                        <div id="captions-container"></div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktifkan galeri</label>
                        </div>

                        <div class="d-flex gap-3 pt-2">
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-save"></i> Simpan Galeri
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
    let selectedFiles = [];

    function previewImages(event) {
        const files = Array.from(event.target.files);
        selectedFiles = files;
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
                <label class="form-label-premium">Caption Foto ${index + 1} (Opsional)</label>
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
