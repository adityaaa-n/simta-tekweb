@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')
<style>
    .card-menu {
        border-radius: 1rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        background: white;
        text-align: center;
        padding: 30px 20px;
        text-decoration: none;
        display: block;
        color: inherit;
    }
    .card-menu:hover {
        transform: scale(1.02);
        background-color: #f8f9fa;
        color: inherit;
    }
    .card-menu i {
        font-size: 2.5rem;
        color: #4e54c8;
        margin-bottom: 10px;
    }
    .card-menu h5 {
        margin-top: 10px;
        font-weight: bold;
        color: #343a40;
    }
</style>

<div class="text-center mb-5 mt-4">
    <h4>Selamat datang, <strong>Dosen Pembimbing/Penguji</strong> 👋</h4>
    <p class="text-muted">
        Kelola tugas akhir mahasiswa bimbingan Anda melalui menu di bawah ini.
    </p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <a href="{{ route('dosen.review') }}" class="card-menu">
            <i class="fas fa-file-alt"></i>
            <h5>Review Proposal</h5>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('dosen.validasi') }}" class="card-menu">
            <i class="fas fa-check-circle"></i>
            <h5>Validasi Bimbingan</h5>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('dosen.penilaian') }}" class="card-menu">
            <i class="fas fa-star"></i>
            <h5>Penilaian TA</h5>
        </a>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
@endsection