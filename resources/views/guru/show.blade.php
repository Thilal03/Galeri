@extends('layouts.admin')

@section('title', 'Detail Guru - ' . $guru->nama_guru)
@section('page-title', 'Detail Guru')
@section('breadcrumb', 'Admin Panel / Data Guru / Detail')

@section('content')
    <div class="row">
        {{-- Profile Card --}}
        <div class="col-lg-4 mb-4">
            <div class="card-premium animate-fade-in">
                <div class="card-body text-center" style="padding: 40px 24px;">
                    {{-- Avatar --}}
                    <div style="width:90px;height:90px;border-radius:20px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:36px;margin:0 auto 20px;box-shadow:0 8px 25px rgba(99,102,241,0.35);">
                        {{ strtoupper(substr($guru->nama_guru, 0, 1)) }}
                    </div>

                    <h4 style="font-weight:700;margin-bottom:6px;">{{ $guru->nama_guru }}</h4>
                    <span class="badge-soft-info" style="font-size:14px;padding:6px 16px;">{{ $guru->keahlian }}</span>

                    {{-- Stats --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:28px;">
                        <div style="background:var(--bg-secondary);border-radius:14px;padding:18px 12px;">
                            <div style="font-size:24px;font-weight:800;color:var(--primary);">{{ $guru->siswas->count() }}</div>
                            <div style="font-size:12px;color:var(--text-secondary);margin-top:4px;">Siswa Bimbingan</div>
                        </div>
                        <div style="background:var(--bg-secondary);border-radius:14px;padding:18px 12px;">
                            <div style="font-size:24px;font-weight:800;color:#22c55e;">Aktif</div>
                            <div style="font-size:12px;color:var(--text-secondary);margin-top:4px;">Status</div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-2 mt-4 justify-content-center">
                        @if(in_array(auth()->user()->role, ['admin', 'guru']))
                            <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-accent" style="flex:1;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                        <a href="{{ route('guru.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-weight:600;flex:1;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail & Siswa List --}}
        <div class="col-lg-8">
            {{-- Info Detail --}}
            <div class="card-premium animate-fade-in mb-4">
                <div class="card-header">
                    <span><i class="fas fa-info-circle me-2" style="color: var(--accent);"></i> Informasi Guru</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-user me-1"></i> Nama Lengkap
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $guru->nama_guru }}</div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-star me-1"></i> Keahlian / Bidang
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $guru->keahlian }}</div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-calendar me-1"></i> Terdaftar Sejak
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $guru->created_at->format('d F Y') }}</div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div style="font-size:12px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">
                                <i class="fas fa-clock me-1"></i> Terakhir Diperbarui
                            </div>
                            <div style="font-weight:600;font-size:15px;">{{ $guru->updated_at->format('d F Y, H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar Siswa Bimbingan --}}
            <div class="card-premium animate-fade-in">
                <div class="card-header">
                    <span><i class="fas fa-user-graduate me-2" style="color: var(--accent);"></i> Siswa Bimbingan</span>
                    <span class="badge-soft-info">{{ $guru->siswas->count() }} siswa</span>
                </div>
                <div class="card-body p-0">
                    @if($guru->siswas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-premium">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($guru->siswas as $index => $siswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#f59e0b,#f97316);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;flex-shrink:0;">
                                                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                                    </div>
                                                    <span style="font-weight:600;">{{ $siswa->nama_siswa }}</span>
                                                </div>
                                            </td>
                                            <td><span class="badge-soft-success">{{ $siswa->kelas }}</span></td>
                                            <td>
                                                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn-sm-action btn-view" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state" style="padding: 40px 20px;">
                            <div class="empty-icon" style="font-size:40px;"><i class="fas fa-user-graduate"></i></div>
                            <h6 style="margin-top:12px;">Belum ada siswa bimbingan</h6>
                            <p style="font-size:13px;">Guru ini belum memiliki siswa bimbingan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
