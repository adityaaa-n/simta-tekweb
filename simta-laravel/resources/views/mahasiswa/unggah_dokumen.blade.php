<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Unggah Dokumen Akhir</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
        background: #e1f5fe;
      }
      .upload-box {
        max-width: 600px;
        margin: auto;
        padding: 30px;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <div class="upload-box">
      <h3 class="text-info mb-4">Unggah Dokumen Akhir</h3>
      <form action="{{ route('mahasiswa.unggah_dokumen.store') }}" method="POST" enctype="multipart/form-data" id="formUnggah">
        @csrf
        <div class="mb-3">
          <label class="form-label">File Dokumen Akhir (.pdf)</label>
          <input type="file" name="file_dokumen" class="form-control" accept=".pdf" required />
        </div>
        <button type="submit" class="btn btn-info w-100 mb-2">Unggah</button>
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-info w-100">
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
      document.getElementById('formUnggah').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin mengunggah dokumen ini?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#0dcaf0',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Unggah!',
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
