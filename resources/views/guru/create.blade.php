@extends('layouts.admin')

@section('title', 'Tambah Guru')
@section('page-title', 'Tambah Guru')
@section('breadcrumb', 'Admin Panel / Data Guru / Tambah')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card-premium animate-fade-in">
                <div class="card-header">
                    <span><i class="fas fa-user-plus me-2" style="color: var(--accent);"></i> Form Tambah Guru</span>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-premium alert-danger mb-4">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>
                                <strong>Terjadi Kesalahan!</strong>
                                <ul class="mb-0 mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama_guru" class="form-label-premium">
                                <i class="fas fa-user me-1" style="color: var(--accent);"></i> Nama Guru
                            </label>
                            <input type="text"
                                   class="form-control form-control-premium @error('nama_guru') is-invalid @enderror"
                                   id="nama_guru"
                                   name="nama_guru"
                                   value="{{ old('nama_guru') }}"
                                   placeholder="Masukkan nama lengkap guru"
                                   required>
                            @error('nama_guru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keahlian" class="form-label-premium">
                                <i class="fas fa-star me-1" style="color: var(--accent);"></i> Keahlian
                            </label>
                            <input type="text"
                                   class="form-control form-control-premium @error('keahlian') is-invalid @enderror"
                                   id="keahlian"
                                   name="keahlian"
                                   value="{{ old('keahlian') }}"
                                   placeholder="Contoh: Matematika, Bahasa Inggris, Fisika"
                                   required>
                            @error('keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 pt-2">
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                            <a href="{{ route('guru.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
