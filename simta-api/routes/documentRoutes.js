const express = require("express");
const router = express.Router();

// Import otak dan satpam kita
const {
  uploadFisik,
  downloadDokumen,
} = require("../controllers/documentController");
const upload = require("../middleware/upload");

// Jalur POST untuk Upload (menggunakan middleware 'upload.single' untuk menangkap 1 file)
router.post("/documents/upload", upload.single("dokumen_pdf"), uploadFisik);

// Jalur GET untuk Download
router.get("/download/:filename", downloadDokumen);

module.exports = router;
