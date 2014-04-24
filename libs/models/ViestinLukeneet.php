<?php

class ViestinLukeneet {
    
    private $id;
    private $aloitusviesti;
    private $kayttaja;

    public function __construct($id, $aloitusviesti, $kayttaja) {
        $this->id = $id;
        $this->aloitusviesti = $aloitusviesti;
        $this->kayttaja = $kayttaja;
    }
    
    public function lisaaKantaan() {
        $sql = "INSERT INTO ViestinLukeneet VALUES(default,?,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getAloitusviesti(),$this->getKayttaja()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function kaikkiViestinLukeneet($viesti) {
        //Etsitään ja palautetaan kaikki annetun viestin lukeneet käyttäjät
        $sql = "SELECT kayttaja from ViestinLukeneet where aloitusviesti = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($viesti));

        require_once 'libs/models/Kayttaja.php';
        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $kayttaja) {
            $uusi = new Kayttaja();
            $uusi->setId($kayttaja->kayttaja);
            $kayttajaNimi = Kayttaja::etsiNimiIdlla($uusi->getId());
            $uusi->setNimi($kayttajaNimi);
            $a[] = $uusi;
        }
        return $a;
    }
    
    public function onkoLukenut($viesti, $kayttaja) {
        $sql = "SELECT id from ViestinLukeneet where aloitusviesti = ? AND kayttaja = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($viesti, $kayttaja));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return false;
        } else {
            return true;
        }
    }
    
    public function getKayttaja() {
        return $this->kayttaja;
    }
    
    public function setKayttaja($kayttaja) {
        $this->kayttaja = $kayttaja;
    }
    
    public function getAloitusviesti() {
        return $this->aloitusviesti;
    }
    
    public function setAloitusviesti($viesti) {
        $this->aloitusviesti = $viesti;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
}