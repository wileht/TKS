<?php

class Kayttaja {

    private $id;
    private $nimi;
    private $salasana;
    private $virheet;

    public function __construct($id, $nimi, $salasana, $virheet) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->salasana = $salasana;
        $this->virheet = $virheet;
    }

    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        //Etsitään käyttäjä tietokannasta nimen ja salasanan perusteella, tehdään tulokselle Käyttäjä-luokan
        //ilmentymä ja palautetaan se
        $sql = "SELECT id, nimi, salasana from kayttaja where nimi = ? AND salasana = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->setId($tulos->id);
            $kayttaja->setNimi($tulos->nimi);
            $kayttaja->setSalasana($tulos->salasana);

            return $kayttaja;
        }
    }

    public static function etsiNimiIdlla($id) {
        //Etsitään käyttäjän nimi id:n perusteella
        $sql = "SELECT nimi from kayttaja where id = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return "[Tuntematon käyttäjä]";
        } else {
            return $tulos->nimi;
        }
    }
    
    public function onkoTunnusVapaa($kayttaja) {
        //Tarkistetaan onko annettu käyttäjätunnus vapaa
        $sql = "SELECT id from kayttaja where nimi = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return true;
        } else {
            return false;
        }
    }
    
    public function lisaaKantaan() {
        //Lisätään käyttäjä tietokantaan ja palautetaan tämän tietokannassa saama id
        $sql = "INSERT INTO Kayttaja VALUES(default,?,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getNimi(), $this->getSalasana()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function onkoKelvollinen() {
        return empty($this->virheet);
    }
    
    public function getVirheet() {
        return $this->virheet;
    }
    
    public function setVirheet($virhe) {
        $this->virheet = $virhe;
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

        //Käyttäjätunnus ei saa olla tyhjä eikä liian pitkä
        if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Käyttäjätunnus ei saa olla tyhjä.";
        } elseif (strlen($this->nimi) > 30) {
            $this->virheet['nimi'] = "Käyttäjätunnuksesi on liian pitkä.";
        }
        else {
            unset($this->virheet['nimi']);
        }
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
        
        //Salasana ei saa olla tyhjä eikä liian pitkä
        if (trim($this->salasana) == '') {
            $this->virheet['salasana'] = "Salasana ei saa olla tyhjä.";
        } elseif (strlen($this->salasana) > 20) {
            $this->virheet['salasana'] = "Salasanasi on liian pitkä.";
        }
        else {
            unset($this->virheet['salasana']);
        }
    }

}