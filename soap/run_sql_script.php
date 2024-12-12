<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $dsn = 'sqlite:' . __DIR__ . '/vedett_fajok.db';
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL szkript futtatása
    $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS ertek (
        id INTEGER PRIMARY KEY,
        forint INTEGER NOT NULL
    );

    CREATE TABLE IF NOT EXISTS kategoria (
        id INTEGER PRIMARY KEY,
        nev TEXT NOT NULL,
        
    );

    CREATE TABLE IF NOT EXISTS allat (
        id INTEGER PRIMARY KEY,
        nev TEXT NOT NULL,
        ertekid INTEGER NOT NULL,
        ev INTEGER DEFAULT NULL,
        katid INTEGER NOT NULL,
        FOREIGN KEY (ertekid) REFERENCES ertek(id)
        FOREIGN KEY (katid) REFERENCES kategoria(id)
    );

    INSERT INTO ertek (forint) VALUES (2000000);
    INSERT INTO kategoria (katid, nev) VALUES (1, 'Példa kategória');
    INSERT INTO allat (nev, ertekid, ev) VALUES ('Példa állat', 1, 2000);

    -- További adatok beszúrása itt...
    SQL;

    $pdo->exec($sql);

    echo "Táblák és adatok sikeresen létrehozva.\n";
} catch (PDOException $e) {
    echo 'Hiba: ' . $e->getMessage();
}
?>
