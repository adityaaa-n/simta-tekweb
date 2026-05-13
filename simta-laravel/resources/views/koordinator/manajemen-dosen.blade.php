<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Dosen Pembimbing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background-color: #f5f7fb;
        }

        .navbar-custom{
            background-color: #dc3545;
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid px-4">

            <a class="navbar-brand fw-bold"
               href="/koordinator/dashboard">

                SIMTA - Manajemen Dosen Pembimbing

            </a>

        </div>

    </nav>

    <div class="container py-5">

        <!-- Judul -->
        <div class="mb-4">

            <h2 class="fw-bold text-danger">

                Tabel Manajemen Dosen Pembimbing

            </h2>

            <p class="text-muted">

                Kelola penentuan dosen pembimbing tugas akhir mahasiswa.

            </p>

        </div>

        <!-- Table -->
        <div class="table-container">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-danger text-center">

                        <tr>

                            <th>Nama Mahasiswa</th>
                            <th>Judul TA</th>
                            <th>Dosen Pembimbing</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($proposal as $item)

                        <tr>

                            <td>

                                {{ $item->mahasiswa->name }}

                            </td>

                            <td>

                                {{ $item->judul }}

                            </td>

                            <td>

                                <form action="/koordinator/manajemen-dosen/{{ $item->id }}"
                                      method="POST">

                                    @csrf

                                    <select name="dsn_id"
                                            class="form-select">

                                        <option selected disabled>

                                            -- Pilih Dosen --

                                        </option>

                                        @foreach($dosen as $dsn)

                                            <option value="{{ $dsn->id }}">

                                                {{ $dsn->name }}

                                            </option>

                                        @endforeach

                                    </select>

                            </td>

                            <td class="text-center">

                                    <button class="btn btn-danger">

                                        Simpan

                                    </button>

                                </form>

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