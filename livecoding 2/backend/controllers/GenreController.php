<?php

require_once "../services/GenreService.php";

class GenreController {
    private $gestionaire;

    public function __construct()
    {
        $this->gestionaire = new GenreService();
    }

    public function index(){
        echo json_encode($this->gestionaire->getAll());
        return json_encode($this->gestionaire->getAll()) ;
    }

    public function store(){
        $raw = file_get_contents("php://input");
        $payload = json_decode($raw,true);

        echo json_encode($this->gestionaire->add($payload["name"]));
    }
}

?>