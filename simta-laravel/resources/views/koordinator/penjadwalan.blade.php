<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Ujian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                <form id="formJadwal" action="/koordinator/penjadwalan/simpan"
                      method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Proposal Mahasiswa
                        </label>

                        <select name="proposal_id"
                                class="form-control">

                            @foreach($proposal as $item)

                                <option value="{{ $item['id'] }}">

                                    {{ $item['judul'] }}

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
                               class="form-control" 
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Waktu Ujian
                        </label>

                        <input type="time"
                               name="waktu"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Ruang
                        </label>

                        <input type="text"
                               name="ruang"
                               class="form-control"
                               required>

                    </div>

                    <button

                        type="button"
                        class="btn btn-warning"
                        onclick="confirmJadwal()">
                        
                        Simpan Jadwal

                    </button>

                </form>

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

    function confirmJadwal()
    {
        let form = document.getElementById('formJadwal');

        if(!form.checkValidity()){

            Swal.fire({

                title: 'Form Belum Lengkap!',
                text: 'Semua data wajib diisi.',
                icon: 'warning',

                confirmButtonColor: '#f0ad4e'

            });

            form.reportValidity();

            return;
        }

        Swal.fire({

            title: 'Simpan Jadwal?',
            text: 'Pastikan data jadwal sudah benar.',
            icon: 'question',

            showCancelButton: true,

            confirmButtonColor: '#f0ad4e',
            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'

        }).then((result) => {

            if(result.isConfirmed){

                Swal.fire({

                    title: 'Berhasil!',
                    text: 'Jadwal berhasil disimpan.',
                    icon: 'success',

                    timer: 1500,
                    showConfirmButton: false

                });

                setTimeout(() => {

                    form.submit();

                }, 1500);

            }

        });
    }
    </script>
</body>
</html>