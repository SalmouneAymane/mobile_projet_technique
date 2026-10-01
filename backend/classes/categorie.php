<?php
class Categorie {
    private int $id;
    private string $nom;

    public function __construct(string $Inom)
    {
        $jsonPath = __DIR__ . '/../database/database.json';

        if (file_exists($jsonPath)) {
            $content = file_get_contents($jsonPath);
            $data = json_decode($content, true);

            $this->id = is_array($data) ? count($data) + 1 : 1;
        } else {
            $this->id = 1;
        }

        $this->nom = $Inom;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

}
?>