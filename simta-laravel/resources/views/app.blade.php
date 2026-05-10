<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMTA - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @php
        // 1. Ambil data role dari session (default 'guest' kalau belum login)
        $role = session('user.role', 'guest');

        // 2. Logika Bunglon: Tentukan warna berdasarkan role
        $navbarColor = 'bg-dark'; // Hitam (Default)

        if ($role == 'mhs') $navbarColor = 'bg-success';      // Hijau
        if ($role == 'dsn') $navbarColor = 'bg-info';         // Biru Muda
        if ($role == 'koor') $navbarColor = 'bg-warning';     // Kuning
        if ($role == 'admin') $navbarColor = 'bg-danger';     // Merah
        if ($role == 'kaprodi') $navbarColor = 'bg-primary';  // Biru Tua
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark {{ $navbarColor }}">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                🎓 SIMTA | Dashboard {{ strtoupper($role) }}
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>