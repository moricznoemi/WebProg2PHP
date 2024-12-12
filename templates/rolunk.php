<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Rólunk";
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
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Rólunk</h1>
        <p>Üdvözöllek a Webprogramozás projektem oldalán!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Webalkalmazásomat a Web-Programozás II. kurzus sikeres teljesítéséhez készítettem.
            <br />
            Projektem a magyarországi védett fajokkal foglalkozik.</h2>
        </header>

        <div class="container box">
            <section class="feature right">
                <a href="#" class="image icon solid fa-user-friends"><img src="/beadando/images/pic01.jpg" alt="" /></a>
                <div class="content">
                    <h3>Készítette:</h3>
                    <p class="text-muted">Móricz Noémi</p>
                    <p class="text-muted">Neumann János Egyetem, Kecskemét</p>
                </div>
            </section>
            <section class="feature left">
                <a href="#" class="image icon solid fa-database"><img src="/beadando/images/pic02.jpg" alt="" /></a>
                <div class="content">
                    <h3>Választott adatbázisom:</h3>
                    <p class="text-muted">Védett fajok</p>
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
