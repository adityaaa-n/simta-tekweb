@extends('layouts.app')

@section('title', 'Daftar Bimbingan')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <div class="p-4 bg-white rounded-4 shadow-sm border-start border-danger border-5 d-flex justify-content-between align-items-center">
            <div class="text-start">
                <h3 class="fw-bold m-0">Penilaian Tugas Akhir</h3>
                <p class="text-muted m-0">Pilih mahasiswa yang sudah sidang untuk diberikan nilai akhir.</p>
            </div>
            <a href="{{ route('dosen.dashboard') }}" class="btn btn-light btn-sm rounded-pill px-4 border shadow-sm fw-bold">
                <i class="fas fa-chevron-left me-2 text-muted"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="bg-white p-4 rounded-4 shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 text-center">
            <thead class="bg-light small text-uppercase fw-bold text-muted">
                <tr>
                    <th class="py-3">ID Proposal</th>
                    <th class="py-3">MHS ID</th>
                    <th class="py-3">Judul Tugas Akhir</th>
                    <th class="py-3">Aksi Penilaian</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $m)
                    <tr>
                        <td class="fw-bold text-danger">PRP-{{ $m['id'] }}</td>
                        <td>{{ $m['mhs_id'] }}</td>
                        <td class="text-start">
                            <div class="fw-bold text-dark">{{ $m['judul'] }}</div>
                        </td>
                        <td>
                            @if(isset($m['grade_id']) && $m['grade_id'] != null)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill">
                                    <i class="fas fa-check-circle me-1"></i> Sudah Dinilai
                                </span>
                            @else
                                <a href="{{ route('dosen.penilaian', $m['id']) }}" class="btn btn-danger btn-sm px-4 rounded-pill fw-bold shadow-sm">
                                    <i class="fas fa-edit me-1"></i> Beri Nilai
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-5 text-muted small text-center">Belum ada mahasiswa bimbingan yang disetujui.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection