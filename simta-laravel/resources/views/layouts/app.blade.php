<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'SIMTA')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #f1f8e9);
            font-family: "Segoe UI", sans-serif;
            min-height: 100vh;
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
        .header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        .header .logout-btn {
            color: white;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .header .logout-btn:hover {
            opacity: 0.8;
        }
        .main-content {
            flex: 1;
            padding-top: 40px;
        }
        .footer {
            padding: 20px 0;
            color: #6c757d;
        }
        @yield('styles')
    </style>
</head>
<body>
    <div class="header d-flex justify-content-between align-items-center px-4">
        <h2><i class="fas fa-user-graduate"></i> @yield('header_title', 'SIMTA')</h2>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-link logout-btn p-0">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <footer class="footer text-center mt-5 mb-3">
        <small>&copy; 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
