const db = require("../config/db");

// 1. Mahasiswa menginput log bimbingan
const tambahLog = async (req, res) => {
  const { proposal_id, tanggal, catatan } = req.body;
  try {
    await db.query(
      'INSERT INTO log_bimbingan (proposal_id, tanggal, catatan, status_validasi) VALUES (?, ?, ?, "menunggu")',
      [proposal_id, tanggal, catatan],
    );
    res.status(201).json({ message: "Log bimbingan berhasil disimpan!" });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal menyimpan log bimbingan" });
  }
};

// 2. Melihat riwayat bimbingan berdasarkan ID Proposal
const lihatLog = async (req, res) => {
  const { proposal_id } = req.params;
  try {
    const [logs] = await db.query(
      "SELECT * FROM log_bimbingan WHERE proposal_id = ? ORDER BY tanggal DESC",
      [proposal_id],
    );
    res.json(logs);
  } catch (error) {
    res.status(500).json({ message: "Gagal mengambil riwayat bimbingan" });
  }
};

// 3. Dosen memvalidasi bimbingan
const validasiLog = async (req, res) => {
  const { id } = req.params;
  try {
    await db.query(
      'UPDATE log_bimbingan SET status_validasi = "divalidasi" WHERE id = ?',
      [id],
    );
    res.json({ message: "Bimbingan telah divalidasi oleh dosen!" });
  } catch (error) {
    res.status(500).json({ message: "Gagal memvalidasi bimbingan" });
  }
};

module.exports = { tambahLog, lihatLog, validasiLog };
