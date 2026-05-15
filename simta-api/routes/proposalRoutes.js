const express = require("express");
const router = express.Router();
const {
  ajukanProposal,
  lihatProposal,
  updateStatus,
  plotDosen,
  lihatBimbinganDosen, // Import fungsi baru
} = require("../controllers/proposalController");

router.post("/proposals", ajukanProposal);
router.get("/proposals", lihatProposal);
router.patch("/proposals/:id/status", updateStatus);
router.patch("/proposals/:id/assign-dosen", plotDosen);

// Rute baru untuk mengambil mahasiswa bimbingan per dosen
router.get("/proposals/dosen/:dsn_id", lihatBimbinganDosen);

module.exports = router;
