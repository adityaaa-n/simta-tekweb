# Dokumentasi API - SIMTA Backend (Node.js)

Berikut adalah daftar endpoint API yang sudah tersedia untuk digunakan oleh Frontend.

## 1. Autentikasi (Issue #6)

- **Login User**
  - `POST /api/login`
  - Body (JSON): `{"email": "mhs@simta.com", "password": "password"}`

## 2. Modul Proposal & Dosen (Issue #7)

- **Ajukan Judul TA (Mahasiswa)**
  - `POST /api/proposals`
  - Body (JSON): `{"mhs_id": 1, "judul": "...", "deskripsi": "..."}`
- **Lihat Daftar Proposal**
  - `GET /api/proposals`
- **Ubah Status Proposal (Dosen/Koor)**
  - `PATCH /api/proposals/:id/status`
  - Body (JSON): `{"status": "approved_koor"}`
- **Plotting Dosen Pembimbing (Koor)**
  - `PATCH /api/proposals/:id/assign-dosen`
  - Body (JSON): `{"dsn_id": 2}`

## 3. Modul Log Bimbingan (Issue #8)

- **Input Log Bimbingan (Mahasiswa)**
  - `POST /api/guidance-logs`
  - Body (JSON): `{"proposal_id": 1, "tanggal": "YYYY-MM-DD", "catatan": "..."}`
- **Lihat Riwayat Bimbingan**
  - `GET /api/guidance-logs/:proposal_id`
- **Validasi Bimbingan (Dosen)**
  - `PATCH /api/guidance-logs/:id/validate`

## 4. Modul Tahap Akhir (Issue #9)

- **Input Jadwal Sidang (Koor)**
  - `POST /api/schedules`
  - Body (JSON): `{"proposal_id": 1, "tanggal": "...", "waktu": "...", "ruang": "..."}`
- **Input Nilai Akhir (Dosen)**
  - `POST /api/grades`
  - Body (JSON): `{"proposal_id": 1, "nilai_angka": 85, "nilai_huruf": "A", "komentar": "..."}`
- **Upload Link Dokumen Final (Mahasiswa)**
  - `POST /api/documents`
  - Body (JSON): `{"proposal_id": 1, "file_path": "/uploads/..."}`
- **Verifikasi Dokumen (Admin)**
  - `PATCH /api/documents/:id/verify`
  - Body (JSON): `{"status": "terverifikasi"}`

## 5. Dashboard Statistik (Issue #10)

- **Ambil Data Statistik (Kaprodi)**
  - `GET /api/stats`

## 6. Layanan File Fisik (Issue #11)

- **Upload Dokumen PDF**
  - `POST /api/documents/upload`
  - Body (Form-Data): `dokumen_pdf` (File)
- **Unduh Dokumen**
  - `GET /api/download/:filename`

## 7. Monitoring & Registrasi Ujian (Issue #12)

- **Pengajuan Tanggal Ujian (Mahasiswa)**
  - `POST /api/exam-registration`
  - Body (JSON): `{"proposal_id": 1, "tanggal_harapan": "YYYY-MM-DD", "keterangan": "..."}`
- **Monitoring Progress Individu**
  - `GET /api/monitoring/me/:mhs_id`
