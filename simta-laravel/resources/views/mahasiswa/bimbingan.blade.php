<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log Bimbingan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
        background: #f0fdf4;
      }
      .container {
        max-width: 700px;
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <div class="container bg-white p-4 rounded shadow">
      <h3 class="text-success">Log Bimbingan</h3>
      <form action="{{ route('mahasiswa.bimbingan.store') }}" method="POST" id="formBimbingan" class="mb-4">
        @csrf
        <div class="mb-3">
          <label class="form-label">Tanggal Bimbingan</label>
          <input type="date" name="tanggal" class="form-control" required />
        </div>
        <div class="mb-3">
          <label class="form-label">Catatan Bimbingan</label>
          <textarea
            name="catatan"
            class="form-control"
            rows="3"
            placeholder="Tuliskan hasil diskusi..."
            required
          ></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-2">Simpan Log</button>
      </form>
      <h5 class="mt-4">Riwayat Bimbingan</h5>
      <ul class="list-group mb-4">
        @forelse($bimbingans as $log)
          <li class="list-group-item">{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }} - {{ $log->catatan }}</li>
        @empty
          <li class="list-group-item text-muted">Belum ada riwayat bimbingan.</li>
        @endforelse
      </ul>
      <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-success w-100">
          Kembali ke Dashboard
      </a>
      </a>
    </div>

    @if(session('success'))
    <script>
      Swal.fire({
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    </script>
    @endif

    <script>
      document.getElementById('formBimbingan').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin menyimpan log bimbingan ini?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#198754',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Simpan!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    </script>
  </body>
</html>
