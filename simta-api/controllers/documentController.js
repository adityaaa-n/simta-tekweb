const path = require("path");

// 1. Fungsi ketika Mahasiswa berhasil upload file
const uploadFisik = (req, res) => {
  // Jika lewat filter multer, file otomatis tersimpan. Kita tinggal beri respons sukses.
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
  // Mencari lokasi asli file di laptop kamu
  const filePath = path.join(__dirname, "../uploads/documents/", filename);

  res.download(filePath, (err) => {
    if (err) {
      res.status(404).json({ message: "File tidak ditemukan di server!" });
    }
  });
};

module.exports = { uploadFisik, downloadDokumen };
