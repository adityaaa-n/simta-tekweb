const db = require("../config/db");

// 1. Mahasiswa mengajukan judul proposal
const ajukanProposal = async (req, res) => {
  const { mhs_id, judul, deskripsi } = req.body;
  try {
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

// 2. Melihat daftar semua proposal
const lihatProposal = async (req, res) => {
  try {
    const [proposals] = await db.query("SELECT * FROM proposals");
    res.json(proposals);
  } catch (error) {
    res.status(500).json({ message: "Gagal mengambil data proposal" });
  }
};

// 3. Mengubah Status (ACC/Tolak)
const updateStatus = async (req, res) => {
  const { id } = req.params;
  let { status } = req.body;

  if (status === "ditolak") {
    status = "rejected";
  }

  try {
    await db.query("UPDATE proposals SET status = ? WHERE id = ?", [
      status,
      id,
    ]);
    res.json({ message: `Status proposal berhasil diubah menjadi ${status}` });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal mengubah status proposal" });
  }
};

// 4. Memplot Dosen Pembimbing
const plotDosen = async (req, res) => {
  const { id } = req.params;
  const { dsn_id } = req.body;

  try {
    await db.query("UPDATE proposals SET dsn_id = ? WHERE id = ?", [
      dsn_id,
      id,
    ]);
    res.json({ message: "Dosen pembimbing berhasil ditugaskan!" });
  } catch (error) {
    res.status(500).json({ message: "Gagal memplot dosen pembimbing" });
  }
};

// 5. FITUR BARU: Lihat Mahasiswa Bimbingan Spesifik Dosen + Cek Nilai
const lihatBimbinganDosen = async (req, res) => {
  const { dsn_id } = req.params;
  try {
    const [rows] = await db.query(
      `
      SELECT p.*, g.id as grade_id 
      FROM proposals p
      LEFT JOIN grades g ON p.id = g.proposal_id
      WHERE p.dsn_id = ? AND p.status = 'approved_dsn'
    `,
      [dsn_id],
    );

    res.json(rows);
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal mengambil data bimbingan" });
  }
};

module.exports = {
  ajukanProposal,
  lihatProposal,
  updateStatus,
  plotDosen,
  lihatBimbinganDosen,
};
