<?php

class Kayttajaryhma {

    private $id;
    private $nimi;
    private $virheet;

    public function __construct($id, $nimi, $virheet) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->virheet = $virheet;
    }

    public function haeRyhmanId($nimi) {
        //Haetaan käyttäjäryhmän id tietokannassa nimen perusteella
        $sql = "SELECT id from Kayttajaryhma where nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        }
        return $tulos->id;
    }
    
    public function kaikkiRyhmat() {
        //Etsitään ja palautetaan kaikki foorumin käyttäjäryhmät
        $sql = "SELECT id, nimi from Kayttajaryhma";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $ryhma) {
            $uusi = new Kayttajaryhma();
            $uusi->setId($ryhma->id);
            $uusi->setNimi($ryhma->nimi);
            $a[] = $uusi;
        }
        return $a;
    }
    
    public function lisaaKantaan() {
        //Lisätään käyttäjäryhmä tietokantaan, palautetaan alueen tietokannassa saama id
        $sql = "INSERT INTO Kayttajaryhma VALUES(default,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getNimi()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $this->id;
    }
    
    public function poistaKayttajaryhma($id) {
        $sql = "delete from Kayttajaryhma where id = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($id));
    }
    
    public function onkoKelvollinen() {
        return empty($this->virheet);
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
    
    public function getVirheet() {
        return $this->virheet;
    }

    public function setVirheet($virheet) {
        $this->virheet = $virheet;
    }
    
    public function setNimi($nimi) {
        $this->nimi = $nimi;

        //Keskustelualueen nimi ei saa olla tyhjä eikä liian pitkä
        if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä.";
        } elseif (strlen($this->nimi) > 30) {
            $this->virheet['nimi'] = "Käyttäjäryhmän nimi on liian pitkä.";
        } else {
            unset($this->virheet['nimi']);
        }
    }
}