<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Proposal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid px-4">

            <a class="navbar-brand fw-bold" href="/koordinator/dashboard">
                SIMTA - Koordinator TA
            </a>

        </div>

    </nav>

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
                            <th>Status</th>
                            <th>Nama Mahasiswa</th>
                            <th>Judul Proposal</th>
                            <th>File</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>

                    <tbody>
                    
                    @foreach($proposal as $item)
                    <tr>
                        <td>{{ $item->status }}</td>

                        <td>{{ $item->mahasiswa->name }}</td>

                        <td>{{ $item->judul }}</td>

                        <td class="text-center">

                            <button class="btn btn-outline-primary btn-sm">
                                Unduh
                            </button>

                        </td>

                        <td class="text-center">

                            <a href="/koordinator/verifikasi/setujui/{{ $item->id }}"
                                class="btn btn-success btn-sm">

                                    Setujui

                                </a>

                                <a href="/koordinator/verifikasi/tolak/{{ $item->id }}"
                                class="btn btn-danger btn-sm">

                                    Tolak

                                </a>

                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>