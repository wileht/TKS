<?php

session_start();
require_once "libs/models/Aloitusviesti.php";
require_once "libs/models/Kayttaja.php";
require_once "libs/models/Vastine.php";

//Luodaan halutun kaltainen Vastine-luokan ilmentymä
$uusiViesti = new Vastine();
$uusiViesti->setKirjoittaja($_SESSION['kirjautunut']);
$uusiViesti->setKeskustelualue($_GET['id']);
$uusiViesti->setAloitusviesti($_GET['viesti']);
$uusiViesti->setSisalto($_POST['sisalto']);

//Mikäli luotu vastine on kelvollinen, lisätään se tietokantaan
if ($uusiViesti->onkoKelvollinen()) {
    $uusiViesti->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Viesti lähetetty.";
    header('Location: viesti.php?viesti=' . $_GET['viesti']);
} else {
    //Mikäli luotu vastine ei ole kelvollinen, käyttäjälle näytetään kirjoitusnäkymä virheellisine syötteineen
    $virheet = $uusiViesti->getVirheet();
    require_once 'libs/funktiot.php';

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

    naytaNakyma('uusiViesti.php', array(
        'virheet' => $virheet, 'sisalto' => $sisalto, 'otsikko' => $otsikko
    ));
}