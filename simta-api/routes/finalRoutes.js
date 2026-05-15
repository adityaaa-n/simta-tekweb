const express = require("express");
const router = express.Router();
const {
  buatJadwal,
  inputNilai,
  uploadDokumen,
  verifikasiDokumen,
} = require("../controllers/finalController");

router.post("/schedules", buatJadwal);
router.post("/grades", inputNilai);
router.post("/documents", uploadDokumen);
router.patch("/documents/:id/verify", verifikasiDokumen);

module.exports = router;
