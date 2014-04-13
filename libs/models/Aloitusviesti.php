<?php

class Aloitusviesti {

    private $id;
    private $kirjoittaja;
    private $keskustelualue;
    private $sisalto;
    private $otsikko;
    private $virheet;

    public function __construct($id, $kirjoittaja, $keskustelualue, $sisalto, $otsikko, $virheet) {
        $this->id = $id;
        $this->kirjoittaja = $kirjoittaja;
        $this->keskustelualue = $keskustelualue;
        $this->sisalto = $sisalto;
        $this->otsikko = $otsikko;
        $this->virheet = $virheet;
    }

    public function etsiAlueenViestit($id, $sivunro, $montako) {
        //Etsitään annetun keskustelualueen halutut viestit ja tehdään niille Aloitusviesti-luokan ilmentymät
        $sql = "SELECT id, kirjoittaja, keskustelualue, sisalto, otsikko from Aloitusviesti where keskustelualue = ? 
              ORDER by otsikko LIMIT ? OFFSET ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id, $montako, ($sivunro - 1) * $montako));

        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $viesti) {
            $uusi = new Aloitusviesti();
            $uusi->setId($viesti->id);
            $uusi->setKirjoittaja($viesti->kirjoittaja);
            $uusi->setKeskustelualue($viesti->keskustelualue);
            $uusi->setSisalto($viesti->sisalto);
            $uusi->setOtsikko($viesti->otsikko);
            $a[] = $uusi;
        }

        return $a;
    }

    public static function lukumaara($id) {
        //Lasketaan ja palautetaan annetun keskustelualueen viestien määrä
        $sql = "SELECT count(*) FROM Aloitusviesti where keskustelualue = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        return $kysely->fetchColumn();
    }

    public function lisaaKantaan() {
        //Lisätään viesti tietokantaan, palautetaan viestin tietokannassa saama id
        $sql = "INSERT INTO Aloitusviesti VALUES(default,?,?,?,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getKirjoittaja(), $this->getKeskustelualue(), $this->getSisalto(), $this->getOtsikko()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }

    public function etsiAloitusviesti($viestiId) {
        //Etsitään viesti tietokannasta annetun id:n perusteella, tehdään sille Aloitusviesti-luokan ilmentymä ja palautetaan se
        $sql = "SELECT id, kirjoittaja, keskustelualue, sisalto, otsikko from Aloitusviesti where id = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($viestiId));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $viesti = new Aloitusviesti();
            $viesti->setId($tulos->id);
            $viesti->setKirjoittaja($tulos->kirjoittaja);
            $viesti->setKeskustelualue($tulos->keskustelualue);
            $viesti->setSisalto($tulos->sisalto);
            $viesti->setOtsikko($tulos->otsikko);

            return $viesti;
        }
    }

    public function getKirjoittajaNimi() {
        //Etsitään viestin kirjoittajan nimi
        require_once 'libs/models/Kayttaja.php';
        return Kayttaja::etsiNimiIdlla($this->kirjoittaja);
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }
    
    public function muokkaaAloitusviestia($id) {
        //Muokataan aloitusviestiä, joka löydetään annetun id:n perusteella
        $sql = "update Aloitusviesti set sisalto = ?, otsikko = ? where id = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getSisalto(), $this->getOtsikko(), $id));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
    }

    public function poistaAloitusviesti($id) {
        //Poistetaan id:n perusteella etsittävä aloitusviesti
        $sql = "delete from Aloitusviesti where id = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($id));
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getKirjoittaja() {
        return $this->kirjoittaja;
    }

    public function setKirjoittaja($kirjoittaja) {
        $this->kirjoittaja = $kirjoittaja;
    }

    public function getKeskustelualue() {
        return $this->keskustelualue;
    }

    public function setKeskustelualue($keskustelualue) {
        $this->keskustelualue = $keskustelualue;
    }

    public function getSisalto() {
        return $this->sisalto;
    }

    public function setSisalto($sisalto) {
        $this->sisalto = $sisalto;

        //Viestin sisältö ei saa olla tyhjä eikä yli 65 535 merkkiä pitkä
        if (trim($this->sisalto) == '') {
            $this->virheet['sisalto'] = "Viesti ei saa olla tyhjä.";
        } elseif (strlen($this->sisalto) > 65535) {
            $this->virheet['sisalto'] = "Viestisi on liian pitkä.";
        }
        else {
            unset($this->virheet['sisalto']);
        }
    }

    public function getOtsikko() {
        return $this->otsikko;
    }

    public function setOtsikko($otsikko) {
        $this->otsikko = $otsikko;
        
        //Viestin otsikko ei saa olla tyhjä eikä liian pitkä
        if (trim($this->otsikko) == '') {
            $this->virheet['otsikko'] = "Otsikko ei saa olla tyhjä.";
        } elseif (strlen($this->otsikko) > 30) {
            $this->virheet['otsikko'] = "Otsikkosi on liian pitkä.";
        }
        else {
            unset($this->virheet['otsikko']);
        }
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public function setVirheet($virheet) {
        $this->virheet = $virheet;
    }

}