const express = require("express");
const router = express.Router();
const {
  ajukanProposal,
  lihatProposal,
  updateStatus,
  plotDosen,
} = require("../controllers/proposalController");

// Daftar rute sesuai dengan fungsi di controller
router.post("/proposals", ajukanProposal); // Endpoint untuk ajukan proposal
router.get("/proposals", lihatProposal); // Endpoint untuk lihat proposal
router.patch("/proposals/:id/status", updateStatus); // Endpoint untuk ubah status
router.patch("/proposals/:id/assign-dosen", plotDosen); // Endpoint untuk plot dosen

module.exports = router;
