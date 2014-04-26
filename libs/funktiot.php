<?php

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function onkoKirjautunut() {
    //$_SESSION['kirjautunut'] asetetaan joko kirjaudu.php- tai rekisterointi.php-tiedostossa
    if (isset($_SESSION['kirjautunut'])) {
        return true;
    }
    return false;
}

function onkoYllapitaja() {
    if (!onkoKirjautunut()) {
        return false;
    }
    require_once "libs/models/Kayttaja.php";
    require_once "libs/models/Ryhmankayttajat.php";

    //Kysytään onko kirjautunut käyttäjä ylläpitäjäryhmän jäsen
    if (Ryhmankayttajat::onkoYllapitaja($_SESSION["kirjautunut"])) {
        return true;
    }
    return false;
}

function onkoKirjoittaja($viesti) {
    require_once "libs/models/Aloitusviesti.php";
    require_once "libs/models/Vastine.php";

    if (!onkoKirjautunut()) {
        return false;
    }
    //Katsotaan onko kirjautunut käyttäjä annetun aloitusviestin tai vastinen kirjoittaja
    if ($viesti->getKirjoittaja() == $_SESSION["kirjautunut"]) {
        return true;
    }
    return false;
}

function pvmNyt() {
    date_default_timezone_set('UTC+2');
    return date("Y-m-d H:i:s");
}

function kayttajaLukenut($viesti) {
    require_once 'libs/models/ViestinLukeneet.php';

    if (ViestinLukeneet::onkoLukenut($viesti, $_SESSION['kirjautunut'])) {
        return;
    } else {
        $uusiVL = new ViestinLukeneet();
        $uusiVL->setAloitusviesti($viesti);
        $uusiVL->setKayttaja($_SESSION['kirjautunut']);

        $uusiVL->lisaaKantaan();
    }
}

function onkoKirjautunutLukenut($viesti) {
    require_once 'libs/models/ViestinLukeneet.php';

    if (ViestinLukeneet::onkoLukenut($viesti, $_SESSION['kirjautunut'])) {
        return true;
    } else {
        return false;
    }
}

function onkoKirjautunutLukenutAlueen($alue) {
    require_once 'libs/models/Aloitusviesti.php';
    $viestit = Aloitusviesti::etsiAlueenKaikkiViestitId($alue);

    foreach ($viestit as $viesti) {
        if (!onkoKirjautunutLukenut($viesti)) {
            return false;
        }
    }
    return true;
}

function onkoKayttajallaOikeuttaAlueeseen($keskustelualue) {
    if (!onkoKirjautunut()) {
        return false;
    }
    if (onkoYllapitaja()) {
        return true;
    }

    require_once "libs/models/RyhmanKeskustelualueet.php";
    require_once "libs/models/Ryhmankayttajat.php";
    
    if (RyhmanKeskustelualueet::onkoKaikilleAvoin($keskustelualue)) {
        return true;
    }

    $ryhmat = Ryhmankayttajat::etsiKayttajanRyhmatVainId($_SESSION['kirjautunut']);

    foreach ($ryhmat as $ryhma) {
        if (RyhmanKeskustelualueet::onkoKayttajaryhmallaOikeuttaAlueeseen($ryhma, $keskustelualue)) {
            return true;
        }
    }
    return false;
}