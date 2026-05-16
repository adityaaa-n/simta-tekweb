require("dotenv").config();

const express = require("express");
const cors = require("cors");
const mysql = require("mysql2");

const app = express();

app.use(cors());
app.use(express.json());

// Koneksi Database
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "db_simta"
});

db.connect((err) => {

    if (err) {

        console.log("Database gagal konek");

    } else {

        console.log("Database berhasil konek");

    }

});

// Import Routes
const authRoutes = require("./routes/authRoutes");
const proposalRoutes = require("./routes/proposalRoutes");
const guidanceRoutes = require("./routes/guidanceRoutes");
const finalRoutes = require("./routes/finalRoutes");
const statsRoutes = require("./routes/statsRoutes");
const documentRoutes = require("./routes/documentRoutes");
const studentExtraRoutes = require("./routes/studentExtraRoutes");
const adminRoutes = require("./routes/adminRoutes");
const kaprodiRoutes = require("./routes/kaprodiRoutes");
// const koordinatorRoutes = require("./routes/koordinatorRoutes");

// Daftarkan Routes
app.use("/api", authRoutes);
app.use("/api", proposalRoutes);
app.use("/api", guidanceRoutes);
app.use("/api", finalRoutes);
app.use("/api", statsRoutes);
app.use("/api", documentRoutes);
app.use("/api", studentExtraRoutes);

app.use("/api/admin", adminRoutes);
app.use("/api/kaprodi", kaprodiRoutes);
//app.use("/api/koordinator", koordinatorRoutes);

// API Koordinator
app.get("/api/proposals", (req, res) => {

    const sql = `
        SELECT
            proposals.id,
            proposals.judul,
            proposals.status,
            mhs.name AS mahasiswa,
            dsn.name AS dosen
        FROM proposals

        LEFT JOIN users AS mhs
        ON proposals.mhs_id = mhs.id

        LEFT JOIN users AS dsn
        ON proposals.dsn_id = dsn.id
    `;

    db.query(sql, (err, result) => {

        if (err) {

            res.status(500).json(err);

        } else {

            res.json(result);

        }

    });

});

app.get("/api/dosen", (req, res) => {

    const sql = `
        SELECT
            id,
            name
        FROM users
        WHERE role = 'dsn'
    `;

    db.query(sql, (err, result) => {

        if (err) {

            res.status(500).json(err);

        } else {

            res.json(result);

        }

    });

});

app.post("/api/manajemen-dosen/:id", (req, res) => {

    const id = req.params.id;

    const { dsn_id } = req.body;

    const sql = `
        UPDATE proposals
        SET dsn_id = ?
        WHERE id = ?
    `;

    db.query(sql, [dsn_id, id], (err, result) => {

        if (err) {

            res.status(500).json(err);

        } else {

            res.json({
                message: "Dosen pembimbing berhasil disimpan"
            });

        }

    });

});

app.post("/api/penjadwalan", (req, res) => {

    const {
        proposal_id,
        tanggal,
        waktu,
        ruang
    } = req.body;

    const sql = `
        INSERT INTO schedules
        (proposal_id, tanggal, waktu, ruang)
        VALUES (?, ?, ?, ?)
    `;

    db.query(
        sql,
        [proposal_id, tanggal, waktu, ruang],
        (err, result) => {

            if (err) {

                res.status(500).json(err);

            } else {

                res.json({
                    message: "Jadwal berhasil disimpan"
                });

            }

        }
    );

});

app.put("/api/proposals/:id", (req, res) => {

    const id = req.params.id;

    const { status } = req.body;

    const sql = `
        UPDATE proposals
        SET status = ?
        WHERE id = ?
    `;

    db.query(sql, [status, id], (err, result) => {

        if (err) {

            res.status(500).json(err);

        } else {

            res.json({
                message: "Status proposal berhasil diupdate"
            });

        }

    });

});

// Route Default
app.get("/", (req, res) => {

    res.send("Server API SIMTA berjalan 🚀");

});

// Jalankan Server
const PORT = process.env.PORT || 5000;

app.listen(PORT, () => {

    console.log(`Server API menyala di port ${PORT}`);

});