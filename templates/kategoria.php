<?php
$title = "Kategóriák";
include __DIR__ . '/header.php';
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
        <h1>Kategóriák</h1>
        <p>Bemutatjuk, hogy a védett állatok milyen rendszertani kategóriába tartoznak.</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Fedezd fel, hogy milyen rendszertani kategóriákba sorolhatók Magyarország védett fajai!</h2>
        </header>

        <div class=" container box">
            <section class="feature right">
                <a href="#" class="image icon solid fa-fan"><img src="/beadando/images/pic01.jpg" alt="" /></a>
                <div class="content">
                    <h3>Kategóriák</h3>
                    <p>Magyarországon 8 kategóriát találhatunk: Halak, körszájúak, madarak, kétéltűek, puhatestűek, hüllők, emlősök és ízeltlábúak.</p>
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
