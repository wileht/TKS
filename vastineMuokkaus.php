<?php
session_start();
require_once "libs/models/Vastine.php";
require_once "libs/models/Kayttaja.php";
require_once 'libs/funktiot.php';

//Luodaan muokkausta varten uusi Vastine-luokan ilmentymä
$uusiViesti = new Vastine();
$uusiViesti->setKirjoittaja($_SESSION['kirjautunut']);
$uusiViesti->setKeskustelualue($_GET['id']);
$uusiViesti->setSisalto($_POST['sisalto']);
$uusiViesti->setAloitusviesti($_GET['viesti']);

if ($uusiViesti->onkoKelvollinen()) {
    $uusiViesti->muokkaaVastinetta($_GET['vastine']);
    $_SESSION['ilmoitus'] = "Muokkaus onnistui.";
    header('Location: viesti.php?id='.$_GET['id'].'&viesti=' . $_GET['viesti']);
} else {
    $virheet = $uusiViesti->getVirheet();

    if (isset($_POST["sisalto"])) {
        $sisalto = $_POST["sisalto"];
    } else {
        $sisalto = null;
    }

    naytaNakyma('muokkaaVastinetta.php', array(
        'virheet' => $virheet, 'sisalto' => $sisalto
    ));
}