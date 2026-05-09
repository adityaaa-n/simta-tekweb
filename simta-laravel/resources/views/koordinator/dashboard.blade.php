<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Koordinator TA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background-color: #f5f7fb;
        }

        .navbar-custom {
            background-color: #0d6efd;
        }

        .card-menu {
            transition: 0.3s;
            border: none;
            border-radius: 15px;
        }

        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .icon-menu {
            font-size: 40px;
            margin-bottom: 15px;
            color: #0d6efd;
        }

        .table-container {
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
            <a class="navbar-brand fw-bold" href="#">
                SIMTA - Koordinator TA
            </a>
        </div>
    </nav>

    <div class="container py-4">

        <!-- Welcome -->
        <div class="mb-4">
            <h2 class="fw-bold">Selamat Datang, Koordinator TA 👋</h2>
            <p class="text-muted">
                Kelola proposal mahasiswa dan monitoring tugas akhir.
            </p>
        </div>

        <!-- Menu Cards -->
        <div class="row g-4 mb-5">

            <div class="col-md-4">
                <div class="card card-menu p-4 text-center">
                    <i class="fa-solid fa-file-circle-check icon-menu"></i>
                    <h5 class="fw-bold">Verifikasi Proposal</h5>
                    <p class="text-muted">
                        Kelola persetujuan proposal mahasiswa.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-menu p-4 text-center">
                    <i class="fa-solid fa-calendar-days icon-menu"></i>
</html>