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

        $ok = $kysely->execute(array($this->getKayttajaryhma(), $this->getKeskustelualue()));
        if ($ok != null) {
            //Haetaan RETURNING-määreen palauttama id.
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }

    public function onkoKayttajaryhmallaOikeuttaAlueeseen($kayttajaryhma, $keskustelualue) {
        //Tarkistetaan onko annettu käyttäjä annetun käyttäjäryhmän jäsen
        require_once "tietokantayhteys.php";

        $sql1 = "SELECT kayttajaryhma, keskustelualue from Ryhmankeskustelualueet where kayttajaryhma = ? AND keskustelualue = ? LIMIT 1";
        $kysely1 = getTietokantayhteys()->prepare($sql1);
        $kysely1->execute(array($kayttajaryhma, $keskustelualue));
        $tulos2 = $kysely1->fetchObject();

        if ($tulos2 == null) {
            return false;
        }
        return true;
    }

    public function onkoKaikilleAvoin($keskustelualue) {
        require_once "tietokantayhteys.php";

        $sql1 = "SELECT kayttajaryhma from Ryhmankeskustelualueet where keskustelualue = ?";
        $kysely1 = getTietokantayhteys()->prepare($sql1);
        $kysely1->execute(array($keskustelualue));
        $tulos2 = $kysely1->fetchObject();

        if ($tulos2 == null) {
            return true;
        }
        return false;
    }

    public function poistaAlueenVanhatOikeudet($alue) {
        $sql = "delete from RyhmanKeskustelualueet where keskustelualue = ?";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($alue));
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