<?php

require_once "GenreGestionaire.php";

class GenreController {
    private $gestionaire;

    public function __construct()
    {
        $this->gestionaire = new GenreGestionaire();
    }

    public function index(){
        echo json_encode($this->gestionaire->getAll());
        return json_encode($this->gestionaire->getAll()) ;
    }

    public function store(){
        $raw = file_get_contents("php://input");
        $payload = json_decode($raw,true);

        $this->gestionaire->add($payload["name"]);
        return json_encode($this->gestionaire->getAll()) ;
    }
}

?>