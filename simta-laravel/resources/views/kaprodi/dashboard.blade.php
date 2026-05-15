<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kaprodi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
            background-color: #f5f7fb;
        }

        .navbar-custom{
            background-color: #198754;
        }

        .card-menu{
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card-menu:hover{
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .icon-menu{
            font-size: 55px;
            color: #198754;
        }

        .stats-card{
            border: none;
            border-radius: 15px;
        }

        .chart-container{
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

    </style>

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid px-4">

            <span class="navbar-brand fw-bold">
                SIMTA - Kaprodi
            </span>
            <a href="/logout" class="text-white text-decoration-none fw-semibold">
                <i class="fa-solid fa-right-from-bracket me-1"></i>
                Logout
            </a>
        </div>

    </nav>

    <div class="container py-5">

        <!-- Welcome -->
        <div class="mb-4">

            <h2 class="fw-bold">
                Dashboard Kaprodi
            </h2>

            <p class="text-muted">
                Monitoring statistik tugas akhir mahasiswa.
            </p>

        </div>

        <!-- Menu -->
        <div class="row mb-5">

            <div class="col-md-12">

                <a href="/kaprodi/statistik"
                class="text-decoration-none">

                    <div class="card card-menu p-5 text-center shadow-sm">

                        <i class="fa-solid fa-chart-column icon-menu mb-3"></i>

                        <h3 class="fw-bold text-success">
                            Monitoring & Statistik TA
                        </h3>

                        <p class="text-muted">
                            Pantau perkembangan tugas akhir mahasiswa.
                        </p>

                    </div>

                </a>

            </div>

        </div>
        
        <footer class="text-center py-4 text-muted">
            © 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)
        </footer>
</body>
</html>