@extends('layouts.app')

@section('title', 'Validasi Bimbingan')

@section('content')
<div class="bg-white p-4 rounded shadow mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark m-0">Validasi Log Bimbingan</h3>
        <a href="{{ route('dosen.dashboard') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th>Tanggal Bimbingan</th>
                    <th>Catatan Pembahasan</th>
                    <th>Status Validasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="align-middle">
                        <td class="text-center">{{ \Carbon\Carbon::parse($log['tanggal'])->format('d M Y') }}</td>
                        <td>{{ $log['catatan'] }}</td>
                        <td class="text-center">
                            @if($log['status_validasi'] === 'divalidasi')
                                <span class="badge bg-success">Sudah Divalidasi</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum Divalidasi</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($log['status_validasi'] !== 'divalidasi')
                                <form action="{{ route('dosen.acc_bimbingan', $log['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm">Validasi Sekarang</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>Selesai</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada catatan bimbingan dari mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection