<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Ujian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f5f7fb;">

    <nav class="navbar navbar-dark bg-warning shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold">
                SIMTA - Penjadwalan Ujian
            </span>
        </div>
    </nav>

    <div class="container py-5">

        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark fw-bold">
                Form Penjadwalan Ujian Tugas Akhir
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Ujian</label>
                    <input type="date" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Ujian</label>
                    <input type="time" class="form-control">
                </div>

                <div class="mb-4">
                    <label class="form-label">Ruang</label>
                    <input type="text" class="form-control">
                </div>

                <button class="btn btn-warning">
                    Simpan Jadwal
                </button>

            </div>
        </div>

    </div>

</body>
</html>