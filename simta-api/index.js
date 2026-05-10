require("dotenv").config();
const express = require("express");
const cors = require("cors");

const app = express();

app.use(cors());
app.use(express.json());

// Import Routes
const authRoutes = require("./routes/authRoutes");
const proposalRoutes = require("./routes/proposalRoutes");
const guidanceRoutes = require("./routes/guidanceRoutes");
const finalRoutes = require("./routes/finalRoutes");
const statsRoutes = require("./routes/statsRoutes"); // <--- BARU

// Daftarkan Routes
app.use("/api", authRoutes);
app.use("/api", proposalRoutes);
app.use("/api", guidanceRoutes);
app.use("/api", finalRoutes);
app.use("/api", statsRoutes); // <--- BARU

app.get("/", (req, res) => {
  res.send("Server API SIMTA berjalan normal 🚀");
});

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
  console.log(`Server API menyala di port ${PORT}`);
});
