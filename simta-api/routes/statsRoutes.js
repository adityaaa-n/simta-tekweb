const express = require("express");
const router = express.Router();
const { getDashboardStats } = require("../controllers/statsController");

// Kaprodi mengakses URL ini untuk mendapat rangkuman data
router.get("/stats", getDashboardStats);

module.exports = router;
