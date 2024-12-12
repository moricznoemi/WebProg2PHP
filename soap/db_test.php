<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $dsn = 'sqlite:' . __DIR__ . '/vedett_fajok.db';
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Adatbázis kapcsolat sikeres.\n";

    // Teszt lekérdezés
    $stmt = $pdo->query('SELECT * FROM kategoria');
    $kategoriak = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Kategóriák:\n";
    print_r($kategoriak);
} catch (PDOException $e) {
    echo 'Hiba: ' . $e->getMessage();
}
?>
