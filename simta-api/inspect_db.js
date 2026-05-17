const mysql = require('mysql2');
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'db_simta'
});

db.connect(err => {
    if (err) throw err;
    db.query('SHOW TABLES', (err, tables) => {
        console.log("\n=== SEMUA TABEL DALAM db_simta ===");
        console.table(tables);
        process.exit(0);
    });
});
