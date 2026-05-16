<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
            background-color: #f5f7fb;
        }

        .navbar-custom{
            background-color: #dc3545;
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
            color: #dc3545;
        }

        .table-container{
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

    </style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid px-4">

            <span class="navbar-brand fw-bold">
                SIMTA - Admin
            </span>

            <a href="/"
            class="text-white fw-bold text-decoration-none fs-5">

                <i class="fa-solid fa-right-from-bracket me-2"></i>

                Logout

            </a>

        </div>

    </nav>

    <div class="container py-5">

        <!-- Welcome -->
        <div class="mb-4">
            <h2 class="fw-bold">
                Dashboard Admin
            </h2>

            <p class="text-muted">
                Verifikasi dokumen tugas akhir mahasiswa.
            </p>

        </div>

        <!-- Card -->
        <div class="row mb-5">

            <div class="col-md-12">

                <a href="/admin/verifikasi"
                class="text-decoration-none">

                    <div class="card card-menu p-5 text-center shadow-sm">

                        <i class="fa-solid fa-circle-check icon-menu mb-3"></i>

                        <h3 class="fw-bold text-danger">
                            Verifikasi Dokumen Akhir
                        </h3>

                        <p class="text-muted">
                            Kelola dan verifikasi dokumen mahasiswa.
                        </p>

                    </div>

                </a>

            </div>

        </div>
    </div>
    <footer class="text-center mt-5 mb-3 text-muted">

        © 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)
    </footer>
</body>
</html>