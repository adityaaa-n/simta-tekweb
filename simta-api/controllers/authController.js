const db = require("../config/db");
const jwt = require("jsonwebtoken");
const bcrypt = require("bcryptjs");

const login = async (req, res) => {
  const { email, password } = req.body;

  try {
    // 1. Cek apakah email ada di database
    const [users] = await db.query("SELECT * FROM users WHERE email = ?", [
      email,
    ]);
    if (users.length === 0)
      return res.status(404).json({ message: "Email tidak ditemukan!" });

    const user = users[0];

    // 2. Cek apakah password cocok (asumsi password di DB belum di-hash, kalau sudah pakai bcrypt.compare)
    if (password !== user.password) {
      return res.status(401).json({ message: "Password salah!" });
    }

    // 3. Buat Karcis (Token) untuk masuk ke aplikasi
    const token = jwt.sign(
      { id: user.id, role: user.role, name: user.name },
      process.env.JWT_SECRET,
      { expiresIn: "8h" }, // Token hangus dalam 8 jam
    );

    // 4. Kirim respon sukses ke Frontend
    res.json({
      message: "Login Berhasil",
      token: token,
      user: { id: user.id, name: user.name, role: user.role },
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({ message: "Terjadi kesalahan pada server" });
  }
};

module.exports = { login };
