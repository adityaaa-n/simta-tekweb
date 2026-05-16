<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Monitoring Kaprodi</title>

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

        .stats-card{
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .stats-card:hover{
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .chart-container{
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

    </style>

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid px-4">

            <span class="navbar-brand fw-bold">
                SIMTA - Statistik Kaprodi
            </span>

            <a href="/kaprodi/dashboard"
               class="text-white text-decoration-none fw-semibold">

                <i class="fa-solid fa-arrow-left me-1"></i>
                Dashboard

            </a>

        </div>

    </nav>

    <div class="container py-5">

        <!-- Heading -->
        <div class="mb-5">

            <h2 class="fw-bold">
                Statistik Monitoring Tugas Akhir
            </h2>

            <p class="text-muted">
                Monitoring perkembangan tugas akhir mahasiswa secara realtime.
            </p>

        </div>

        <!-- Statistik -->
        <div class="row g-4 mb-5">

            <div class="col-md-4">

                <div class="card stats-card shadow-sm p-4">

                    <h5 class="text-muted">
                        Mahasiswa Aktif TA
                    </h5>

                    <h2 class="fw-bold text-success">
                        {{ $stats['mahasiswaAktif'] }}
                    </h2>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card stats-card shadow-sm p-4">

                    <h5 class="text-muted">
                        Proposal Disetujui
                    </h5>

                    <h2 class="fw-bold text-success">
                        {{ $stats['proposalDisetujui'] }}
                    </h2>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card stats-card shadow-sm p-4">

                    <h5 class="text-muted">
                        Dokumen Akhir Lulus
                    </h5>

                    <h2 class="fw-bold text-success">
                        {{ $stats['lulus'] }}
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

    <!-- Footer -->
    <footer class="text-center py-4 text-muted">
        © 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)
    </footer>

    <script>

        const statsData = @json($stats);

        const ctx = document.getElementById('statsChart');

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: [
                    'Mahasiswa Aktif',
                    'Proposal Disetujui',
                    'Seminar',
                    'Ujian',
                    'Lulus'
                ],

                datasets: [{

                    label: 'Jumlah Mahasiswa',

                    data: [
                        statsData.mahasiswaAktif,
                        statsData.proposalDisetujui,
                        statsData.seminar,
                        statsData.ujian,
                        statsData.lulus
                    ],

                    backgroundColor: [
                        '#198754',
                        '#20c997',
                        '#0dcaf0',
                        '#ffc107',
                        '#dc3545'
                    ],

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