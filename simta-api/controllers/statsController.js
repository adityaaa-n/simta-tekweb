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

module.exports = { getDashboardStats };
