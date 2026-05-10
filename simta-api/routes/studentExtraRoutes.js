const express = require("express");
const router = express.Router();
const {
  daftarUjian,
  getMonitoringMe,
} = require("../controllers/studentExtraController");

router.post("/exam-registration", daftarUjian);

// Menggunakan :mhs_id agar gampang ditest di Thunder Client
router.get("/monitoring/me/:mhs_id", getMonitoringMe);

module.exports = router;
