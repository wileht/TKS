<?php
require_once 'libs/funktiot.php';
require_once 'libs/models/Vastine.php';

$viesti = Vastine::etsiVastine($_GET['vastine']);
//Muokkausnäkymä näytetään vain, jos kirjautunut käyttäjä on ylläpitäjä tai viestin kirjoittaja
if (onkoKirjoittaja($viesti) || onkoYllapitaja()) {
    naytaNakyma("muokkaaVastinetta.php", array('sisalto' => $viesti->getSisalto()));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}