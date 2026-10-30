<?php

header('Content-Type: application/json; charset=utf-8');

require_once "GenreController.php";

$controller = new GenreController();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $controller->store();
} else {
    $controller->index();
}
