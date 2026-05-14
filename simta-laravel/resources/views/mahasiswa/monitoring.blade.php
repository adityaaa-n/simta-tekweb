<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monitoring TA</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background: #fce4ec;
      }
      .container {
        max-width: 700px;
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <div class="container bg-white p-4 rounded shadow">
      <h3 class="text-danger mb-4">Monitoring Tugas Akhir</h3>
      <ul class="list-group mb-4">
        <li class="list-group-item">
          Pengajuan TA: <strong>Disetujui</strong>
        </li>
        <li class="list-group-item">Bimbingan: <strong>4 pertemuan</strong></li>
        <li class="list-group-item">Seminar: <strong>28/06/2025</strong></li>
        <li class="list-group-item">
          Ujian TA: <strong>Belum Terdaftar</strong>
        </li>
        <li class="list-group-item">
          Dokumen Akhir: <strong>Belum Diunggah</strong>
        </li>
      </ul>
      <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-danger w-100">
          Kembali ke Dashboard
      </a>
    </div>
  </body>
</html>
