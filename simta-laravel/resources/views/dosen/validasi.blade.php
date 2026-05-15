@extends('layouts.app')

@section('title', 'Validasi Bimbingan')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <div class="p-4 bg-white rounded-4 shadow-sm border-start border-success border-5 d-flex justify-content-between align-items-center">
            <div class="text-start">
                <h3 class="fw-bold m-0">Validasi Log Bimbingan</h3>
                <p class="text-muted m-0">Validasi progres bimbingan rutin mahasiswa.</p>
            </div>
            <a href="{{ route('dosen.dashboard') }}" class="btn btn-light btn-sm rounded-pill px-4 border shadow-sm fw-bold">
                <i class="fas fa-chevron-left me-2 text-muted"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light small text-uppercase fw-bold text-muted text-center">
                <tr>
                    <th class="py-3 text-start ps-4">Mahasiswa</th>
                    <th class="py-3">Tanggal</th>
                    <th class="py-3">Catatan</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    @php $is_valid = ($log['status_validasi'] ?? '') === 'divalidasi'; @endphp
                    <tr>
                        <td class="text-start ps-4">
                            <div class="fw-bold text-dark fs-6">{{ $log['nama_mhs'] ?? 'Nama Mahasiswa' }}</div>
                            <div class="small text-muted mb-1">NIM: {{ $log['nim_nip'] ?? '-' }}</div>
                            <small class="text-secondary fst-italic">{{ \Illuminate\Support\Str::limit($log['judul'] ?? 'Judul Proposal', 40) }}</small>
                        </td>
                        <td class="text-center fw-bold text-primary">{{ \Carbon\Carbon::parse($log['tanggal'])->format('d M Y') }}</td>
                        <td>{{ $log['catatan'] }}</td>
                        <td class="text-center">
                            @if($is_valid)
                                <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2 border border-success border-opacity-25">Divalidasi</span>
                            @else
                                <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-3 py-2 border border-warning border-opacity-25">Menunggu</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$is_valid)
                                <button type="button" class="btn btn-success btn-sm px-4 rounded-pill btn-validate fw-bold shadow-sm" data-id="{{ $log['id'] }}">
                                    Validasi
                                </button>
                                <form id="form-validate-{{ $log['id'] }}" action="{{ route('dosen.acc_bimbingan', $log['id']) }}" method="POST" class="d-none">@csrf</form>
                            @else
                                <span class="text-muted small fw-bold"><i class="fas fa-check-double me-1"></i> Tervalidasi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada log bimbingan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-validate').forEach(btn => {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Validasi Log?',
                text: "Pastikan bimbingan benar-benar telah dilaksanakan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ya, Validasi!',
                cancelButtonText: 'Batal'
            }).then((res) => { if (res.isConfirmed) document.getElementById('form-validate-' + this.dataset.id).submit(); });
        });
    });
});
</script>
@endsection