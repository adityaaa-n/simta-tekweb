@extends('layouts.app')

@section('title', 'Penilaian Tugas Akhir')

@section('content')
<div class="container bg-white p-4 rounded shadow mt-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-success m-0">Form Penilaian Tugas Akhir</h3>
        <a href="{{ route('dosen.dashboard') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('dosen.submit_nilai') }}" method="POST">
        @csrf
        <input type="hidden" name="proposal_id" value="{{ $proposal_id }}">

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Mahasiswa</label>
            <input type="text" class="form-control bg-light" value="{{ $nama_mahasiswa }}" disabled readonly />
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nilai Seminar</label>
                <input type="number" name="nilai_seminar" class="form-control" placeholder="0 - 100" min="0" max="100" required />
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nilai Ujian</label>
                <input type="number" name="nilai_ujian" class="form-control" placeholder="0 - 100" min="0" max="100" required />
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Komentar / Revisi</label>
            <textarea name="komentar" class="form-control" rows="4" placeholder="Tuliskan catatan revisi atau feedback untuk mahasiswa..." required></textarea>
        </div>
        
        <div class="text-start mt-4">
            <button type="submit" class="btn btn-success fw-bold px-4">
                Simpan Nilai
            </button>
        </div>
    </form>
</div>
@endsection