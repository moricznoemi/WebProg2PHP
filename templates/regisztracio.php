<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Regisztráció";
include __DIR__ . '/header.php';
require_once "../config/config.php";

// Kapcsolódás az adatbázishoz
$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nev = $_POST['nev'];
    $jelszo = $_POST['jelszo'];

    // Feltételek ellenőrzése
    if (strlen($nev) < 8 || !preg_match('/[A-Za-z]/', $nev) || !preg_match('/[0-9]/', $nev)) {
        $message = "A felhasználónévnek legalább 8 karakter hosszúnak kell lennie, és tartalmaznia kell betűt és számot is.";
    } elseif (strlen($jelszo) < 8 || !preg_match('/[a-z]/', $jelszo) || !preg_match('/[A-Z]/', $jelszo) || !preg_match('/[0-9]/', $jelszo) || !preg_match('/[\W]/', $jelszo)) {
        $message = "A jelszónak legalább 8 karakter hosszúnak kell lennie, és tartalmaznia kell kis- és nagybetűt, számot és speciális karaktert is.";
    } else {
        // Jelszó hash-elése
        $hashed_password = password_hash($jelszo, PASSWORD_DEFAULT);

        // Adatok beszúrása az adatbázisba
        $sql = "INSERT INTO felhasznalok (nev, jelszo) VALUES ('$nev', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            $message = "Sikeresen regisztráltál";
        } else {
            $message = "Hiba történt a regisztráció során: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/beadando/assets/css/main.css" />
    <link rel="stylesheet" href="/beadando/style.css">
</head>
<body class="is-preload">

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Regisztráció</h1>
        <p>Üdvözöljük a védett fajok regisztrációs oldalán!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Regisztráljon, hogy hozzáférjen a védett fajokkal kapcsolatos további információkhoz!</h2>
        </header>

        <div class=" container">
            <section class="feature left">
                <div class="content">
                    <form method="post" action="regisztracio.php">
                        <label for="nev">Felhasználónév:</label>
                        <input type="text" name="nev" id="nev" required><br>
                        <label for="jelszo">Jelszó:</label>
                        <input type="password" name="jelszo" id="jelszo" required><br>
                        <input type="submit" value="Regisztrálok">
                    </form>
                    <p><?php echo $message; ?></p>
                    <p>Ha már van fiókja, <a href="bejelentkezes.php">jelentkezzen be</a>.</p>
                </div>
            </section>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/beadando/assets/js/jquery.min.js"></script>
    <script src="/beadando/assets/js/browser.min.js"></script>
    <script src="/beadando/assets/js/breakpoints.min.js"></script>
    <script src="/beadando/assets/js/util.js"></script>
    <script src="/beadando/assets/js/main.js"></script>

</body>
</html>
