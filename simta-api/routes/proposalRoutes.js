const express = require("express");
const router = express.Router();
const {
  ajukanProposal,
  lihatProposal,
  updateStatus,
  plotDosen,
  lihatBimbinganDosen,
  getStatsDosen,
  getLogsByDosen,
  getProposalsForReviewDosen, // <-- Import fungsi baru
} = require("../controllers/proposalController");

router.post("/proposals", ajukanProposal);
router.get("/proposals", lihatProposal);
router.patch("/proposals/:id/status", updateStatus);
router.patch("/proposals/:id/assign-dosen", plotDosen);

router.get("/proposals/dosen/:dsn_id", lihatBimbinganDosen);
router.get("/stats/dosen/:dsn_id", getStatsDosen);
router.get("/guidance-logs/dosen/:dsn_id", getLogsByDosen);

// <-- Rute baru untuk halaman Review Dosen
router.get("/proposals/review/dosen/:dsn_id", getProposalsForReviewDosen);

module.exports = router;
