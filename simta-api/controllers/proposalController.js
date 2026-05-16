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
    res.status(500).json({ message: "Gagal mengajukan proposal" });
  }
};

// 2. Melihat daftar semua proposal (Admin/Koor)
const lihatProposal = async (req, res) => {
  try {
    const [proposals] = await db.query(`
      SELECT p.*, 
      mhs.name AS nama_mhs, 
      mhs.nim_nip, 
      dsn.name AS nama_dosen
      FROM proposals p

      LEFT JOIN users AS mhs 
      ON p.mhs_id = mhs.id
      LEFT JOIN users AS dsn 
      ON p.dsn_id = dsn.id
      
      ORDER BY p.id DESC
    `);
    res.json(proposals);
  } catch (error) {
    res.status(500).json({ message: "Gagal mengambil data proposal" });
  }
};

// 3. Mengubah Status (ACC/Tolak)
const updateStatus = async (req, res) => {
  const { id } = req.params;
  let { status } = req.body;
  if (status === "ditolak") status = "rejected";

  try {
    await db.query("UPDATE proposals SET status = ? WHERE id = ?", [
      status,
      id,
    ]);
    res.json({ message: `Status berhasil diubah menjadi ${status}` });
  } catch (error) {
    res.status(500).json({ message: "Gagal mengubah status" });
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
    res.status(500).json({ message: "Gagal memplot dosen" });
  }
};

// 5. Lihat Mahasiswa Bimbingan Per Dosen + Status Nilai
const lihatBimbinganDosen = async (req, res) => {
  const { dsn_id } = req.params;
  try {
    const [rows] = await db.query(
      `SELECT p.*, g.id as grade_id, u.name as nama_mhs, u.nim_nip 
       FROM proposals p
       LEFT JOIN grades g ON p.id = g.proposal_id
       JOIN users u ON p.mhs_id = u.id
       WHERE p.dsn_id = ? AND p.status = 'approved_dsn'`,
      [dsn_id],
    );
    res.json(rows);
  } catch (error) {
    res.status(500).json({ message: "Gagal mengambil bimbingan dosen" });
  }
};

// 6. Ambil Statistik Dashboard Dosen
const getStatsDosen = async (req, res) => {
  const { dsn_id } = req.params;
  try {
    const [propBaru] = await db.query(
      "SELECT COUNT(*) as total FROM proposals WHERE dsn_id = ? AND status = 'pending'",
      [dsn_id],
    );
    const [mhsBimbingan] = await db.query(
      "SELECT COUNT(*) as total FROM proposals WHERE dsn_id = ? AND status = 'approved_dsn'",
      [dsn_id],
    );
    const [jadwalSidang] = await db.query(
      "SELECT COUNT(*) as total FROM schedules s JOIN proposals p ON s.proposal_id = p.id WHERE p.dsn_id = ?",
      [dsn_id],
    );

    res.json({
      proposal_baru: propBaru[0].total,
      mahasiswa_bimbingan: mhsBimbingan[0].total,
      jadwal_sidang: jadwalSidang[0].total,
    });
  } catch (error) {
    res.status(500).json({ message: "Gagal mengambil statistik" });
  }
};

// 7. Ambil Seluruh Log Bimbingan Milik Mahasiswa Dosen Tersebut
const getLogsByDosen = async (req, res) => {
  const { dsn_id } = req.params;
  try {
    const [logs] = await db.query(
      `
      SELECT l.*, p.judul, u.name as nama_mhs, u.nim_nip
      FROM log_bimbingan l
      JOIN proposals p ON l.proposal_id = p.id
      JOIN users u ON p.mhs_id = u.id
      WHERE p.dsn_id = ?
      ORDER BY l.tanggal DESC
    `,
      [dsn_id],
    );
    res.json(logs);
  } catch (error) {
    res.status(500).json({ message: "Gagal mengambil log bimbingan" });
  }
};

// 8. FITUR BARU: Ambil Proposal khusus untuk di-review Dosen tertentu
const getProposalsForReviewDosen = async (req, res) => {
  const { dsn_id } = req.params;
  try {
    const [proposals] = await db.query(
      `
      SELECT p.*, u.name as nama_mhs, u.nim_nip 
      FROM proposals p
      JOIN users u ON p.mhs_id = u.id
      WHERE p.dsn_id = ?
      ORDER BY p.id DESC
    `,
      [dsn_id],
    );
    res.json(proposals);
  } catch (error) {
    res
      .status(500)
      .json({ message: "Gagal mengambil data proposal untuk direview" });
  }
};

module.exports = {
  ajukanProposal,
  lihatProposal,
  updateStatus,
  plotDosen,
  lihatBimbinganDosen,
  getStatsDosen,
  getLogsByDosen,
  getProposalsForReviewDosen,
};
