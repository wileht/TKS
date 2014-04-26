<?php

session_start();
require_once "libs/models/Aloitusviesti.php";
require_once "libs/models/Kayttaja.php";
require_once 'libs/funktiot.php';

//Luodaan muokkausta ja virheentarkistusta varten uusi Aloitusviesti, jonka kautta Aloitusviesti-luokan metodeja voidaan kutsua
$uusiViesti = new Aloitusviesti();
$uusiViesti->setKirjoittaja($_SESSION['kirjautunut']);
$uusiViesti->setKeskustelualue($_GET['id']);
$uusiViesti->setSisalto($_POST['sisalto']);
$uusiViesti->setOtsikko($_POST['otsikko']);

if ($uusiViesti->onkoKelvollinen()) {
    $uusiViesti->muokkaaAloitusviestia($_GET['viesti']);
    $_SESSION['ilmoitus'] = "Muokkaus onnistui.";
    header('Location: viesti.php?viesti=' . $_GET['viesti']);
} else {
    //Mikäli muokkaus ei onnistunut, palautetaan käyttäjä muokkausnäkymään virheellisine muokkauksineen
    $virheet = $uusiViesti->getVirheet();

    if (isset($_POST["sisalto"])) {
        $sisalto = $_POST["sisalto"];
    } else {
        $sisalto = null;
    }
    if (isset($_POST["otsikko"])) {
        $otsikko = $_POST["otsikko"];
    } else {
        $otsikko = null;
    }

    naytaNakyma('muokkaaAloitusviestia.php', array(
        'virheet' => $virheet, 'sisalto' => $sisalto, 'otsikko' => $otsikko
    ));
}