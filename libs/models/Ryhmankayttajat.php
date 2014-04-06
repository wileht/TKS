<?php

class Ryhmankayttajat {

    private $kayttaja;
    private $kayttajaryhma;

    public function __construct($kayttaja, $kayttajaryhma) {
        $this->kayttaja = $kayttaja;
        $this->kayttajaryhma = $kayttajaryhma;
    }
    
    public function onkoYllapitaja($kayttaja) {
        
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
        
        //session_start();
        require_once "libs/models/Kayttaja.php";
        //$kayttaja = $_GET["kirjautunut"];
        //$kayttaja = $_SESSION['kirjautunut'];
        //$kayttaja = $data->kirjauutunut;
        $kayttajaId = $kayttaja->getId();
        //$kayttajaId = $kayttaja->getIdKayttaja();
        echo '2';
        return false;
        $sql1 = "SELECT kayttaja, kayttajaryhma from Ryhmankayttajat where kayttaja = ? AND kayttajaryhma = ? LIMIT 1";
        $kysely1 = getTietokantayhteys()->prepare($sql1);
        $kysely1->execute(array($kayttajaId, $kayttajaryhmaId)); //tämä ei toimi
        return false;
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