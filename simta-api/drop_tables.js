const mysql = require('mysql2');
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'db_simta'
});

db.connect(err => {
    if (err) throw err;
    const sql = 'DROP TABLE IF EXISTS bimbingans, dokumens, pengajuans, ujians;';
    db.query(sql, (err, result) => {
        if (err) {
            console.log("Error dropping tables:", err.message);
        } else {
            console.log("Berhasil menghapus tabel: bimbingans, dokumens, pengajuans, ujians.");
        }
        
        // Cek sisa tabel
        db.query('SHOW TABLES', (err, tables) => {
            console.log("\n=== SISA TABEL DALAM db_simta ===");
            console.table(tables);
            process.exit(0);
        });
    });
});
