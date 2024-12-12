<?php
$options = [
    'uri' => 'http://localhost/beadando/soap/soap_server.php',
    'location' => 'http://localhost/beadando/soap/soap_server.php'
];

$client = new SoapClient(null, $options);

try {
    // Kategóriák lekérdezése
    $kategoriak = $client->getKategoriak();
    echo "Kategóriák:<br/>";
    print_r($kategoriak);
    echo "<br/>";

    // Állatok lekérdezése az 1-es kategóriában
    $allatok = $client->getAllatok(1); // Példa kategória ID
    echo "Állatok az 1-es kategóriában:<br/>";
    print_r($allatok);
    echo "<br/>";

    // Értékek lekérdezése az 1810-es állathoz
    $ertekek = $client->getErtekek(1810); // Példa állat ID
    echo "Eszmei érték a 1810-es azonosítójú állathoz:<br/>";
    print_r($ertekek);
    echo "<br/>";
} catch (SoapFault $e) {
    echo 'Hiba: ' . $e->getMessage();
}
?>
