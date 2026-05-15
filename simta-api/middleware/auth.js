const jwt = require("jsonwebtoken");

const verifyToken = (req, res, next) => {
  const bearerHeader = req.headers["authorization"];
  if (!bearerHeader) {
    return res
      .status(403)
      .json({ message: "Akses ditolak. Token tidak ditemukan!" });
  }
  const token = bearerHeader.split(" ")[1];
  try {
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    req.user = decoded; // Simpan role dan data user
    next();
  } catch (err) {
    return res
      .status(401)
      .json({ message: "Token tidak valid atau kadaluarsa!" });
  }
};

module.exports = verifyToken;
