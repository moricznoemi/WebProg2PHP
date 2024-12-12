<?php
    $requestUrlPath = $_SERVER['REQUEST_URI'];
    $isHome = $requestUrlPath == 'beadando' || $requestUrlPath == '/beadando/' || str_contains($requestUrlPath, 'index');
    require_once ( $isHome ? '' : '../' ) . 'config/config.php';
?>
<?php include __DIR__ . '/menu.php'; ?>
