<?php

class Genre {
    private $id,$name;

    

    public function __construct($Nid,$NName)
    {
        $this->id = $Nid;
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