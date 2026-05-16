const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');

const app = express();

app.use(cors());
app.use(express.json());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'db_simta'
});

db.connect((err) => {

    if(err){

        console.log('Database gagal konek');

    }else{

        console.log('Database berhasil konek');

    }

});

app.get('/', (req, res) => {

    res.send('API SIMTA berjalan');

});

app.listen(5000, () => {

    console.log('Server berjalan di port 5000');

});

app.get('/api/proposals', (req, res) => {

    const sql = `
        SELECT
            proposals.id,
            proposals.judul,
            proposals.status,
            mhs.name AS mahasiswa,
            dsn.name AS dosen
        FROM proposals

        JOIN users AS mhs
        ON proposals.mhs_id = mhs.id
        JOIN users AS dsn
        ON proposals.dsn_id = dsn.id
    `;

    db.query(sql, (err, result) => {

        if(err){

            res.status(500).json(err);

        }else{

            res.json(result);

        }

    });

});

app.get('/api/dosen', (req, res) => {

    const sql = `
        SELECT
            id,
            name
        FROM users
        WHERE role = 'dsn'
    `;

    db.query(sql, (err, result) => {

        if(err){

            res.status(500).json(err);

        }else{

            res.json(result);

        }

    });

});

app.post('/api/manajemen-dosen/:id', (req, res) => {

    const id = req.params.id;

    const { dsn_id } = req.body;

    const sql = `
        UPDATE proposals
        SET dsn_id = ?
        WHERE id = ?
    `;

    db.query(sql, [dsn_id, id], (err, result) => {

        if(err){

            res.status(500).json(err);

        }else{

            res.json({
                message: 'Dosen pembimbing berhasil disimpan'
            });

        }

    });

});

app.post('/api/penjadwalan', (req, res) => {

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

            if(err){

                res.status(500).json(err);

            }else{

                res.json({
                    message: 'Jadwal berhasil disimpan'
                });

            }

        }
    );

});

app.put('/api/proposals/:id', (req, res) => {

    const id = req.params.id;

    const { status } = req.body;

    const sql = `
        UPDATE proposals
        SET status = ?
        WHERE id = ?
    `;

    db.query(sql, [status, id], (err, result) => {

        if(err){

            res.status(500).json(err);

        }else{

            res.json({
                message: 'Status proposal berhasil diupdate'
            });

        }

    });

});