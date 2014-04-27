<?php

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function onkoKirjautunut() {
    //$_SESSION['kirjautunut'] asetetaan joko kirjaudu.php- tai rekisterointi.php-tiedostossa. Jos se on asetettu,
    //käyttäjä on kirjautunut.
    if (isset($_SESSION['kirjautunut'])) {
        return true;
    }
    return false;
}

function onkoYllapitaja() {
    //Tarkisetaan onko kirjautunut käyttäjä ylläpitäjä
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
    //Tarkistetaan onko kirjautunut käyttäjä annetun viestin (aloitusviesti tai vastine) kirjoittaja
    require_once "libs/models/Aloitusviesti.php";
    require_once "libs/models/Vastine.php";

    if (!onkoKirjautunut()) {
        return false;
    }

    if ($viesti->getKirjoittaja() == $_SESSION["kirjautunut"]) {
        return true;
    }
    return false;
}

function pvmNyt() {
    //Palautetaan tämänhetkinen kellonaika ja päivämäärä
    date_default_timezone_set('UTC+2');
    return date("Y-m-d H:i:s");
}

function kayttajaLukenut($viesti) {
    //Tarkistetaan onko kirjautunut käyttäjä lukenut annetun aloitusviestin, ja jos ei ole, lisätään käyttäjä
    //viestin lukeneiden käyttäjien listaan
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
    //Tarkistetaan onko kirjaunut käyttäjä lukenut annetun aloitusviestin
    require_once 'libs/models/ViestinLukeneet.php';

    if (ViestinLukeneet::onkoLukenut($viesti, $_SESSION['kirjautunut'])) {
        return true;
    } else {
        return false;
    }
}

function onkoKirjautunutLukenutAlueen($alue) {
    //Tarkistetaan onko kirjautunut käyttäjä lukenut annetun keskustelualueen kaikki aloitusviestit
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
    //Tarkisteaan onko kirjautuneella käyttäjällä lukuoikeus annettuun keskustelualueeseen
    if (!onkoKirjautunut()) {
        return false;
    }
    //Ylläpitäjillä on oikeus lukea kaikkia keskustelualueita
    if (onkoYllapitaja()) {
        return true;
    }

    require_once "libs/models/RyhmanKeskustelualueet.php";
    require_once "libs/models/Ryhmankayttajat.php";

    //Jos keskustelualue on kaikille avoin, kaikki käyttäjät voivat lukea sitä
    if (RyhmanKeskustelualueet::onkoKaikilleAvoin($keskustelualue)) {
        return true;
    }

    //Etsitään kaikki käyttäjäryhmät, joihin kirjautunut käyttäjä kuuluu
    $ryhmat = Ryhmankayttajat::etsiKayttajanRyhmatVainId($_SESSION['kirjautunut']);

    //Jos käyttäjä kuuluu yhteenkin sellaiseen ryhmään, jolla on lukuoikeus keskustelualueeseen, on käyttäjällä
    //itselläänkin lukuoikeus alueeseen
    foreach ($ryhmat as $ryhma) {
        if (RyhmanKeskustelualueet::onkoKayttajaryhmallaOikeuttaAlueeseen($ryhma, $keskustelualue)) {
            return true;
        }
    }
    return false;
}