const db = require("../config/db");

const getDashboardStats = async (req, res) => {
  try {
    // 1. Menghitung total seluruh proposal (Mahasiswa Aktif TA)
    const [totalProposals] = await db.query(
      "SELECT COUNT(*) as total FROM proposals",
    );

    // 2. Menghitung proposal yang sudah di-ACC Koordinator
    const [approvedProposals] = await db.query(
      'SELECT COUNT(*) as total FROM proposals WHERE status = "approved_koor"',
    );

    // 3. Menghitung mahasiswa yang sudah lulus (Dokumen Akhir Terverifikasi)
    const [graduated] = await db.query(
      'SELECT COUNT(*) as total FROM proposals WHERE status_dokumen = "terverifikasi"',
    );

    // 4. Menghitung sebaran mahasiswa di tiap status (Pengajuan, Ditolak, dll)
    const [statusDistribution] = await db.query(
      "SELECT status, COUNT(*) as jumlah FROM proposals GROUP BY status",
    );

    // Menggabungkan semua hasil hitungan menjadi satu paket JSON
    res.json({
      statistik_utama: {
        total_mahasiswa_ta: totalProposals[0].total,
        proposal_disetujui: approvedProposals[0].total,
        mahasiswa_lulus: graduated[0].total,
      },
      sebaran_status_proposal: statusDistribution,
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal mengambil data statistik" });
  }
};

// 2. Mengambil Statistik Khusus untuk Dashboard 1 Dosen
const getDosenStats = async (req, res) => {
  const { dsn_id } = req.params;

  try {
    // A. Proposal Baru (Status masih pending atau baru di-acc koordinator ke dosen ini)
    const [proposalBaru] = await db.query(
      'SELECT COUNT(*) as total FROM proposals WHERE dsn_id = ? AND status IN ("pending", "approved_koor")',
      [dsn_id],
    );

    // B. Mahasiswa Bimbingan (Proposal yang sudah di-ACC dan tidak ditolak)
    const [mhsBimbingan] = await db.query(
      'SELECT COUNT(*) as total FROM proposals WHERE dsn_id = ? AND status != "rejected"',
      [dsn_id],
    );

    // C. Jadwal Sidang (Dihitung dari tabel schedules yang terhubung ke proposal dosen ini)
    const [jadwalSidang] = await db.query(
      `SELECT COUNT(*) as total FROM schedules s
       JOIN proposals p ON s.proposal_id = p.id
       WHERE p.dsn_id = ?`,
      [dsn_id],
    );

    // Kirim paket JSON ke Frontend
    res.json({
      proposal_baru: proposalBaru[0].total,
      mahasiswa_bimbingan: mhsBimbingan[0].total,
      jadwal_sidang: jadwalSidang[0].total,
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal mengambil statistik dosen" });
  }
};

module.exports = { getDashboardStats, getDosenStats };
