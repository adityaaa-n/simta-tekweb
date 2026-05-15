const express = require("express");
const router = express.Router();
const {
  ajukanProposal,
  lihatProposal,
  updateStatus,
  plotDosen,
  lihatBimbinganDosen, // <-- Ini yang tadi hilang
} = require("../controllers/proposalController");

router.post("/proposals", ajukanProposal);
router.get("/proposals", lihatProposal);
router.patch("/proposals/:id/status", updateStatus);
router.patch("/proposals/:id/assign-dosen", plotDosen);

// <-- Rute ini yang tadi hilang makanya error Cannot GET
router.get("/proposals/dosen/:dsn_id", lihatBimbinganDosen);

module.exports = router;
