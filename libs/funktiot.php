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