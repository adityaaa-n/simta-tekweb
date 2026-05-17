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
  getProposalsForReviewDosen,
} = require("../controllers/proposalController");

// Endpoint utama Proposal
router.post("/proposals", ajukanProposal);
router.get("/proposals", lihatProposal);
router.patch("/proposals/:id/status", updateStatus);
router.patch("/proposals/:id/assign-dosen", plotDosen);

// Endpoint spesifik Dosen
router.get("/proposals/dosen/:dsn_id", lihatBimbinganDosen);
router.get("/stats/dosen/:dsn_id", getStatsDosen);
router.get("/guidance-logs/dosen/:dsn_id", getLogsByDosen);
router.get("/proposals/review/dosen/:dsn_id", getProposalsForReviewDosen);

module.exports = router;
