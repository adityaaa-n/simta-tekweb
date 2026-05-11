@extends('layouts.app')

@section('title', 'Review Proposal')

@section('content')
<div class="bg-white p-4 rounded shadow mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary m-0">Review Proposal Mahasiswa</h3>
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
            <thead class="table-primary text-center">
                <tr>
                    <th>ID Mahasiswa</th>
                    <th>Judul Proposal</th>
                    <th>Status Saat Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proposals as $p)
                    <tr class="align-middle">
                        <td class="text-center">{{ $p['mhs_id'] }}</td>
                        <td>
                            <strong>{{ $p['judul'] }}</strong><br>
                            <small class="text-muted">{{ $p['deskripsi'] }}</small>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $p['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('dosen.update_proposal', $p['id']) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="approved_koor">
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin setujui proposal ini?')">Setujui</button>
                            </form>

                            <form action="{{ route('dosen.update_proposal', $p['id']) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin tolak proposal ini?')">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada proposal masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection