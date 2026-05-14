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
      <form class="mb-4">
        <div class="mb-3">
          <label class="form-label">Tanggal Bimbingan</label>
          <input type="date" class="form-control" required />
        </div>
        <div class="mb-3">
          <label class="form-label">Catatan Bimbingan</label>
          <textarea
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
        <li class="list-group-item">12/06/2025 - Diskusi bab 1 dan 2</li>
        <li class="list-group-item">19/06/2025 - Revisi metodologi</li>
      </ul>
      <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-success w-100">
          Kembali ke Dashboard
      </a>
    </div>
  </body>
</html>
