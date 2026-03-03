@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('page-title', 'Edit Siswa')
@section('breadcrumb', 'Admin Panel / Data Siswa / Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card-premium animate-fade-in">
                <div class="card-header">
                    <span><i class="fas fa-user-edit me-2" style="color: var(--accent);"></i> Edit Data Siswa</span>
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

                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama_siswa" class="form-label-premium">
                                <i class="fas fa-user me-1" style="color: var(--accent);"></i> Nama Siswa
                            </label>
                            <input type="text"
                                   class="form-control form-control-premium @error('nama_siswa') is-invalid @enderror"
                                   id="nama_siswa"
                                   name="nama_siswa"
                                   value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                                   placeholder="Masukkan nama lengkap siswa"
                                   required>
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kelas" class="form-label-premium">
                                <i class="fas fa-school me-1" style="color: var(--accent);"></i> Kelas
                            </label>
                            <input type="text"
                                   class="form-control form-control-premium @error('kelas') is-invalid @enderror"
                                   id="kelas"
                                   name="kelas"
                                   value="{{ old('kelas', $siswa->kelas) }}"
                                   placeholder="Contoh: X IPA 1, XI IPS 2"
                                   required>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="guru_id" class="form-label-premium">
                                <i class="fas fa-chalkboard-teacher me-1" style="color: var(--accent);"></i> Guru Pembimbing
                            </label>
                            <select class="form-select form-control-premium @error('guru_id') is-invalid @enderror"
                                    id="guru_id"
                                    name="guru_id"
                                    required>
                                <option value="" disabled>-- Pilih Guru Pembimbing --</option>
                                @foreach($guru as $g)
                                    <option value="{{ $g->id }}" {{ old('guru_id', $siswa->guru_id) == $g->id ? 'selected' : '' }}>
                                        {{ $g->nama_guru }} - {{ $g->keahlian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 pt-2">
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-save"></i> Perbarui Data
                            </button>
                            <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
