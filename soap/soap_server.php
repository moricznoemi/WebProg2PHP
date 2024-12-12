<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/xml');

class SzeleromuvekService {
    private $pdo;

    public function __construct() {
        $dsn = 'sqlite:' . __DIR__ . '/vedett_fajok.db';
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getErtekek() {
        $stmt = $this->pdo->query('SELECT * FROM ertek');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllatok($katid) {
        $stmt = $this->pdo->prepare('SELECT * FROM allat WHERE katid = ?');
        $stmt->execute([$katid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKategoriak {
        $stmt = $this->pdo->prepare('SELECT * FROM kategoria');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$options = [
    'uri' => 'http://localhost/beadando/soap_server.php',
    'location' => 'http://localhost/beadando/soap_server.php'
];

$server = new SoapServer(null, $options);
$server->setClass('VedettfajokService');
$server->handle();
?>
