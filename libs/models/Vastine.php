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
        $this->id = $sisalto;
    }
    
    public function getAloitusviesti() {
        return $this->aloitusviesti;
    }
    
    public function setAloitusviesti($aloitusviesti) {
        $this->aloitusviesti = $aloitusviesti;
    }
}