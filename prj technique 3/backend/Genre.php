<?php

class Genre {
    private $id,$name;

    

    public function __construct($NName)
    {

    $jsonPath = __DIR__."/database/database.json";

    $content = file_get_contents($jsonPath);
    $data = json_decode($content,true);
    $this->id = is_array($data) ? count($data)+1 :1;
        $this->name = $NName;
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