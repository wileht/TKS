<?php

class Keskustelualue {

    private $id;
    private $nimi;
    private $virheet;

    public function __construct($id, $nimi, $virheet) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->virheet = $virheet;
    }

    public function kaikkiAlueet() {
        //Etsitään ja palautetaan kaikki foorumin keskustelualueet
        $sql = "SELECT id, nimi from Keskustelualue";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $a = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $jasen) {
            $uusi = new Keskustelualue();
            $uusi->setId($jasen->id);
            $uusi->setNimi($jasen->nimi);
            $a[] = $uusi;
        }
        return $a;
    }

    public function etsiNimiIdlla($id) {
        //Etsitään keskustelualueen nimi id:n perusteella
        $sql = "SELECT nimi from Keskustelualue where id = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return "[Tuntematon keskustelualue]";
        } else {
            return $tulos->nimi;
        }
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function lisaaKantaan() {
        //Lisätään keskustelualue tietokantaan, palautetaan alueen tietokannassa saama id
        $sql = "INSERT INTO Keskustelualue VALUES(default,?) RETURNING id";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getNimi()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $this->id;
    }

    public function poistaKeskustelualue($id) {
        //Poistetaan annettu keskustelualue tietokannasta
        $sql = "delete from Keskustelualue where id = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($id));
    }

    public function onkoNimiVapaa() {
        //Selvitetään onko tietokannassa samannimistä keskustelualuetta
        $nimi = $this->nimi;

        $sql = "SELECT id from Keskustelualue where nimi = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return true;
        } else {
            return false;
        }
    }

    public function getViesteja() {
        //Palautetaan keskustelualueen aloitusviestien lukumäärä
        require_once 'libs/models/Aloitusviesti.php';
        return Aloitusviesti::lukumaara($this->id);
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public function setVirheet($virheet) {
        $this->virheet = $virheet;
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

    public function setNimi($nimi) {
        $this->nimi = $nimi;

        //Keskustelualueen nimi ei saa olla tyhjä eikä liian pitkä
        if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä.";
        } elseif (strlen($this->nimi) > 50) {
            $this->virheet['nimi'] = "Keskustelualueen nimi on liian pitkä.";
        } else {
            unset($this->virheet['nimi']);
        }
    }

}