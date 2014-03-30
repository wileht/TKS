<?php

class Keskustelualue {

    private $id;
    private $nimi;

    public function __construct($id, $nimi) {
        $this->id = $id;
        $this->nimi = $nimi;
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNimi() {
        return $this->nimi;
    }
    
    public function setNimi($kirjoittaja) {
        $this->nimi = $kirjoittaja;
    }
}