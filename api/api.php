<?php
require 'db.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? '';

try {
    switch ($method) {
        case 'GET':
            handleGetRequest($endpoint, $pdo);
            break;
        case 'POST':
            handlePostRequest($endpoint, $pdo);
            break;
        case 'PUT':
            handlePutRequest($endpoint, $pdo);
            break;
        case 'DELETE':
            handleDeleteRequest($endpoint, $pdo);
            break;
        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Server Error', 'error' => $e->getMessage()]);
}

function handleGetRequest($endpoint, $pdo) {
    if ($endpoint === 'allatok') {
        $stmt = $pdo->query('SELECT * FROM allat');
        $allatok = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($allatok);
    } elseif ($endpoint === 'kategoriak') {
        $stmt = $pdo->query('SELECT * FROM kategoria');
        $kategoriak = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($kategoriak);
    } elseif ($endpoint === 'ertekek') {
        $stmt = $pdo->query('SELECT * FROM ertek');
        $ertekek = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($ertekek);
    }
}

function handlePostRequest($endpoint, $pdo) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($endpoint === 'allatok') {
        $stmt = $pdo->prepare('INSERT INTO allat (nev, ertekid, ev, katid) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['nev'], $data['ertekid'], $data['ev'], $data['katid']]);
        echo json_encode(['message' => 'Állat létrehozva']);
    } elseif ($endpoint === 'kategoriak') {
        $stmt = $pdo->prepare('INSERT INTO kategoria (nev) VALUES (?)');
        $stmt->execute([$data['nev']]);
        echo json_encode(['message' => 'Kategória létrehozva']);
    } elseif ($endpoint === 'ertekek') {
        $stmt = $pdo->prepare('INSERT INTO ertek (forint) VALUES (?)');
        $stmt->execute([$data['forint']]);
        echo json_encode(['message' => 'Érték létrehozva']);
    }
}

function handlePutRequest($endpoint, $pdo) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($endpoint === 'allatok') {
        $stmt = $pdo->prepare('UPDATE allat SET nev = ?, ertekid = ?, ev = ?, katid = ? WHERE id = ?');
        $stmt->execute([$data['nev'], $data['ertekid'], $data['ev'], $data['katid'], $data['id']]);
        echo json_encode(['message' => 'Állat frissítve']);
    } elseif ($endpoint === 'kategoriak') {
        $stmt = $pdo->prepare('UPDATE kategoria SET nev = ? WHERE id = ?');
        $stmt->execute([$data['nev'], $data['id']]);
        echo json_encode(['message' => 'Kategória frissítve']);
    } elseif ($endpoint === 'ertekek') {
        $stmt = $pdo->prepare('UPDATE ertek SET forint = ? WHERE id = ?');
        $stmt->execute([$data['forint'], $data['id']]);
        echo json_encode(['message' => 'Érték frissítve']);
    }
}

function handleDeleteRequest($endpoint, $pdo) {
    $id = $_GET['id'] ?? null;
    if ($endpoint === 'allatok' && $id) {
        $stmt = $pdo->prepare('DELETE FROM allat WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Állat törölve']);
    } elseif ($endpoint === 'kategoriak' && $id) {
        $stmt = $pdo->prepare('DELETE FROM kategoria WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Kategória törölve']);
    } elseif ($endpoint === 'ertekek' && $id) {
        $stmt = $pdo->prepare('DELETE FROM ertek WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Érték törölve']);
    }
}
?>
