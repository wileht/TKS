<?php

class Kayttajaryhma {

    private $id;
    private $nimi;

    public function __construct($id, $nimi) {
        $this->id = $id;
        $this->nimi = $nimi;
    }

    public function haeRyhmanId($nimi) {
        
        $sql = "SELECT id from Kayttajaryhma where nimi = ? LIMIT 1";
        //require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        }
        return $tulos->id;
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