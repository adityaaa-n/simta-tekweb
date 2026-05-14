<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengajuan Tugas Akhir</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background: linear-gradient(to right, #e3f2fd, #f1f8e9);
      }
      .card {
        max-width: 600px;
        margin: auto;
        padding: 30px;
        margin-top: 50px;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body>
    <div class="card">
      <h3 class="mb-4 text-success">Form Pengajuan Tugas Akhir</h3>
      <form>
        <div class="mb-3">
          <label class="form-label">Judul Tugas Akhir</label>
          <input
            type="text"
            class="form-control"
            placeholder="Masukkan judul..."
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi Singkat</label>
          <textarea
            class="form-control"
            rows="4"
            placeholder="Deskripsikan rencana tugas akhir Anda..."
            required
          ></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Dosen Pembimbing</label>
          <select class="form-select" required>
            <option selected disabled>Pilih Dosen</option>
            <option>Dosen A</option>
            <option>Dosen B</option>
          </select>
        </div>
        <button type="submit" class="btn btn-success w-100 mb-2">Ajukan</button>
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-success w-100">Kembali ke Dashboard</a>
      </form>
    </div>
  </body>
</html>
