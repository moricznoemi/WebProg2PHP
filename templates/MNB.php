<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "MNB";
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/beadando/assets/css/main.css" />
    <link rel="stylesheet" href="/beadando/assets/css/mnb.css" />
    <link rel="stylesheet" href="/beadando/style.css">
</head>
<body class="is-preload">
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>MNB</h1>
        <p>Üdvözöljük az MNB oldalán!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Információk az MNB-ről</h2>
        </header>

        <!-- Exchange Rate Form -->
        <div class=" container">
            <section class="box">
                <h3>Árfolyam lekérdezés</h3>
                <form method="post">
                    <label for="date">Dátum:</label>
                    <input type="date" id="date" name="date" required>
                    <label for="currencyPair">Devizapár:</label>
                    <input type="text" id="currencyPair" name="currencyPair" required>
                    <button type="submit">Lekérdezés</button>
                </form>

                <?php
                    $options = [
                        'uri' => 'http://www.mnb.hu/arfolyamok.asmx?wsdl',
                        'location' => 'http://www.mnb.hu/arfolyamok.asmx'
                    ];

                    $client = new SoapClient($options['uri'], $options);

                    // Egy adott devizapár adott napján mennyi volt az árfolyam
                    if (isset($_POST['date']) && isset($_POST['currencyPair'])) {
                        $date = $_POST['date'];
                        $currencyPair = $_POST['currencyPair'];

                        try {
                            $response = $client->GetExchangeRates([
                                'startDate' => $date,
                                'endDate' => $date,
                                'currencyNames' => $currencyPair
                            ]);

                            $xml = simplexml_load_string($response->GetExchangeRatesResult);
                            $rate = (double) $xml->Day->Rate;

                            echo "Az $currencyPair árfolyama $date napon: $rate\n";
                        } catch (SoapFault $e) {
                            echo 'Hiba: ' . $e->getMessage();
                        }
                    }
                ?>
            </section>
        </div>

        <div class=" container">
            <section class="box">
                <h3>Havi árfolyam lekérdezés</h3>
                <form method="post">
                    <label for="month">Hónap:</label>
                    <input type="month" id="month" name="month" required>
                    <label for="currencyPair">Devizapár:</label>
                    <input type="text" id="currencyPair" name="currencyPair" required>
                    <button type="submit">Lekérdezés</button>
                </form>

                <?php
                // Egy adott devizapár egy adott hónapjában minden napra mennyi volt az árfolyam
                if (isset($_POST['month']) && isset($_POST['currencyPair'])) {
                    $month = $_POST['month'];
                    $currencyPair = $_POST['currencyPair'];

                    $startDate = $month . '-01';
                    $endDate = date("Y-m-t", strtotime($startDate)); // Az adott hónap utolsó napja

                    try {
                        $response = $client->GetExchangeRates([
                            'startDate' => $startDate,
                            'endDate' => $endDate,
                            'currencyNames' => $currencyPair
                        ]);

                        $xml = simplexml_load_string($response->GetExchangeRatesResult);
                        $rates = [];

                        foreach ($xml->Day as $day) {
                            $date = (string)$day['date'];
                            $rate = (double)$day->Rate;
                            $rates[$date] = $rate;
                        }

                        // Ellenőrzés: Adatok kiírása a konzolra
                        echo "<script>console.log(" . json_encode($rates) . ");</script>";

                        // Adatok megjelenítése táblázatban
                        echo "<table class='table default' border='1'>";
                        echo "<thead><tr><th>Dátum</th><th>Árfolyam</th></tr></thead>";
                        echo "<tbody>";
                        foreach ($rates as $date => $rate) {
                            echo "<tr><td>$date</td><td>$rate</td></tr>";
                        }
                        echo "</tbody></table>";

                        // Adatok átadása a JavaScript fájlnak
                        echo "<div id='chartLabels' style='display:none;'>" . json_encode(array_keys($rates)) . "</div>";
                        echo "<div id='chartData' style='display:none;'>" . json_encode(array_values($rates)) . "</div>";
                        echo "<div id='chartLabel' style='display:none;'>$currencyPair árfolyamai</div>";

                        // Adatok megjelenítése grafikonon (Chart.js használatával)
                        echo "<canvas id='myChart'></canvas>";
                        echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
                        echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: " . json_encode(array_keys($rates)) . ",
                                    datasets: [{
                                        label: '$currencyPair árfolyamai',
                                        data: " . json_encode(array_values($rates)) . ",
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: false
                                        }
                                    }
                                }
                            });
                        });
                    </script>";
                    } catch (SoapFault $e) {
                        echo 'Hiba: ' . $e->getMessage();
                    }
                }
                ?>
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
