<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Kapcsolat";
include __DIR__ . '/../api/db.php';
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/beadando/assets/css/main.css" />
    <link rel="stylesheet" href="/beadando/assets/css/kapcsolat.css" />
    <link rel="stylesheet" href="/beadando/style.css">
</head>
<body class="is-preload">
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Kapcsolat</h1>
        <p>Elérhetőségem.</p>
    </div>

    <!-- Main -->
    <div id="main" class="container">
        <header class="major medium">
            <h2>Elérhetőségem</h2>
        </header>

        <section class="feature left">
        <div class="content">
                <h3>Móricz Noémi</h3>
                <p>BVARSQ</p>
                <p>moricznoemi</p>
                <p>beadando@beadando.hu</p>
                
            </div>
            <div class="content">
                <h3>Móricz Noémi</h3>
                <p>BVARSQ</p>
                <p>noemisecond</p>
                <p>beadando2@beadando.hu</p>
            </div>
            
        </section>
    </div>

    <!-- Scripts -->
    <script src="/beadando/assets/js/jquery.min.js"></script>
    <script src="/beadando/assets/js/browser.min.js"></script>
    <script src="/beadando/assets/js/breakpoints.min.js"></script>
    <script src="/beadando/assets/js/util.js"></script>
    <script src="/beadando/assets/js/main.js"></script>
</body>
</html>
