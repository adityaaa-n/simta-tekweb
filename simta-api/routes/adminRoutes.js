const express = require('express');
const router = express.Router();
const db = require('../config/db');

router.get('/verifikasi', async (req, res) => {

    try {

        const [rows] = await db.query(`
            SELECT 
                proposals.id,
                users.name AS mahasiswa,
                proposals.judul,
                proposals.status
            FROM proposals
            JOIN users
            ON proposals.mhs_id = users.id
        `);

        res.json(rows);

    } catch (error) {

        res.status(500).json({
            message: error.message
        });

    }

});

router.put('/verifikasi/:id', async (req, res) => {

    try {

        const { status } = req.body;

        await db.query(`
            UPDATE proposals
            SET status = ?
            WHERE id = ?
        `, [status, req.params.id]);

        res.json({
            message: 'Status berhasil diperbarui'
        });

    } catch (error) {

        res.status(500).json({
            message: error.message
        });

    }

});

module.exports = router;