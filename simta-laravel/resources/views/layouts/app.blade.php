<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMTA - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .hover-danger:hover {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            color: white !important;
        }
        .transition-all { transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    @php
        $role = session('user.role', 'guest');
        $navbarColor = 'bg-dark';
        if ($role == 'mhs') $navbarColor = 'bg-success';
        if ($role == 'dsn') $navbarColor = 'bg-info';
        if ($role == 'koor') $navbarColor = 'bg-warning';
        if ($role == 'admin') $navbarColor = 'bg-danger';
        if ($role == 'kaprodi') $navbarColor = 'bg-primary';
    @endphp

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark {{ $navbarColor }} shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                🎓 SIMTA | Dashboard {{ strtoupper($role) }}
            </a>
            <div class="d-flex align-items-center">
                <a href="/logout" class="btn btn-outline-light btn-sm rounded-pill px-3 fw-bold transition-all hover-danger">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5 flex-grow-1">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="mt-auto py-4">
        <div class="container text-center">
            <p class="text-muted small">
                &copy; 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
            });
        @endif
    </script>
</body>
</html>