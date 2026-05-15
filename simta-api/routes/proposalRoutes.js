const express = require("express");
const router = express.Router();
const {
  ajukanProposal,
  lihatProposal,
  updateStatus,
  plotDosen,
  lihatBimbinganDosen,
  getStatsDosen, // <-- Import fungsi baru
} = require("../controllers/proposalController");

router.post("/proposals", ajukanProposal);
router.get("/proposals", lihatProposal);
router.patch("/proposals/:id/status", updateStatus);
router.patch("/proposals/:id/assign-dosen", plotDosen);

// Rute untuk melihat mahasiswa bimbingan spesifik
router.get("/proposals/dosen/:dsn_id", lihatBimbinganDosen);

// Rute baru untuk Statistik Dashboard
router.get("/stats/dosen/:dsn_id", getStatsDosen);

module.exports = router;
