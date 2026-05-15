@extends('layouts.app')

@section('title', 'Review Proposal')

@section('content')
<div class="bg-white p-4 rounded-4 shadow-sm mt-4 border-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary fw-bold m-0">Review Proposal Mahasiswa</h3>
        <a href="{{ route('dosen.dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-center small text-uppercase fw-bold">
                <tr>
                    <th class="py-3 text-start ps-4">Mahasiswa</th>
                    <th class="py-3">Judul Proposal</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">File</th>
                    <th class="py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proposals as $p)
                    <tr>
                        <td class="text-start ps-4">
                            <div class="fw-bold text-dark fs-6">{{ $p['nama_mhs'] ?? 'Nama Tidak Ditemukan' }}</div>
                            <span class="badge bg-secondary text-light mt-1 small">NIM: {{ $p['nim_nip'] ?? $p['mhs_id'] }}</span>
                        </td>
                        
                        <td>
                            <div class="fw-bold text-dark">{{ $p['judul'] }}</div>
                        </td>
                        
                        <td class="text-center">
                            @php
                                $status = strtoupper($p['status']);
                                $badgeClass = 'bg-secondary';
                                if($status == 'APPROVED_DSN') $badgeClass = 'bg-success';
                                elseif($status == 'REJECTED') $badgeClass = 'bg-danger';
                                elseif($status == 'APPROVED_KOOR') $badgeClass = 'bg-info text-dark';
                            @endphp
                            <span class="badge rounded-pill {{ $badgeClass }} px-3 py-2">
                                {{ $status == 'APPROVED_DSN' ? 'DISETUJUI' : ($status == 'REJECTED' ? 'DITOLAK' : $status) }}
                            </span>
                        </td>

                        <td class="text-center">
                            @php
                                // 1. Ambil path dari DB
                                $rawPath = $p['file_path'] ?? '';
                                
                                // 2. Ekstrak hanya nama filenya saja (misal dari /uploads/documents/123.pdf menjadi 123.pdf)
                                $fileName = basename($rawPath);
                                
                                // 3. Jika di database masih kosong (NULL), gunakan file dummy yang ada di komputermu
                                if (empty($fileName)) {
                                    $fileName = '1778393805626.pdf';
                                }
                            @endphp

                            <a href="http://localhost:5000/api/download/{{ $fileName }}" target="_blank" class="btn btn-outline-primary btn-sm px-3 rounded-pill fw-bold">
                                <i class="fas fa-download me-1"></i> Unduh
                            </a>
                        </td>

                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm px-3 rounded-pill btn-approve fw-bold" data-id="{{ $p['id'] }}">
                                <i class="fas fa-check me-1"></i> Setujui
                            </button>
                            <button type="button" class="btn btn-danger btn-sm px-3 rounded-pill btn-reject fw-bold" data-id="{{ $p['id'] }}">
                                <i class="fas fa-times me-1"></i> Tolak
                            </button>

                            <form id="form-approve-{{ $p['id'] }}" action="{{ route('dosen.update_proposal', $p['id']) }}" method="POST" class="d-none">
                                @csrf <input type="hidden" name="status" value="approved_dsn">
                            </form>
                            <form id="form-reject-{{ $p['id'] }}" action="{{ route('dosen.update_proposal', $p['id']) }}" method="POST" class="d-none">
                                @csrf <input type="hidden" name="status" value="rejected">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted small">Belum ada proposal masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-approve').forEach(btn => {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Setujui Proposal?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal'
            }).then((res) => { if (res.isConfirmed) document.getElementById('form-approve-' + this.dataset.id).submit(); });
        });
    });

    document.querySelectorAll('.btn-reject').forEach(btn => {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Tolak Proposal?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal'
            }).then((res) => { if (res.isConfirmed) document.getElementById('form-reject-' + this.dataset.id).submit(); });
        });
    });
});
</script>
@endsection