<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/config.php";

error_reporting(0);
ob_start();
require_once '../TCPDF/tcpdf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_kategoria = $_POST['kategoria'];
    $selected_allat = $_POST['allat'];
    $selected_forint = $_POST['forint'];

    // Kapcsolódás az adatbázishoz
    $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Kategóriák lekérése
    $kategoria_query = "SELECT id, nev FROM kategoria WHERE nev = '$selected_kategoria'";
    $kategoria_result = $conn->query($kategoria_query);

    // Állatok lekérése
    $allat_query = "SELECT id, nev, ertekid, ev, katid FROM allat WHERE nev = '$selected_allat'";
    $allat_result = $conn->query($allat_query);

    // Eszmei érték lekérése
    $ertek_query = "SELECT id, forint FROM ertek WHERE forint = '$selected_forint'";
    $ertek_result = $conn->query($ertek_query);

    // PDF generálása
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Fejléc
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'PDF generáló eredmények', 0, 1, 'C');

    // Kategória adatok hozzáadása
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Kategória: ' . $selected_kategoria, 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    while ($row = $kategoria_result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, "ID: " . $row['id'] . ", Név: " . $row['nev']);
    }

    // Állat adatok hozzáadása
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Állat: ' . $selected_allat, 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    while ($row = $allat_result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, "ID: " . $row['id'] . ", Név: " . $row['nev'] . ", Érték ID: " . $row['ertekid'] . ", Év: " . $row['ev'] . ", Kategória ID: " . $row['katid']);
    }

    // Érték adatok hozzáadása
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Érték: ' . $selected_forint, 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    while ($row = $ertek_result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, "Forint: " . $row['forint']);
    }

    // PDF mentése és letöltése
    ob_end_clean();
    $pdf->Output('generated_pdf.pdf', 'D');

    $conn->close();
    exit;
}

$title = "PDF";

// Kapcsolódás az adatbázishoz
$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kategóriák lekérése
$kategoria_query = "SELECT DISTINCT nev FROM kategoria";
$kategoria_result = $conn->query($kategoria_query);

// Állatok lekérése
$allat_query = "SELECT nev FROM allat";
$allat_result = $conn->query($allat_query);

// Értékek lekérése
$ertek_query = "SELECT DISTINCT forint FROM ertek";
$ertek_result = $conn->query($ertek_query);
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/beadando/assets/css/main.css" />
    <link rel="stylesheet" href="/beadando/style.css">
    <style>
        .container-box {
            max-width: 800px;
            margin: 40px auto;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9); /* Átlátszó háttér */
            padding-left: 20px; /* Belső margó bal oldalon */
            padding-right: 20px; /* Belső margó jobb oldalon */
        }

        form {
            padding: 20px; /* Belső margó a form elemekhez */
        }

        form label, form select, form input[type="submit"] {
            display: block;
            margin-bottom: 10px;
            width: calc(100% - 40px); /* Szélesség csökkentése, hogy ne érjen a széléig */
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body class="is-preload">
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>PDF</h1>
        <p>Üdvözöljük a PDF készítő oldalán!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>PDF generáló</h2>
        </header>

      <div class="container">
        <section class="box">
          <!-- Lenyíló listák -->
          <form method="post" action="">
            <label for="kategoria">Kategória:</label>
            <select name="kategoria" id="kategoria">
                <?php while($row = $kategoria_result->fetch_assoc()): ?>
                  <option value="<?php echo $row['nev']; ?>"><?php echo $row['nev']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="allat">Állat:</label>
            <select name="allat" id="allat">
                <?php while($row = $allat_result->fetch_assoc()): ?>
                  <option value="<?php echo $row['nev']; ?>"><?php echo $row['nev']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="forint">Eszmei érték:</label>
            <select name="forint" id="forint">
                <?php while($row = $ertek_result->fetch_assoc()): ?>
                  <option value="<?php echo $row['forint']; ?>"><?php echo $row['forint']; ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Generálás">
          </form>
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
