<?php

class Kayttaja {

    private $id;
    private $nimi;
    private $salasana;

    public function __construct($id, $nimi, $salasana) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->salasana = $salasana;
    }

    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        $sql = "SELECT id, nimi, salasana from kayttaja where nimi = ? AND salasana = ? LIMIT 1";
        require_once "tietokantayhteys.php";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja($tulos->id,$tulos->nimi,$tulos->salasana);
            $kayttaja->setId($tulos->id);
            $kayttaja->setNimi($tulos->nimi);
            $kayttaja->setSalasana($tulos->salasana);

            return $kayttaja;
        }
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
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

}