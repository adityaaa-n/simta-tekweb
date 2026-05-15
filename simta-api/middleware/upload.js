const multer = require("multer");
const path = require("path");
const fs = require("fs");

// Memastikan folder penyimpanan tersedia (otomatis dibuat jika belum ada)
const dir = "./uploads/documents";
if (!fs.existsSync(dir)) {
  fs.mkdirSync(dir, { recursive: true });
}

// Konfigurasi tempat simpan dan nama file
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, dir);
  },
  filename: (req, file, cb) => {
    // Menambahkan angka acak 1-1000 agar makin unik (Double Protection)
    const uniqueSuffix = Date.now() + "-" + Math.round(Math.random() * 1e3);
    cb(null, uniqueSuffix + path.extname(file.originalname));
  },
});

// Filter khusus PDF
const fileFilter = (req, file, cb) => {
  if (file.mimetype === "application/pdf") {
    cb(null, true);
  } else {
    cb(new Error("Gagal! Hanya file PDF yang diperbolehkan."), false);
  }
};

// Bungkus semua aturan ke dalam variabel 'upload' (Maksimal 5MB)
const upload = multer({
  storage: storage,
  limits: { fileSize: 5 * 1024 * 1024 }, // 5 MB
  fileFilter: fileFilter,
});

module.exports = upload;
