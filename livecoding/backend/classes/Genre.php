<?php
class Genre{

private $id;
private $name;


public function __construct($newName)
{
    $jsonPath = __DIR__."/../database/db.json";

    $content = file_get_contents($jsonPath);
    $data = json_decode($content,true);

    $this->id = is_array($data) ? count($data)+1 :1;
    $this->name = $newName;
}


//getters
public function getId(){
    return $this->id;
}
public function getName(){
    return $this->name;
}
}

?>