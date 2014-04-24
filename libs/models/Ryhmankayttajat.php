<?php

class Ryhmankayttajat {

    private $id;
    private $kayttaja;
    private $kayttajaryhma;

    public function __construct($id, $kayttaja, $kayttajaryhma) {
        $this->id = $id;
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
        
        $ryhmannimi = "Ylläpitäjät";
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
    
    public function lisaaKantaan() {
        $sql = "INSERT INTO Ryhmankayttajat VALUES(default,?,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getKayttaja(), $this->getKayttajaryhma()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function etsiRyhmanKayttajat($ryhmaId) {
        $sql = "SELECT kayttaja from Ryhmankayttajat where kayttajaryhma = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($ryhmaId));

        require_once 'libs/models/Kayttaja.php';
        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $kayttaja) {
            $uusi = new Kayttaja();
            $uusi->setId($kayttaja->kayttaja);
            $kayttajaNimi = Kayttaja::etsiNimiIdlla($kayttaja->kayttaja);
            $uusi->setNimi($kayttajaNimi);
            $a[] = $uusi;
        }
        return $a;
    }

    public function poistaKayttajaRyhmasta($kayttaja, $ryhma) {
        $sql = "delete from Ryhmankayttajat where kayttaja = ? AND kayttajaryhma = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($kayttaja, $ryhma));
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
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
}