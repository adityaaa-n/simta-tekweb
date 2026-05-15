const express = require("express");
const router = express.Router();
const {
  tambahLog,
  lihatLog,
  validasiLog,
} = require("../controllers/guidanceController");

router.post("/guidance-logs", tambahLog); // Input log
router.get("/guidance-logs/:proposal_id", lihatLog); // Lihat riwayat
router.patch("/guidance-logs/:id/validate", validasiLog); // Validasi dosen

module.exports = router;
