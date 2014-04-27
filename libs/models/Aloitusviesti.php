<?php

class Aloitusviesti {

    private $id;
    private $kirjoittaja;
    private $keskustelualue;
    private $sisalto;
    private $otsikko;
    private $paivamaara;
    private $virheet;

    public function __construct($id, $kirjoittaja, $keskustelualue, $sisalto, $otsikko, $paivamaara, $virheet) {
        $this->id = $id;
        $this->kirjoittaja = $kirjoittaja;
        $this->keskustelualue = $keskustelualue;
        $this->sisalto = $sisalto;
        $this->otsikko = $otsikko;
        $this->paivamaara = $paivamaara;
        $this->virheet = $virheet;
    }

    public function etsiAlueenViestit($id, $sivunro, $montako) {
        //Etsitään annetun keskustelualueen halutut viestit ja tehdään niille Aloitusviesti-luokan ilmentymät
        $sql = "SELECT id, kirjoittaja, keskustelualue, sisalto, otsikko, paivamaara from Aloitusviesti where keskustelualue = ? 
              ORDER by paivamaara LIMIT ? OFFSET ?";
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
            $uusi->setPaivamaara($viesti->paivamaara);
            $a[] = $uusi;
        }

        //Järjestetään vastineet päivämäärän mukaan nousevassa järjestyksessä
        $b = array();
        require_once 'libs/models/Vastine.php';
        foreach ($a as $viesti) {
            $c = Vastine::etsiUusimmanVastineenPvm($viesti->getId());

            if ($c == null) {
                $c = $viesti->getPaivamaara();
            }

            $b[$c] = $viesti;
        }
        krsort($b);
        return array_values($b);
    }

    public function etsiAlueenKaikkiViestitId($alue) {
        //Etsitään annetun keskustelualueen halutut viestit ja tehdään niille Aloitusviesti-luokan ilmentymät
        $sql = "SELECT id from Aloitusviesti where keskustelualue = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($alue));

        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $viestiId) {
            $a[] = $viestiId->id;
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
        $sql = "INSERT INTO Aloitusviesti VALUES(default,?,?,?,?,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getKirjoittaja(), $this->getKeskustelualue(), $this->getSisalto(), $this->getOtsikko()
            , $this->getPaivamaara()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }

    public function etsiAloitusviesti($viestiId) {
        //Etsitään viesti tietokannasta annetun id:n perusteella, tehdään sille Aloitusviesti-luokan ilmentymä ja palautetaan se
        $sql = "SELECT id, kirjoittaja, keskustelualue, sisalto, otsikko, paivamaara from Aloitusviesti where id = ? LIMIT 1";
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
            $viesti->setPaivamaara($tulos->paivamaara);

            return $viesti;
        }
    }

    public function getKirjoittajaNimi() {
        //Etsitään viestin kirjoittajan nimi
        require_once 'libs/models/Kayttaja.php';
        return Kayttaja::etsiNimiIdlla($this->kirjoittaja);
    }

    public function getKeskustelualueNimi() {
        //Etsitään viestin keskustelualueen nimi
        require_once 'libs/models/Keskustelualue.php';
        return Keskustelualue::etsiNimiIdlla($this->keskustelualue);
    }

    public function onkoKelvollinen() {
        //Palautetaan mahdolliset viestin luomisen tai muokkaamisen aikana syntyneet virheet
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

    public function getVastineita() {
        //Palautetaan aloitusviestin vastineiden lukumäärä
        require_once 'libs/models/Vastine.php';
        return Vastine::lukumaara($this->id);
    }

    public function etsiUusimmanVastineenPvm() {
        //Etsitään aloitusviestin uusimman vastineen päivämäärä
        require_once 'libs/models/Vastine.php';
        $uusinVastine = Vastine::etsiUusimmanVastineenPvm($this->id);

        if ($uusinVastine == null) {
            //Jos aloitusviestillä ei ole vastineita, uusin päivämäärä on aloitusviestin oma päivämäärä
            return $this->paivamaara;
        } else {
            return $uusinVastine;
        }
    }

    public function etsiHakusanalla($sana) {
        //Hyvin yksinkertainen hakutoiminto, jossa aloitusviestin sisällöstä ja otsikosta etsitään hakusanaa muistuttavia
        //sanoja
        $sana = "%" . $sana . "%";
        $sql = "SELECT id, kirjoittaja, keskustelualue, sisalto, otsikko, paivamaara from Aloitusviesti where sisalto ILIKE ? or
            otsikko ILIKE ? ORDER by paivamaara";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($sana, $sana));

        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $viesti) {
            //Luodaan löydetyille viesteille Aloitusviesti-luokan ilmentymät
            $uusi = new Aloitusviesti();
            $uusi->setId($viesti->id);
            $uusi->setKirjoittaja($viesti->kirjoittaja);
            $uusi->setKeskustelualue($viesti->keskustelualue);
            $uusi->setSisalto($viesti->sisalto);
            $uusi->setOtsikko($viesti->otsikko);
            $uusi->setPaivamaara($viesti->paivamaara);
            $a[] = $uusi;
        }
        return $a;
    }

    public static function kayttajanViesteja($id) {
        //Lasketaan ja palautetaan annetun käyttäjän kirjoittamien aloitusviestien määrä
        $sql = "SELECT count(*) FROM Aloitusviesti where kirjoittaja = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        return $kysely->fetchColumn();
    }

    public function kayttajanViimeisinViestiPvm($id) {
        //Etsitään annetun käyttäjän viimeisimmän aloitusviestin päivämäärä
        $sql = "SELECT max(paivamaara) FROM Aloitusviesti where kirjoittaja = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        return $kysely->fetchColumn();
    }

    public function getAloitusviesti() {
        return $this->id;
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
        } else {
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
        } else {
            unset($this->virheet['otsikko']);
        }
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public function setVirheet($virheet) {
        $this->virheet = $virheet;
    }

    public function getPaivamaara() {
        return $this->paivamaara;
    }

    public function setPaivamaara($paivamaara) {
        $this->paivamaara = $paivamaara;
    }

}