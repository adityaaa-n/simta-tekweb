const express = require("express");
const router = express.Router();

const {
  uploadFisik,
  downloadDokumen,
  saveDocumentRecord,
} = require("../controllers/documentController");
const upload = require("../middleware/upload");

router.post("/documents/upload", upload.single("dokumen_pdf"), uploadFisik);
router.post("/documents", saveDocumentRecord);
router.get("/download/:filename", downloadDokumen);

module.exports = router;
