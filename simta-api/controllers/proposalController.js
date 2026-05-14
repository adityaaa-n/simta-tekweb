const db = require("../config/db");

// 1. Mahasiswa mengajukan judul proposal
const ajukanProposal = async (req, res) => {
  const { mhs_id, judul, deskripsi } = req.body;
  try {
    // Memasukkan data ke tabel proposals dengan status awal 'pending'
    const [result] = await db.query(
      'INSERT INTO proposals (mhs_id, judul, deskripsi, status) VALUES (?, ?, ?, "pending")',
      [mhs_id, judul, deskripsi],
    );
    res.status(201).json({
      message: "Proposal berhasil diajukan!",
      proposal_id: result.insertId,
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal mengajukan proposal" });
  }
};

// 2. Melihat daftar semua proposal (Untuk Koordinator/Dosen)
const lihatProposal = async (req, res) => {
  try {
    const [proposals] = await db.query("SELECT * FROM proposals");
    res.json(proposals);
  } catch (error) {
    res.status(500).json({ message: "Gagal mengambil data proposal" });
  }
};

// 3. Dosen atau Koordinator Mengubah Status (ACC/Tolak)
const updateStatus = async (req, res) => {
  const { id } = req.params;
  const { status } = req.body; // status berisi: 'approved_dsn', 'approved_koor', atau 'rejected'

  try {
    await db.query("UPDATE proposals SET status = ? WHERE id = ?", [
      status,
      id,
    ]);
    res.json({ message: `Status proposal berhasil diubah menjadi ${status}` });
  } catch (error) {
    res.status(500).json({ message: "Gagal mengubah status proposal" });
  }
};

// 4. Koordinator Memplot (Menugaskan) Dosen Pembimbing
const plotDosen = async (req, res) => {
  const { id } = req.params;
  const { dsn_id } = req.body;

  try {
    await db.query("UPDATE proposals SET dsn_id = ? WHERE id = ?", [
      dsn_id,
      id,
    ]);
    res.json({
      message: "Dosen pembimbing berhasil ditugaskan ke mahasiswa ini!",
    });
  } catch (error) {
    res.status(500).json({ message: "Gagal memplot dosen pembimbing" });
  }
};

module.exports = { ajukanProposal, lihatProposal, updateStatus, plotDosen };
