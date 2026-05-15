const express = require('express');
const router = express.Router();

router.get('/stats', async (req, res) => {

    res.json({
    mahasiswaAktif: 120,
    proposalDisetujui: 85,
    seminar: 80,
    ujian: 65,
    lulus: 60
});

});

module.exports = router;