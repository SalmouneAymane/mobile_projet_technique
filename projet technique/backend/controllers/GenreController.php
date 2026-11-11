<?php

require_once __DIR__ . '/../services/GenreService.php';

class GenreController
{
    private $genreService;

    public function __construct()
    {
        $this->genreService = new GenreService();
    }

    public function index()
    {
        return $this->genreService->getAll();
    }

    public function store()
    {
        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);

        $this->genreService->add($payload['name']);
        return $this->genreService->getAll();
    }
}
