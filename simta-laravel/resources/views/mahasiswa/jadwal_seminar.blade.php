<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jadwal Seminar</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background-color: #e8f5e9;
      }
      .container {
        max-width: 800px;
        margin-top: 40px;
      }
    </style>
  </head>
  <body>
    <div class="container bg-white p-4 rounded shadow">
      <h3 class="text-success mb-4">Jadwal Seminar Tugas Akhir</h3>
      <table class="table table-bordered mb-4">
        <thead class="table-success">
          <tr>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Ruang</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($seminars as $seminar)
          <tr>
            <td>{{ \Carbon\Carbon::parse($seminar->tanggal)->format('d/m/Y') }}</td>
            <td>{{ $seminar->waktu }}</td>
            <td>{{ $seminar->ruang }}</td>
            <td>
              @if(strtolower($seminar->status) == 'disetujui' || strtolower($seminar->status) == 'terverifikasi')
                <span class="badge bg-success">{{ ucfirst($seminar->status) }}</span>
              @elseif(strtolower($seminar->status) == 'ditolak')
                <span class="badge bg-danger">{{ ucfirst($seminar->status) }}</span>
              @else
                <span class="badge bg-warning text-dark">{{ ucfirst($seminar->status) }}</span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center text-muted">Belum ada jadwal seminar.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-success w-100">
          Kembali ke Dashboard
      </a>
    </div>
  </body>
</html>
