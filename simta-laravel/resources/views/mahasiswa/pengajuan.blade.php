<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengajuan Tugas Akhir</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
        background: linear-gradient(to right, #e3f2fd, #f1f8e9);
      }
      .card {
        max-width: 600px;
        margin: auto;
        padding: 30px;
        margin-top: 50px;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body>
    <div class="card">
      <h3 class="mb-4 text-success">Form Pengajuan Tugas Akhir</h3>
      <form action="{{ route('mahasiswa.pengajuan.store') }}" method="POST" id="formPengajuan">
        @csrf
        <div class="mb-3">
          <label class="form-label">Judul Tugas Akhir</label>
          <input
            type="text"
            name="judul"
            class="form-control"
            placeholder="Masukkan judul..."
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi Singkat</label>
          <textarea
            name="deskripsi"
            class="form-control"
            rows="4"
            placeholder="Deskripsikan rencana tugas akhir Anda..."
            required
          ></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Dosen Pembimbing</label>
          <select name="dsn_id" class="form-select" required>
            <option selected disabled value="">Pilih Dosen</option>
            @foreach($dosens as $dosen)
              <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-success w-100 mb-2">Ajukan</button>
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-success w-100">Kembali ke Dashboard</a>
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
      document.getElementById('formPengajuan').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
          title: 'Konfirmasi Pengajuan',
          text: 'Apakah Anda yakin untuk mengajukan tugas akhir ini?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#198754',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Ajukan!',
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
