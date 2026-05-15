const db = require("../config/db");

// 1. Koordinator mengatur jadwal ujian
const buatJadwal = async (req, res) => {
  const { proposal_id, tanggal, waktu, ruang } = req.body;
  try {
    await db.query(
      "INSERT INTO schedules (proposal_id, tanggal, waktu, ruang) VALUES (?, ?, ?, ?)",
      [proposal_id, tanggal, waktu, ruang],
    );
    res.status(201).json({ message: "Jadwal ujian berhasil disimpan!" });
  } catch (error) {
    res.status(500).json({ message: "Gagal menyimpan jadwal" });
  }
};

// 2. Dosen memberikan nilai
const inputNilai = async (req, res) => {
  const { proposal_id, nilai_angka, nilai_huruf, komentar } = req.body;
  try {
    await db.query(
      "INSERT INTO grades (proposal_id, nilai_angka, nilai_huruf, komentar) VALUES (?, ?, ?, ?)",
      [proposal_id, nilai_angka, nilai_huruf, komentar],
    );
    res.status(201).json({ message: "Nilai berhasil diinput!" });
  } catch (error) {
    res.status(500).json({ message: "Gagal menginput nilai" });
  }
};

// 3. Mahasiswa upload path dokumen (Simulasi)
const uploadDokumen = async (req, res) => {
  const { proposal_id, file_path } = req.body;
  try {
    await db.query(
      'UPDATE proposals SET file_path = ?, status_dokumen = "menunggu_verifikasi" WHERE id = ?',
      [file_path, proposal_id],
    );
    res.json({ message: "Link dokumen berhasil diunggah!" });
  } catch (error) {
    res.status(500).json({ message: "Gagal mengunggah dokumen" });
  }
};

// 4. Admin verifikasi dokumen
const verifikasiDokumen = async (req, res) => {
  const { id } = req.params;
  const { status } = req.body; // 'terverifikasi'
  try {
    await db.query("UPDATE proposals SET status_dokumen = ? WHERE id = ?", [
      status,
      id,
    ]);
    res.json({ message: "Status verifikasi dokumen berhasil diperbarui!" });
  } catch (error) {
    res.status(500).json({ message: "Gagal verifikasi dokumen" });
  }
};

module.exports = { buatJadwal, inputNilai, uploadDokumen, verifikasiDokumen };
