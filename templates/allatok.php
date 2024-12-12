<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Védett állatok";
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
        <h1>Védett állatok</h1>
        <p>Információk néhány védett állatról.</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Ismerd meg a védett állatokat!</h2>
        </header>

        <div class=" container box">
            <section class="feature right">
                <a href="#" class="image icon solid fa-info"><img src="/beadando/images/pic01.jpg" alt="" /></a>
                <div class="content">
                    <h3>Farkas</h3>
                    <p>Hazánkban a farkasok 1993-ban lettek fokozottan védetté nyilvánítva. Eszmei értékük 250.000 Ft.</p>
                </div>
            </section>
        </div>
        <div class=" container box">
            <section class="feature right">
                <a href="#" class="image icon solid fa-info"><img src="/beadando/images/pic01.jpg" alt="" /></a>
                <div class="content">
                    <h3>Vidra</h3>
                    <p>Hazánkban a vidrák 1974-ben lettek fokozottan védetté nyilvánítva. Eszmei értékük 250.000 Ft.</p>
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
