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
    <link rel="stylesheet" href="/beadando/assets/css/allat.css" />
    <link rel="stylesheet" href="/beadando/style.css">
</head>
<body class="is-preload">
<?php include __DIR__ . '/header.php';?>

<!-- Header -->
<div id="header">
    <span class="logo icon fa-paper-plane"></span>
    <h1>Védett állatok</h1>
    <p>Üdvözöljük a Védett fajok oldalán!</p>
</div>

<!-- Main -->
<div id="main">
    <?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:80/beadando/rest/allat-rest.php',
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
        $response = json_decode($response, true);

        include "models.php";
        $allatok = [];

        foreach ($response as $a) {
          $allat = new Allat($a["id"], $a["nev"], $a["ertekid"], $a["ev"],$a["katid"]);
          $allat->kategorianev = $a["kategorianev"]; // Kategória neve hozzáadása
          array_push($allatok, $allat);
        }

        echo "<button id='addNew' class='button'>Új hozzáadása</button>";

        // állatok megjelenítése
        echo "<table class='table default' border='1'>";
        echo "<thead><tr><th>Id</th><th>Név</th><th>Kategória</th><th>Akciók</th></tr></thead>";
        echo "<tbody>";
        foreach ($allatok as $a) {
            echo "<tr>
                    <td>".$a->id."</td>
                    <td>".$a->nev."</td>
                    <td>".$a->kategorianev."</td>
                    <td>
                        <button class='icon solid fa-edit edit' a-id='".$a->id."'></button>
                        <button class='icon solid fa-times delete' a-id='".$a->id."'></button>
                    </td>
                </tr>";
        }
        echo "</tbody></table>";
    ?>
</div>

<!-- Scripts -->
<script src="/beadando/assets/js/jquery.min.js"></script>
<script src="/beadando/assets/js/browser.min.js"></script>
<script src="/beadando/assets/js/breakpoints.min.js"></script>
<script src="/beadando/assets/js/util.js"></script>
<script src="/beadando/assets/js/main.js"></script>
<script>
    (function() {
        const addNewButton = document.getElementById("addNew");
        addNewButton.addEventListener('click', redirectInit, false);

        const editButtons = document.getElementsByClassName('edit');
        for (let i = 0; i < editButtons.length; i++) {
            editButtons[i].addEventListener('click', redirect, false);
        }

        const deleteButtons = document.getElementsByClassName('delete');
        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', deleteAndRefresh, false);
        }

        function redirectInit() {
            window.location.href = "allat-szerkesztes.php";
        }

        function deleteAndRefresh(ev) {
            let id = ev.target.attributes['a-id'].value;
            $.ajax({
                url: 'http://localhost:80/beadando/rest/allat-rest.php',
                type: 'DELETE',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    "id": id
                })
            });
            window.location.href = "allat.php";
        }

        function redirect(ev) {
            let id = ev.target.attributes['a-id'].value;
            window.location.href = "allat-szerkesztes.php?id=" + id;
        }
  })();
</script>

</body>
</html>
