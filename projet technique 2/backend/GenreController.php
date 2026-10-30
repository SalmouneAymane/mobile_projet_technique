<?php

require_once "GenreGestionnaire.php";

class GenreController {
    private $gestionnaire;

    public function __construct()
    {
        $this->gestionnaire = new GenreGestionnaire();
    }

    // GET — list all genres
    public function index() {
        echo json_encode($this->gestionnaire->getAll());
    }

    // POST — create a genre
    public function store() {
        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);

        $this->gestionnaire->ajouter($payload['name']);
        echo json_encode($this->gestionnaire->getAll());
    }
}

?>
