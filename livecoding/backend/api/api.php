<?php
header("Content-Type: application/json");
require_once __DIR__."/../classes/Genre.php";

$jsonPath = __DIR__."/../database/db.json";

$content = file_get_contents($jsonPath);
$data = json_decode($content,true);


if ([$_SERVER["REQUEST_METHOD"]="POST"]){
    $raw = file_get_contents("php://input");
    $payload = json_decode($raw,true);
    
    $obj = new Genre($payload[0]["name"]);
};






echo json_encode($data);
?>