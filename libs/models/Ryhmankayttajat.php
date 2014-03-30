<?php

class Ryhmankayttajat {

    private $kayttaja;
    private $kayttajaryhma;

    public function __construct($kayttaja, $kayttajaryhma) {
        $this->kayttaja = $kayttaja;
        $this->kayttajaryhma = $kayttajaryhma;
    }
    
    public function onkoYllapitaja() {
        
        if (!onkoKirjautunut()) {
            return false;
        }
        return true;
        
        // Ja jotenkin näin sen PITÄISI mennä:
        
        require_once "tietokantayhteys.php";
        
        require_once "libs/models/Kayttajaryhma.php";
        $ryhmannimi = "Yllapitajat";
        $kayttajaryhmaId = Kayttajaryhma::haeRyhmanId($ryhmannimi);
        
        if ($kayttajaryhmaId == null) {
            return false;
        }
        
        $kayttaja = $_SESSION['kirjautunut'];
        
        $sql1 = "SELECT kayttaja, kayttajaryhma from Ryhmankayttajat where kayttaja = ? AND kayttajaryhma = ? LIMIT 1";
        $kysely1 = getTietokantayhteys()->prepare($sql1);
        $kysely1->execute(array($kayttaja->getId(), $kayttajaryhmaId)); //tämä ei toimi
        $tulos1 = $kysely1->fetchObject();
        
        if ($tulos1 == null) {
            return false;
        }
        return true;
    }

    public function getKayttaja() {
        return $this->kayttaja;
    }
    
    public function setKayttaja($kayttaja) {
        $this->kayttaja = $kayttaja;
    }
    
    public function getKayttajaryhma() {
        return $this->kayttajaryhma;
    }
    
    public function setKayttajaryhma($kayttajaryhma) {
        $this->kayttajaryhma = $kayttajaryhma;
    }
}