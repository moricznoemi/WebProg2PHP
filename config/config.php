<?php
// Konfigurációs beállítások
$appName = "Védett fajok";
$version = "1.0.0";

define('SERVER_NAME', isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'localhost');
define('USERNAME', isset($_ENV['DB_USERNAME']) ? $_ENV['DB_USERNAME'] : 'root');
define('PASSWORD', isset($_ENV['DB_PWD']) ? $_ENV['DB_PWD'] : '');
define('DB_NAME', isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : 'vedett_fajok');

?>
