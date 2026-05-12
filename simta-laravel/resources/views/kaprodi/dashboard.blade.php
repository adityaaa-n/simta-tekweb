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

                <div class="card card-menu p-5 text-center shadow-sm">

                    <i class="fa-solid fa-chart-column icon-menu mb-3"></i>

                    <h3 class="fw-bold text-success">
                        Monitoring & Statistik TA
                    </h3>

                    <p class="text-muted">
                        Pantau perkembangan tugas akhir mahasiswa.
                    </p>

                </div>

            </div>

        </div>

        <!-- Statistik -->
        <div class="row g-4 mb-5">

            <div class="col-md-4">

                <div class="card stats-card shadow-sm p-4">

                    <h5 class="text-muted">
                        Mahasiswa Aktif TA
                    </h5>

                    <h2 class="fw-bold text-success">
                        120
                    </h2>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card stats-card shadow-sm p-4">

                    <h5 class="text-muted">
                        Proposal Disetujui
                    </h5>

                    <h2 class="fw-bold text-success">
                        85
                    </h2>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card stats-card shadow-sm p-4">

                    <h5 class="text-muted">
                        Dokumen Akhir Lulus
                    </h5>

                    <h2 class="fw-bold text-success">
                        60
                    </h2>

                </div>

            </div>

        </div>

        <!-- Chart -->
        <div class="chart-container">

            <h4 class="fw-bold text-success mb-4">
                Statistik Tahapan Tugas Akhir
            </h4>

            <canvas id="statsChart"></canvas>

        </div>

    </div>

    <script>

        const ctx = document.getElementById('statsChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Pengajuan',
                    'Bimbingan',
                    'Seminar',
                    'Ujian',
                    'Lulus'
                ],
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: [120, 100, 80, 65, 60],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>

</body>
</html>