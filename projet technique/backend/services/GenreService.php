<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/GenreDAO.php';

class GenreService extends BaseService
{
    private $genreDAO;

    public function __construct()
    {
        $this->genreDAO = new GenreDAO();
    }

    public function getAll()
    {
        return $this->genreDAO->getAll();
    }

    public function add($name)
    {
        return $this->genreDAO->add($name);
    }
}
