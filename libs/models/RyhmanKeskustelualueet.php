<?php

class RyhmanKeskustelualueet {
    
    private $id;
    private $kayttajaryhma;
    private $keskustelualue;

    public function __construct($id, $kayttajaryhma, $keskustelualue) {
        $this->id = $id;
        $this->kayttajaryhma = $kayttajaryhma;
        $this->keskustelualue = $keskustelualue;
    }
    
    public function lisaaKantaan() {
        $sql = "INSERT INTO RyhmanKeskustelualueet VALUES(default,?,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getKayttajaryhma(),$this->getKeskustelualue()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function onkoRyhmallaOikeutta($kayttajaId) {
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
    
    public function getKayttajaryhma() {
        return $this->kayttajaryhma;
    }
    
    public function setKayttajaryhma($kayttajaryhma) {
        $this->kayttajaryhma = $kayttajaryhma;
    }
    
    public function getKeskustelualue() {
        return $this->keskustelualue;
    }
    
    public function setKeskustelualue($keskustelualue) {
        $this->keskustelualue = $keskustelualue;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
}