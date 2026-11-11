<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../controllers/GenreController.php';

$controller = new GenreController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode($controller->store());
} else {
    echo json_encode($controller->index());
}
