<?php

require_once "GenreGestionnaire.php";

class GenreController {
    private $gestionnaire;

    public function __construct()
    {
        $this->gestionnaire = new GenreGestionnaire();
    }

    public function index() {
        echo json_encode($this->gestionnaire->getAll());
    }

    public function store() {
        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);

        $this->gestionnaire->ajouter($payload['name']);
        echo json_encode($this->gestionnaire->getAll());
    }
}
