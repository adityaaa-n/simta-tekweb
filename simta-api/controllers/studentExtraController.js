const db = require("../config/db");

// 1. Mahasiswa daftar/request tanggal ujian
const daftarUjian = async (req, res) => {
  const { proposal_id, tanggal_harapan, keterangan } = req.body;
  try {
    await db.query(
      "INSERT INTO exam_registrations (proposal_id, tanggal_harapan, keterangan) VALUES (?, ?, ?)",
      [proposal_id, tanggal_harapan, keterangan],
    );
    res
      .status(201)
      .json({ message: "Pengajuan jadwal ujian berhasil dikirim!" });
  } catch (error) {
    res.status(500).json({ message: "Gagal mengajukan ujian" });
  }
};

// 2. Monitoring Individu (Merangkum semua data 1 mahasiswa)
const getMonitoringMe = async (req, res) => {
  // Di real-world ini dari token (req.user), tapi kita pakai parameter ID untuk tes
  const { mhs_id } = req.params;
  try {
    // A. Cek Proposal
    const [proposals] = await db.query(
      "SELECT * FROM proposals WHERE mhs_id = ?",
      [mhs_id],
    );
    if (proposals.length === 0) {
      return res
        .status(404)
        .json({ message: "Kamu belum mengajukan proposal TA." });
    }
    const proposal = proposals[0];

    // B. Hitung Jumlah Bimbingan
    const [logs] = await db.query(
      "SELECT COUNT(*) as total_bimbingan FROM log_bimbingan WHERE proposal_id = ?",
      [proposal.id],
    );

    // C. Cek Jadwal Resmi
    const [schedules] = await db.query(
      "SELECT * FROM schedules WHERE proposal_id = ?",
      [proposal.id],
    );

    // D. Cek Nilai
    const [grades] = await db.query(
      "SELECT * FROM grades WHERE proposal_id = ?",
      [proposal.id],
    );

    // E. Satukan semuanya agar Frontend (Issue #18) mudah menampilkan
    res.json({
      mahasiswa_id: mhs_id,
      judul_ta: proposal.judul,
      status_keseluruhan: {
        proposal: proposal.status,
        dokumen_akhir: proposal.status_dokumen,
      },
      statistik_bimbingan: logs[0].total_bimbingan,
      info_ujian:
        schedules.length > 0
          ? schedules[0]
          : "Belum ada jadwal resmi dari Koordinator",
      nilai_akhir: grades.length > 0 ? grades[0].nilai_huruf : "Belum dinilai",
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal mengambil data monitoring" });
  }
};

module.exports = { daftarUjian, getMonitoringMe };
