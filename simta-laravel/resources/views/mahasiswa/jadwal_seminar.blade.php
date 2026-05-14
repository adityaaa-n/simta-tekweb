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
          <tr>
            <td>28/06/2025</td>
            <td>10.00 - 11.30</td>
            <td>Lab 1</td>
            <td><span class="badge bg-success">Terverifikasi</span></td>
          </tr>
        </tbody>
      </table>
      <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-success w-100">
          Kembali ke Dashboard
      </a>
    </div>
  </body>
</html>
