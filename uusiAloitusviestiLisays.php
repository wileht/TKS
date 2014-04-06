<?php

session_start();
require_once "libs/models/Aloitusviesti.php";
require_once "libs/models/Kayttaja.php";
$uusiViesti = new Aloitusviesti();
//$uusiViesti->setKirjoittaja($_SESSION['kirjautunut']->getId());
$uusiViesti->setKirjoittaja(1);
$uusiViesti->setKeskustelualue($_GET['id']);
$uusiViesti->setSisalto($_POST['sisalto']);
$uusiViesti->setOtsikko($_POST['otsikko']);

if ($uusiViesti->onkoKelvollinen()) {
    $uusiViesti->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Viesti lähetetty.";
    header('Location: keskustelualue.php?id=' . $_GET['id']);
} else {
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

    naytaNakyma('uusiAloitusviesti.php', array(
        'virheet' => $virheet, 'sisalto' => $sisalto, 'otsikko' => $otsikko
    ));
}