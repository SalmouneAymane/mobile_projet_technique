<?php
require_once "BaseService.php";
require_once "../daos/Dao.php";
class GenreService extends BaseService {
    private $Dao1;
    public function __construct()
    {
        $this->Dao1 = new Dao() ;
    }
    public function getAll(){
        return $this->Dao1->getAll();
    }
    public function add($name){
        try {
            $this->Dao1->add($name);
            return ["success" => true];
        }
        catch(Throwable $e){
            return ["message" => $e->getMessage(), "success" => false];
        }
    }
};

?>