<?php
require_once "Genre.php";
class GenreGestionaire {
    private $path;

    public function __construct()
    {
        $this->path = __DIR__."/database/database.json";
    }

    public function getAll(){
        $data = file_get_contents($this->path);
        return json_decode($data,true);
    }

    public function add ($name) {
        $data = $this->getAll();
        $id = count($data)+1;

        $genre = new Genre($id,$name);

        $data[]=[
            "id" => $genre->getId(),
            "name" => $genre->getName()
        ];
        file_put_contents($this->path,json_encode($data,JSON_PRETTY_PRINT));
        return $genre;

    }

};

?>