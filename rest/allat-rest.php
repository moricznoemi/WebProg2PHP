<?php

require_once '../config/config.php';

$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            getAllat($_GET['id'], $conn);
        } else {
            listAllatok($conn);
        }
        break;
    case 'POST':
        createAllat($input, $conn);
        break;
    case 'PUT':
        modifyAllat($input, $conn);
        break;
    case 'DELETE':
        deleteAllat($input, $conn);
        break;
    default:
        echo json_encode(["message" => "Hibás kérés metódus"]);
        break;
}

function getAllat($id, $conn) {
    $result = $conn->query("SELECT * FROM allat WHERE id = $id");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}


function listAllatok($conn) {
    $result = $conn->query("SELECT a.*, k.nev as kategorianev FROM allat a JOIN kategoria k ON a.katid = k.id");
    $allatok = [];
    while ($row = $result->fetch_assoc()) {
        $allatok[] = $row;
    }
    echo json_encode($allatok);
}

function createAllat($input, $conn) {
    $nev = $input['nev'];
    $ertekid = $input['ertekid'];
    $ev = $input['ev'];
    $katid = $input['katid'];
    $conn->query("INSERT INTO allat (nev, ertekid, ev, katid) VALUES ('$nev', '$ertekid', '$ev', '$katid')");
    echo json_encode(["message" => "Állat sikeresen hozzáadva"]);
}

function modifyAllat($input, $conn) {
    $id = $input['id'];
    $nev = $input['nev'];
    $ertekid = $input['ertekid'];
    $ev = $input['ev'];
    $katid = $input['katid'];
    $conn->query("UPDATE allat SET nev='$nev', ertekid='$ertekid', ev='$ev', katid='$katid' WHERE id=$id");
    echo json_encode(["message" => "Állat sikeresen módosítva"]);
}

function deleteAllat($input, $conn) {
    $id = $input['id'];
    $conn->query("DELETE FROM allat WHERE id=$id");
    echo json_encode(["message" => "Állat sikeresen törölve"]);
}

$conn->close();
