<?php

session_start();
require_once "libs/models/Aloitusviesti.php";
require_once "libs/models/Kayttaja.php";
require_once 'libs/funktiot.php';

//Luodaan viestille Aloitusviesti-luokan ilmentymä
$uusiViesti = new Aloitusviesti();
$uusiViesti->setKirjoittaja($_SESSION['kirjautunut']);
$uusiViesti->setKeskustelualue($_GET['id']);
$uusiViesti->setSisalto($_POST['sisalto']);
$uusiViesti->setOtsikko($_POST['otsikko']);
$uusiViesti->setPaivamaara(pvmNyt());

//Mikäli viesti on kelvollinen, se lisätään tietokantaan
if ($uusiViesti->onkoKelvollinen()) {
    $uusiViesti->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Viesti lähetetty.";
    header('Location: viesti.php?id=' . $_GET['id'] . '&viesti=' . $uusiViesti->getId());
} else {
    //Mikäli viesti ei ole kelvollinen, käyttäjä palautetaan kirjoitusnäkymään
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

    naytaNakyma('uusiAloitusviesti.php', array(
        'virheet' => $virheet, 'sisalto' => $sisalto, 'otsikko' => $otsikko
    ));
}