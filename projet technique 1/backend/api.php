<?php

header('Content-Type: application/json; charset=utf-8');

// require_once "genre.php";

// $path = __DIR__ ."/database/database.json";

// //get file

// $raw = file_get_contents($path);
// $content = json_decode($raw,true);

// if($_SERVER['REQUEST_METHOD']==="POST"){
//     $raw2 = file_get_contents('php://input');
//     $payload = json_decode($raw2,true);


//         $genreObject = new Genre( $payload['name']);
//         $content[] = [
//             "id" => $genreObject->getId(),
//             "name" => $genreObject->getName()
//         ];
//         file_put_contents($path,json_encode($content,JSON_PRETTY_PRINT));
//         echo json_encode($content);
//         exit;

//     }


// echo json_encode($content);


require_once('genreController.php');


?>