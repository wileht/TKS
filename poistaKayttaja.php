<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Kayttaja.php';

//Vain ylläpitäjä voi poistaa käyttäjiä
if (onkoYllapitaja()) {
    Kayttaja::poistaKayttaja($_GET['kayttajaId']);

    session_start();
    $_SESSION['ilmoitus'] = "Käyttäjä poistettu.";
    header('Location: kayttajat.php');
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}