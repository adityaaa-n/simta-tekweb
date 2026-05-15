<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Ujian TA</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
        background: #fff3e0;
      }
      .form-box {
        max-width: 600px;
        margin: auto;
        padding: 30px;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-top: 60px;
      }
    </style>
  </head>
  <body>
    <div class="form-box">
      <h3 class="mb-4 text-warning">Pendaftaran Ujian Tugas Akhir</h3>
      <form action="{{ route('mahasiswa.daftar_ujian.store') }}" method="POST" id="formUjian">
        @csrf
        <div class="mb-3">
          <label class="form-label">Tanggal Ujian yang Diinginkan</label>
          <input type="date" name="tanggal_harapan" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-warning w-100 mb-2">Daftar</button>
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-warning w-100">
            Kembali ke Dashboard
        </a>
      </form>
    </div>

    @if(session('success'))
    <script>
      Swal.fire({
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    </script>
    @endif

    <script>
      document.getElementById('formUjian').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
          title: 'Konfirmasi Pendaftaran',
          text: 'Apakah Anda yakin ingin mendaftarkan diri untuk ujian Tugas Akhir?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#ffc107',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Daftar!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    </script>
  </body>
</html>
