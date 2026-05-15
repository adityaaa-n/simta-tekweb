@extends('layouts.app')

@section('title', 'Input Penilaian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 border-top border-success border-5">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h4 class="fw-bold text-success m-0"><i class="fas fa-edit me-2"></i>Penilaian Tugas Akhir</h4>
                <a href="{{ route('dosen.dashboard') }}" class="btn btn-sm rounded-pill px-3 fw-bold text-muted hover-bg-light transition-all border">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
            </div>

            <form id="form-grading" action="{{ route('dosen.submit_nilai') }}" method="POST">
                @csrf
                <input type="hidden" name="proposal_id" value="{{ $proposal_id }}">

                <div class="mb-4">
                    <label class="form-label small text-muted text-uppercase fw-bold">Mahasiswa</label>
                    <div class="h5 fw-bold text-dark">{{ $nama_mahasiswa }}</div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small text-muted text-uppercase fw-bold">Nilai Seminar</label>
                        <input type="number" name="nilai_seminar" id="v_seminar" class="form-control form-control-lg border-2" placeholder="0-100" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted text-uppercase fw-bold">Nilai Ujian Akhir</label>
                        <input type="number" name="nilai_ujian" id="v_ujian" class="form-control form-control-lg border-2" placeholder="0-100" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small text-muted text-uppercase fw-bold">Komentar/Revisi</label>
                    <textarea name="komentar" class="form-control border-2" rows="4" placeholder="Berikan catatan perbaikan..." required></textarea>
                </div>

                <button type="button" id="btn-submit-grade" class="btn btn-success btn-lg w-100 rounded-pill fw-bold shadow-sm py-3 mt-2">
                    <i class="fas fa-save me-2"></i> Simpan & Finalisasi Nilai
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .hover-bg-light:hover { background-color: #fff5f5; color: #dc3545 !important; border-color: #dc3545 !important; }
</style>

<script>
document.getElementById('btn-submit-grade').addEventListener('click', function() {
    const sem = document.getElementById('v_seminar').value;
    const uji = document.getElementById('v_ujian').value;

    if(!sem || !uji) {
        Swal.fire('Error', 'Input nilai belum lengkap!', 'error');
        return;
    }

    Swal.fire({
        title: 'Kirim Nilai?',
        text: "Nilai yang sudah disimpan tidak dapat diubah secara mandiri.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Cek Kembali'
    }).then((res) => { if (res.isConfirmed) document.getElementById('form-grading').submit(); });
});
</script>
@endsection