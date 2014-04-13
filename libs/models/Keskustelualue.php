<?php

class Keskustelualue {

    private $id;
    private $nimi;

    public function __construct($id, $nimi) {
        $this->id = $id;
        $this->nimi = $nimi;
    }
    
    public function kaikkiAlueet() {
        //Etsitään ja palautetaan kaikki foorumin keskustelualueet
        $sql = "SELECT id, nimi from Keskustelualue";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        
        $a = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $jasen){
            $uusi = new Keskustelualue();
            $uusi->setId($jasen->id);
            $uusi->setNimi($jasen->nimi);
            $a[] = $uusi;
    }  
        return $a;
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