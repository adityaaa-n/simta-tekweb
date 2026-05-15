<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Proposal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        body{
            background-color: #f5f7fb;
        }

        .navbar-custom{
            background-color: #0d6efd;
        }

        .table-container{
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .btn-action{
            width: 100%;
        }

        table{
            table-layout: fixed;
        }

    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid px-4">

            <a class="navbar-brand fw-bold" href="/koordinator/dashboard">
                SIMTA - Koordinator TA
            </a>

        </div>

    </nav>

    <!-- Content -->
    <div class="container py-5">

        <div class="mb-4">

            <h2 class="fw-bold">
                Verifikasi Proposal Mahasiswa
            </h2>

            <p class="text-muted">
                Kelola persetujuan proposal tugas akhir mahasiswa.
            </p>

        </div>

        <div class="table-container">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-primary text-center">

                        <tr>

                            <th>Nama Mahasiswa</th>
                            <th>Judul Proposal</th>
                            <th>Dosen Pembimbing</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($proposal as $item)

                        <tr>
                            
                            <td>
                                {{ $item['mahasiswa'] }}
                            </td>
                            
                            <td>
                                {{ $item['judul'] }}
                            </td>
                            
                            <td>
                                {{ $item['dosen'] ?? '-' }}
                            </td>
                            
                            <td class="text-center">
                                
                                <button class="btn btn-outline-primary btn-sm">
                                    Unduh
                                </button>
                                
                            </td>
                            
                            <td>
                                {{ $item['status'] }}
                            </td>

                            <td class="text-center">

                                <div class="d-grid gap-2">

                                    <button
                                        type="button"
                                        class="btn btn-success btn-sm btn-action"
                                        onclick="confirmSetujui({{ $item['id'] }})">

                                        Setujui

                                    </button>

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btn-action"
                                        onclick="confirmTolak({{ $item['id'] }})">

                                        Tolak

                                    </button>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="mt-4 text-center">

                <a
                    href="/koordinator/dashboard"
                    class="btn btn-outline-secondary">

                    ← Kembali ke Dashboard

                </a>

            </div>

        </div>

    </div>
    <footer class="text-center mt-5 mb-3 text-muted">

        © 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)

    </footer>

    <script>

        function confirmSetujui(id)
        {
            Swal.fire({

                title: 'Setujui Proposal?',
                text: 'Pastikan proposal sudah diperiksa dengan teliti.',
                icon: 'question',

                showCancelButton: true,

                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'

            }).then((result) => {

                if(result.isConfirmed){

                    window.location.href =
                    "/koordinator/verifikasi/setujui/" + id;

                }

            });
        }

        function confirmTolak(id)
        {
            Swal.fire({

                title: 'Tolak Proposal?',
                text: 'Proposal akan ditolak.',
                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'

            }).then((result) => {

                if(result.isConfirmed){

                    window.location.href =
                    "/koordinator/verifikasi/tolak/" + id;

                }

            });
        }

    </script>

</body>

</html>