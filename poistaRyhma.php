<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Kayttajaryhma.php';

//Vain ylläpitäjä voi poistaa käyttäjäryhmiä
if (onkoYllapitaja()) {
    Kayttajaryhma::poistaKayttajaryhma($_GET['ryhmaId']);

    session_start();
    $_SESSION['ilmoitus'] = "Ryhmä poistettu.";
    header('Location: ryhmat.php');
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}