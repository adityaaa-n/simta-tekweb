<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMTA - Dashboard Belum Dibuat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
      body {
        background: linear-gradient(to right, #e3f2fd, #f1f8e9);
        font-family: "Segoe UI", sans-serif;
        height: 100vh;
        display: flex;
        flex-direction: column;
      }
      .header {
        background-color: #198754;
        padding: 20px;
        color: white;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
      .header h2 { margin: 0; }
      .header .logout-btn {
        float: right;
        color: white;
        text-decoration: none;
      }
      .content-area {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .card-message {
        background: white;
        padding: 40px;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 500px;
      }
      .card-message i {
        font-size: 4rem;
        color: #ffc107;
        margin-bottom: 20px;
      }
    </style>
</head>
<body>
    <div class="header d-flex justify-content-between align-items-center px-4">
      <h2><i class="fas fa-tools"></i> SIMTA</h2>
      <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </div>

    <div class="content-area container">
        <div class="card-message">
            <i class="fas fa-person-digging"></i>
            <h3>Dashboard Belum Dibuat</h3>
            <p class="text-muted mt-3">
                Maaf, dashboard untuk pengguna dengan role <strong>{{ $role ?? 'yang Anda tuju' }}</strong> saat ini belum tersedia atau masih dalam tahap pengembangan.
            </p>
            <button onclick="history.back()" class="btn btn-outline-success mt-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>
    </div>
</body>
</html>
