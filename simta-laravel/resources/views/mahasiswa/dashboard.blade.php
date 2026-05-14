<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMTA - Dashboard Mahasiswa</title>
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
        background: linear-gradient(to right, #e3f2fd, #f1f8e9);
        font-family: "Segoe UI", sans-serif;
      }
      .header {
        background-color: #198754;
        padding: 20px;
        color: white;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
      .header h2 {
        margin: 0;
      }
      .header .logout-btn {
        float: right;
        color: white;
        text-decoration: none;
      }
      .dashboard {
        margin-top: 40px;
      }
      .card {
        border: none;
        border-radius: 1rem;
        background: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        padding: 30px 20px;
        text-align: center;
      }
      .card:hover {
        transform: translateY(-5px);
        background-color: #f8f9fa;
      }
      .card i {
        font-size: 2.5rem;
        color: #198754;
        margin-bottom: 10px;
      }
      .card h5 {
        font-weight: bold;
        margin-top: 10px;
        color: #343a40;
      }
      a.text-decoration-none:hover {
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="header d-flex justify-content-between align-items-center px-4">
      <h2><i class="fas fa-user-graduate"></i> SIMTA - Mahasiswa</h2>
      
      <!-- Tombol Logout disesuaikan agar berfungsi di Laravel -->
      <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </div>

    <div class="container dashboard">
      <div class="text-center mb-5">
        <!-- Nama user disesuaikan agar dinamis mengambil dari database Laravel, atau default ke 'Nabil' -->
        <h4>Selamat datang, <strong>{{ Auth::check() ? Auth::user()->name : 'Nabil' }}</strong> 👋</h4>
        <p class="text-muted">
          Silakan pilih menu yang tersedia untuk melanjutkan tugas akhir Anda.
        </p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <a href="{{ route('mahasiswa.pengajuan') }}" class="text-decoration-none">
            <div class="card">
              <i class="fas fa-upload"></i>
              <h5>Pengajuan Tugas Akhir</h5>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="{{ route('mahasiswa.bimbingan') }}" class="text-decoration-none">
            <div class="card">
              <i class="fas fa-pencil-alt"></i>
              <h5>Log Bimbingan</h5>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="jadwal_seminar.html" class="text-decoration-none">
            <div class="card">
              <i class="fas fa-calendar-check"></i>
              <h5>Jadwal Seminar</h5>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="daftar_ujian.html" class="text-decoration-none">
            <div class="card">
              <i class="fas fa-file-signature"></i>
              <h5>Pendaftaran Ujian TA</h5>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="unggah_dokumen.html" class="text-decoration-none">
            <div class="card">
              <i class="fas fa-file-upload"></i>
              <h5>Unggah Dokumen Akhir</h5>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="{{ route('mahasiswa.monitoring') }}" class="text-decoration-none">
            <div class="card">
              <i class="fas fa-chart-line"></i>
              <h5>Monitoring TA</h5>
            </div>
          </a>
        </div>
      </div>
    </div>

    <footer class="text-center mt-5 mb-3 text-muted">
      <small>&copy; 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)</small>
    </footer>
  </body>
</html>
