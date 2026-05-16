<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Dosen Pembimbing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <a href="/koordinator/dashboard"
               class="text-white text-decoration-none fw-semibold">

                <i class="fa-solid fa-arrow-left me-1"></i>
                ← Dashboard

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

                            <form
                                id="formDosen{{ $item['id'] }}"
                                action="/koordinator/manajemen-dosen/{{ $item['id'] }}"
                                method="POST">

                                @csrf

                                <td>

                                    {{ $item['mahasiswa'] }}

                                </td>

                                <td>

                                    {{ $item['judul'] }}

                                </td>

                                <td>

                                    <select
                                        id="dsn{{ $item['id'] }}"
                                        name="dsn_id"
                                        class="form-select">

                                        <option value="" selected>

                                            -- Pilih Dosen --

                                        </option>

                                        @foreach($dosen as $dsn)

                                            <option value="{{ $dsn['id'] }}">

                                                {{ $dsn['name'] }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>

                                <td class="text-center">

                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        onclick="confirmAssign({{ $item['id'] }})">

                                        Simpan

                                    </button>

                                </td>

                            </form>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
    <footer class="text-center mt-5 mb-3 text-muted">

        © 2026 Sistem Informasi Manajemen Tugas Akhir (SIMTA)

    </footer>
    <script>

    function confirmAssign(id)
    {
        let dosen =
        document.getElementById('dsn' + id);

        if(dosen.value == '')
        {
            Swal.fire({

                title: 'Pilih Dosen!',
                text: 'Dosen pembimbing wajib dipilih.',
                icon: 'warning',

                confirmButtonColor: '#dc3545'

            });

            return;
        }

        Swal.fire({

            title: 'Simpan Pembimbing?',
            text: 'Pastikan dosen pembimbing sudah benar.',
            icon: 'question',

            showCancelButton: true,

            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'

        }).then((result) => {

            if(result.isConfirmed){

                Swal.fire({

                    title: 'Berhasil!',
                    text: 'Dosen pembimbing berhasil disimpan.',
                    icon: 'success',

                    timer: 1500,
                    showConfirmButton: false

                });

                setTimeout(() => {

                    document
                    .getElementById('formDosen' + id)
                    .submit();

                }, 1500);

            }

        });
    }

    </script>
</body>
</html>