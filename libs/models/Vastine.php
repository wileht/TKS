<?php

class Vastine {

    private $id;
    private $kirjoittaja;
    private $keskustelualue;
    private $aloitusviesti;
    private $sisalto;
    private $virheet;

    public function __construct($id, $kirjoittaja, $keskustelualue, $aloitusviesti, $sisalto, $virheet) {
        $this->id = $id;
        $this->kirjoittaja = $kirjoittaja;
        $this->keskustelualue = $keskustelualue;
        $this->aloitusviesti = $aloitusviesti;
        $this->sisalto = $sisalto;
        $this->virheet = $virheet;
    }

    public function etsiVastineet($viestiId, $montako, $sivunro) {
        //Etsitään haluttu määrä annetun aloitusviestin vastineita, tehdään niille Vastine-luokan ilmentymät ja palautetaan ne
        $sql = "SELECT id, kirjoittaja, keskustelualue, aloitusviesti, sisalto from Vastine where aloitusviesti = ? 
              ORDER by id LIMIT ? OFFSET ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($viestiId, $montako, ($sivunro - 1) * $montako));

        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $vastine) {
            $uusi = new Vastine();
            $uusi->setId($vastine->id);
            $uusi->setKirjoittaja($vastine->kirjoittaja);
            $uusi->setAloitusviesti($vastine->aloitusviesti);
            $uusi->setSisalto($vastine->sisalto);
            $uusi->setKeskustelualue($vastine->keskustelualue);
            $a[] = $uusi;
        }

        return $a;
    }

    public static function lukumaara($viestiId) {
        //Lasketaan ja palautetaan aloitusviestin vastineiden lukumäärä
        $sql = "SELECT count(*) FROM Vastine where aloitusviesti = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($viestiId));
        return $kysely->fetchColumn();
    }

    public function getKirjoittajaNimi() {
        //Etsitään ja palauetetaan vastineen kirjoittajan nimi
        require_once 'libs/models/Kayttaja.php';
        return Kayttaja::etsiNimiIdlla($this->kirjoittaja);
    }

    public function lisaaKantaan() {
        //Lisätään viesti tietokantaan
        $sql = "INSERT INTO Vastine VALUES(default,?,?,?,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getKirjoittaja(), $this->getKeskustelualue(), $this->getAloitusviesti(),$this->getSisalto()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
    }
    
    public function etsiVastine($viestiId) {
        //Etsitään vastine tämän tietokanta-id:n perusteella
        $sql = "SELECT id, kirjoittaja, keskustelualue, aloitusviesti, sisalto from Vastine where id = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($viestiId));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $viesti = new Vastine();
            $viesti->setId($tulos->id);
            $viesti->setKirjoittaja($tulos->kirjoittaja);
            $viesti->setKeskustelualue($tulos->keskustelualue);
            $viesti->setAloitusviesti($tulos->aloitusviesti);
            $viesti->setSisalto($tulos->sisalto);

            return $viesti;
        }
    }
    
    public function muokkaaVastinetta($id) {
        //Muokataan annetun id:n määräämää vastinetta
        $sql = "update Vastine set sisalto = ? where id = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getSisalto(), $id));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
    }
    
    public function poistaVastine($id) {
        //Poistetaan annetun id:n määräämä vastine
        $sql = "delete from Vastine where id = ?";
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

        //Vastine ei saa olla tyhjä eikä liian pitkä
        if (trim($this->sisalto) == '') {
            $this->virheet['sisalto'] = "Viesti ei saa olla tyhjä.";
        } elseif (strlen($this->sisalto) > 65535) {
            $this->virheet['sisalto'] = "Viestisi on liian pitkä.";
        }
        else {
            unset($this->virheet['sisalto']);
        }
    }
    
    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function getAloitusviesti() {
        return $this->aloitusviesti;
    }

    public function setAloitusviesti($aloitusviesti) {
        $this->aloitusviesti = $aloitusviesti;
    }

}