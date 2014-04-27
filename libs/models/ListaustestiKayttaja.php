<?php

class Kayttaja {

    private $id;
    private $nimi;

    //private $password;

    public function __construct($id, $tunnus) {
        $this->id = $id;
        $this->nimi = $tunnus;
        //$this->salasana = $salasana;
    }

    public static function etsiKaikkiKayttajat() {
        //require_once "tietokantayhteys.php";
        $sql = "SELECT id, Nimi FROM Kayttaja";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja($tulos->id, $tulos->nimi);
            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public function getUsername() {
        return $this->nimi;
    }

    public function setTunnus($tunnus) {
        $this->nimi = $tunnus;
    }

    public function setId($id) {
        $this->id = $id;
    }

}