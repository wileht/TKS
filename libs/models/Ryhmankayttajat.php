<?php

class Ryhmankayttajat {

    private $kayttaja;
    private $kayttajaryhma;

    public function __construct($kayttaja, $kayttajaryhma) {
        $this->kayttaja = $kayttaja;
        $this->kayttajaryhma = $kayttajaryhma;
    }
    
    public function onkoYllapitaja($kayttajaId) {
        //Tarkistetaan onko annettu käyttäjä ylläpitäjä (ts. Yllapitajat-käyttäjäryhmän jäsen)
        if (!onkoKirjautunut()) {
            return false;
        }
        
        require_once "tietokantayhteys.php";
        require_once "libs/models/Kayttajaryhma.php";
        
        $ryhmannimi = "Yllapitajat";
        $kayttajaryhmaId = Kayttajaryhma::haeRyhmanId($ryhmannimi); //Etsitään kyselyä varten käyttäjäryhmän tietokanta-id
        
        if ($kayttajaryhmaId == null) {
            return false;
        }
        
        require_once "libs/models/Kayttaja.php";
        
        $sql1 = "SELECT kayttaja, kayttajaryhma from Ryhmankayttajat where kayttaja = ? AND kayttajaryhma = ? LIMIT 1";
        $kysely1 = getTietokantayhteys()->prepare($sql1);
        $kysely1->execute(array($kayttajaId, $kayttajaryhmaId));
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