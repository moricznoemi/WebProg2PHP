<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/config.php";

// Kapcsolódás az adatbázishoz
$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['nev'])) {
    $nev = $_SESSION['nev'];

    // Bejelentkezési állapot frissítése
    $update_sql = "UPDATE felhasznalok SET bejelentkezve = FALSE WHERE nev = '$nev'";
    $conn->query($update_sql);

    session_destroy();
}

header("Location: /beadando/");
exit;
