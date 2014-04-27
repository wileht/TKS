<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Aloitusviesti.php';

$viesti = Aloitusviesti::etsiAloitusviesti($_GET['viesti']);
//Muokkausnäkymä näytetään vain, jos kirjautunut käyttäjä on ylläpitäjä tai viestin kirjoittaja
if (onkoKirjoittaja($viesti) || onkoYllapitaja()) {
    naytaNakyma("muokkaaAloitusviestia.php", array('otsikko' => $viesti->getOtsikko(), 'sisalto' => $viesti->getSisalto()));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}