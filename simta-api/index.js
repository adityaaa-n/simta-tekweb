require("dotenv").config(); // Baris paling atas agar variabel .env terbaca di seluruh file
const express = require("express");
const cors = require("cors");

const app = express();

// Middleware Bawaan
app.use(cors()); // Mengizinkan Laravel/Frontend mengambil data dari sini
app.use(express.json()); // Agar bisa membaca data format JSON

// Import Routes
const authRoutes = require("./routes/authRoutes");
const proposalRoutes = require("./routes/proposalRoutes");
const guidanceRoutes = require("./routes/guidanceRoutes");
const finalRoutes = require("./routes/finalRoutes"); // <--- BARU: Mengimpor jalur tahap akhir

// Daftarkan Routes
app.use("/api", authRoutes);
app.use("/api", proposalRoutes);
app.use("/api", guidanceRoutes);
app.use("/api", finalRoutes); // <--- BARU: Mendaftarkan jalur tahap akhir ke server

// Tampilan awal kalau server dibuka di browser
app.get("/", (req, res) => {
  res.send("Server API SIMTA berjalan normal 🚀");
});

// Jalankan Server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
  console.log(`Server API menyala di port ${PORT}`);
});
