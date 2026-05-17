@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="p-5 mb-4 bg-white rounded-4 shadow-sm border-0 position-relative overflow-hidden">
            <div style="position: relative; z-index: 2;">
                <h2 class="display-6 fw-bold mb-1">Selamat Datang, {{ session('user.name', 'Dosen Pembimbing') }}!</h2>
                
                <p class="text-secondary fw-semibold mb-3">
                    <i class="fas fa-envelope me-2"></i>{{ session('user.email', 'dosen@unjani.ac.id') }}
                </p>
                
                <p class="col-md-8 fs-5 text-muted mt-2">Pantau dan kelola progres Tugas Akhir mahasiswa Anda secara real-time melalui panel kendali ini.</p>
            </div>
            <div style="position: absolute; right: -50px; bottom: -50px; opacity: 0.1;">
                <i class="fas fa-user-tie fa-10x"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-primary border-5">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-3">
                    <i class="fas fa-file-signature text-primary fa-2x"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Proposal Baru</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['proposal_baru'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-success border-5">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded-3">
                    <i class="fas fa-users text-success fa-2x"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Mahasiswa Bimbingan</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['mahasiswa_bimbingan'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-warning border-5">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded-3">
                    <i class="fas fa-calendar-check text-warning fa-2x"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Jadwal Sidang</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['jadwal_sidang'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-md-4">
        <a href="{{ route('dosen.review') }}" class="text-decoration-none card h-100 border-0 shadow-sm rounded-4 hover-effect p-4">
            <div class="text-center">
                <i class="fas fa-clipboard-list fa-3x text-info mb-3"></i>
                <h5 class="fw-bold text-dark">Review Proposal</h5>
                <p class="text-muted small">Cek dan beri persetujuan pada usulan judul mahasiswa.</p>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('dosen.validasi') }}" class="text-decoration-none card h-100 border-0 shadow-sm rounded-4 hover-effect p-4">
            <div class="text-center">
                <i class="fas fa-tasks fa-3x text-success mb-3"></i>
                <h5 class="fw-bold text-dark">Validasi Bimbingan</h5>
                <p class="text-muted small">Validasi log bimbingan rutin mahasiswa bimbingan.</p>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('dosen.mahasiswa') }}" class="text-decoration-none card h-100 border-0 shadow-sm rounded-4 hover-effect p-4">
            <div class="text-center">
                <i class="fas fa-graduation-cap fa-3x text-danger mb-3"></i>
                <h5 class="fw-bold text-dark">Penilaian TA</h5>
                <p class="text-muted small">Input nilai akhir dan revisi untuk mahasiswa sidang.</p>
            </div>
        </a>
    </div>
</div>

<style>
    .hover-effect { transition: all 0.3s ease; }
    .hover-effect:hover { transform: translateY(-10px); background-color: #fcfcfc; }
</style>
@endsection