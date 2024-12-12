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
            getKategoria($_GET['id'], $conn);
        } else {
            listKategoriak($conn);
        }
        break;
    default:
        echo json_encode(["message" => "Hibás kérés metódus"]);
        break;
}

function getKategoria($id, $conn) {
    $result = $conn->query("SELECT * FROM kategoria WHERE id = $id");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}


function listKategoriak($conn) {
    $result = $conn->query("SELECT * FROM kategoria");
    $kategoriak = [];
    while ($row = $result->fetch_assoc()) {
        $kategoriak[] = $row;
    }
    echo json_encode($kategoriak);
}

$conn->close();
