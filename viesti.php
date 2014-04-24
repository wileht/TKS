<?php

require_once 'libs/funktiot.php';

$viestiId = (int) $_GET['viesti'];
kayttajaLukenut($viestiId);

//Sivutusta varten
if (isset($_GET['sivu'])) {
    $sivu = (int) $_GET['sivu'];

    if ($sivu < 1) {
        $sivu = 1;
    }
} else {
    $sivu = 1;
}

$montako = 10;

//Etsitään haluttu aloitusviesti. Mikäli viestiä ei löydy, ohjataan käyttäjä takaisin keskustelualueelle.
require_once 'libs/models/Aloitusviesti.php';
$aloitusviesti = Aloitusviesti::etsiAloitusviesti($viestiId);

if ($aloitusviesti == null) {
    naytaNakyma('keskustelualue.php?id=' . $_GET['id'], array(
        'virhe' => "Viestiä ei löytynyt!"
    ));
}

require_once 'libs/models/Vastine.php';
$vastineet = Vastine::etsiVastineet($viestiId, $montako, $sivu);
$vastineita = Vastine::lukumaara($viestiId);
if ($vastineita == 0) {
    $sivuja = 1;
} else {
    $sivuja = ceil($vastineita / $montako);
}

require_once 'libs/models/Keskustelualue.php';
$alueNimi = Keskustelualue::etsiNimiIdlla($_GET['id']);

naytaNakyma('viesti.php', array('sivuja' => $sivuja, 'sivu' => $sivu, 'vastineet' => $vastineet, 'aloitusviesti' => $aloitusviesti, 'alueNimi' => $alueNimi));