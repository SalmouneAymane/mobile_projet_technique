<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../classes/categorie.php';

$jsonPath = __DIR__ . "/../database/database.json";

$content = file_get_contents($jsonPath);
$data = json_decode($content, true);

if (!is_array($data)) {
    $data = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = file_get_contents('php://input');
    $payload = json_decode($raw, true);

    $name = '';

    if (isset($payload[0]['name'])) {
        $name = trim($payload[0]['name']);
    } elseif (isset($payload['name'])) {
        $name = trim($payload['name']);
    }

    if ($name !== '') {
        $categorie = new Categorie($name);
        $data[] = [
            'id' => $categorie->getId(),
            'name' => $categorie->getNom()
        ];

        file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo json_encode($data);
        exit;
    }
}

echo json_encode($data);
?>