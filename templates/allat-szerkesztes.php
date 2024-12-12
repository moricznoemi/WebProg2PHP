<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Állatok</title>
    <link rel="stylesheet" href="/beadando/assets/css/main.css" />
    <link rel="stylesheet" href="/beadando/assets/css/allat-szerkesztese.css" />
    <link rel="stylesheet" href="/beadando/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body class="is-preload">
<?php include __DIR__ . '/header.php';?>

<!-- Header -->
<div id="header">
    <span class="logo icon fa-paper-plane"></span>
    <h1>Védett állatok</h1>
    <p>Üdvözöljük a Védett állatok szerkesztése oldalon!</p>
</div>

<!-- Main -->
<div id="main">
    <?php
    $curl = curl_init();
    $url = $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);

    include "models.php";

    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
        $id = $query['id'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:80/beadando/rest/allat-rest.php?id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        $allat = new Allat($response->id, $response->nev, $response->katid, null);
    } else {
      $allat = new Allat(null, "", -1, null);
    }

    $kategoriaCurl = curl_init();

    curl_setopt_array($kategoriaCurl, array(
        CURLOPT_URL => 'localhost:80/beadando/rest/kategoria-rest.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $kategoriaResponse = curl_exec($kategoriaCurl);

    curl_close($kategoriaCurl);
    $kategoriaResponse = json_decode($kategoriaResponse, true);

    $kategoriak = [];
    foreach ($kategoriaResponse as $k) {
        $kategoria = new Kategoria($k["id"], $k["nev"]);
        array_push($kategoriak, $kategoria);
    }

    echo "<form>";
    echo "<label for='id'>Azonosító:</label>";
    echo "<input type='text' id='id' name='id' readonly value='$allat->id'/>";
    echo "<label for='nev'>Név:</label>";
    echo "<input type='text' id='nev' name='nev' value='$allat->nev'/>";
    echo "<label for='katid'>Kategória:</label>";
    echo "<select id='katid' name='katid' value='$allat->katid'>";
    foreach ($kategoriak as $kategoria) {
        echo "<option value='$kategoria->id'". ( $kategoria->id == $allat->katid ? "selected=\"selected\"" : "") .">$kategoria->nev</option>";
    }
    echo "</select>";
    echo "<input type='submit' id='submitButton'/>";
    echo "</form>";
    ?>
</div>

<!-- Scripts -->
<script src="/beadando/assets/js/jquery.min.js"></script>
<script src="/beadando/assets/js/browser.min.js"></script>
<script src="/beadando/assets/js/breakpoints.min.js"></script>
<script src="/beadando/assets/js/util.js"></script>
<script src="/beadando/assets/js/main.js"></script>

<script>
    $(document).ready(() => {
        $('#submitButton').click( ev => {
            ev.preventDefault();
            const form = $('form')[0];
            const id = $(form).find("#id").val();

            if (id !== '') {
                $.ajax({
                    url: 'http://localhost:80/beadando/rest/allat-rest.php',
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "id": id,
                        "nev": $(form).find("#nev").val(),
                        "katid": $(form).find("#katid").val()
                    })
                });
            } else {
                $.post('http://localhost:80/beadando/rest/allat-rest.php',
                    JSON.stringify({
                        "id": null,
                        "nev": $(form).find("#nev").val(),
                        "katid": $(form).find("#katid").val()
                    })
                );
            }

            location.href = "allat.php";
        });
    });
</script>

</body>
</html>
