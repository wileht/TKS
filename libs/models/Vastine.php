<?php

class Vastine {

    private $id;
    private $kirjoittaja;
    private $keskustelualue;
    private $aloitusviesti;
    private $sisalto;

    public function __construct($id, $kirjoittaja, $keskustelualue, $aloitusviesti, $sisalto) {
        $this->id = $id;
        $this->kirjoittaja = $kirjoittaja;
        $this->keskustelualue = $keskustelualue;
        $this->aloitusviesti = $aloitusviesti;
        $this->sisalto = $sisalto;
    }

    public function etsiVastineet($viestiId, $montako, $sivunro) {
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
        $sql = "SELECT count(*) FROM Vastine where aloitusviesti = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($viestiId));
        return $kysely->fetchColumn();
    }

    public function getKirjoittajaNimi() {
        require_once 'libs/models/Kayttaja.php';
        return Kayttaja::etsiNimiIdlla($this->kirjoittaja);
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
    }

    public function getAloitusviesti() {
        return $this->aloitusviesti;
    }

    public function setAloitusviesti($aloitusviesti) {
        $this->aloitusviesti = $aloitusviesti;
    }

}