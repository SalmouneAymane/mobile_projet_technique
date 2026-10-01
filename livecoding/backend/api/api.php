<?php
header("Content-Type: application/json");
require_once __DIR__."/../classes/Genre.php";

$jsonPath = __DIR__."/../database/db.json";

$content = file_get_contents($jsonPath);
$data = json_decode($content,true);



if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $raw = file_get_contents("php://input");
    $payload = json_decode($raw,true);

    $obj = new Genre($payload["name"]);

    $data[]=[
        "id"=>$obj->getId(),
        "name"=>$obj->getName()
    ];

    file_put_contents($jsonPath,json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    

};







echo json_encode($data);
?>