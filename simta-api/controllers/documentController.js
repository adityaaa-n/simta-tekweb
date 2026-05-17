const path = require("path");
const db = require("../config/db");

// 1. Fungsi ketika Mahasiswa berhasil upload file
const uploadFisik = (req, res) => {
  if (!req.file) {
    return res
      .status(400)
      .json({ message: "Tidak ada file PDF yang diunggah" });
  }

  res.status(200).json({
    message: "Dokumen fisik berhasil diunggah!",
    filename: req.file.filename,
    file_path: `/uploads/documents/${req.file.filename}`,
  });
};

// 2. Fungsi untuk Dosen/Admin mengunduh file
const downloadDokumen = (req, res) => {
  const filename = req.params.filename;
  const filePath = path.join(__dirname, "../uploads/documents/", filename);

  res.download(filePath, (err) => {
    if (err) {
      res.status(404).json({ message: "File tidak ditemukan di server!" });
    }
  });
};

// 3. Simpan rekam jejak ke database proposals
const saveDocumentRecord = async (req, res) => {
  const { proposal_id, file_path } = req.body;
  try {
    await db.query(
      "UPDATE proposals SET file_path = ?, status_dokumen = 'menunggu_verifikasi' WHERE id = ?",
      [file_path, proposal_id]
    );
    res.json({ message: "Data dokumen berhasil disimpan ke database." });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Gagal menyimpan data dokumen." });
  }
};

module.exports = { uploadFisik, downloadDokumen, saveDocumentRecord };
