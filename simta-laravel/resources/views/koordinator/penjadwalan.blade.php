<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Ujian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background-color: #f5f7fb;
        }

        .navbar-custom{
            background-color: #ffc107;
        }

        .card-custom{
            border: none;
            border-radius: 15px;
        }

    </style>

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid px-4">

            <a class="navbar-brand fw-bold text-dark"
               href="/koordinator/dashboard">

                SIMTA - Penjadwalan Ujian

            </a>

        </div>

    </nav>

    <div class="container py-5">

        <div class="card card-custom shadow">

            <div class="card-header bg-warning fw-bold">

                Form Penjadwalan Ujian Tugas Akhir

            </div>

            <div class="card-body">

                <form action="/koordinator/penjadwalan/simpan"
                      method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Proposal Mahasiswa
                        </label>

                        <select name="proposal_id"
                                class="form-control">

                            @foreach($proposal as $item)

                                <option value="{{ $item->id }}">

                                    {{ $item->judul }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal Ujian
                        </label>

                        <input type="date"
                               name="tanggal"
                               class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Waktu Ujian
                        </label>

                        <input type="time"
                               name="waktu"
                               class="form-control">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Ruang
                        </label>

                        <input type="text"
                               name="ruang"
                               class="form-control">

                    </div>

                    <button class="btn btn-warning">

                        Simpan Jadwal

                    </button>

                </form>

            </div>

        </div>

    </div>

</body>
</html>