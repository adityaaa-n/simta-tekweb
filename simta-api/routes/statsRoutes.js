const express = require("express");
const router = express.Router();
const {
  getDashboardStats,
  getDosenStats,
} = require("../controllers/statsController");

// Kaprodi mengakses URL ini untuk mendapat rangkuman data
router.get("/stats", getDashboardStats);

// Dosen mengakses URL ini untuk mendapat statistik dashboard pribadinya
router.get("/stats/dosen/:dsn_id", getDosenStats);

module.exports = router;
