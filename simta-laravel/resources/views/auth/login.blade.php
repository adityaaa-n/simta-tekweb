<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login SIMTA</title>
    <meta name="description" content="Halaman login Sistem Informasi Manajemen Tugas Akhir (SIMTA) Unjani." />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #e8f5e9);
            font-family: "Segoe UI", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-box {
            background: white;
            padding: 40px 30px;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box img {
            width: 90px;
            margin-bottom: 15px;
        }

        .login-box h1 {
            font-size: 1.5rem;
            margin-bottom: 25px;
            color: #198754;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-login {
            background-color: #198754;
            border: none;
            color: white;
            transition: background 0.3s ease-in-out;
        }

        .btn-login:hover {
            background-color: #145c39;
            color: white;
        }

        .text-muted small {
            font-size: 0.85rem;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="login-box">
        {{-- Logo Unjani --}}
        <img src="https://upload.wikimedia.org/wikipedia/id/f/f3/Logo_Unjani.png" alt="Logo Unjani" />

        <h1>Login SIMTA</h1>

        {{-- Tampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert-error">
                <i class="fa fa-circle-exclamation me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Tampilkan pesan session error jika ada --}}
        @if (session('error'))
            <div class="alert-error">
                <i class="fa fa-circle-exclamation me-1"></i>
                {{ session('error') }}
            </div>
        @endif

        <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            {{-- Username / Email --}}
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Username (Email)</label>
                <input
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="cth: mhs.joko@unjani.ac.id"
                />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Login --}}
            <button type="submit" id="loginBtn" class="btn btn-login w-100">
                <i class="fa fa-right-to-bracket me-1"></i> Login
            </button>
        </form>

        <p class="text-muted mt-3">
            <small>
                Gunakan email dengan awalan sesuai peran:<br />
                <strong>mhs</strong> / <strong>dsn</strong> / <strong>koor</strong> /
                <strong>admin</strong> / <strong>kaprodi</strong>
            </small>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Validasi sisi klien sebelum submit ke server
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const email = document.getElementById('email').value.trim().toLowerCase();
            const validPrefixes = ['mhs', 'dsn', 'koor', 'admin', 'kaprodi'];
            const isValid = validPrefixes.some(prefix => email.startsWith(prefix));

            if (!isValid) {
                e.preventDefault();
                alert('Email tidak dikenali. Gunakan awalan sesuai peran Anda (mhs / dsn / koor / admin / kaprodi).');
            }
        });
    </script>
</body>
</html>
