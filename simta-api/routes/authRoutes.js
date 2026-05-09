const express = require("express");
const router = express.Router();
const { login } = require("../controllers/authController");

// Rute untuk mendarat saat hit POST /api/login
router.post("/login", login);

module.exports = router;
