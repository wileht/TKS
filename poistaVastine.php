<?php
require_once 'libs/funktiot.php';
require_once 'libs/models/Vastine.php';

$viesti = Vastine::etsiVastine($_GET['vastine']);

//Vain ylläpitäjät ja viestin kirjoittanut käyttäjä voivat poistaa vastineet
if (onkoKirjoittaja($viesti) || onkoYllapitaja()) {
    Vastine::poistaVastine($_GET['vastine']);
    
    session_start();
    $_SESSION['ilmoitus'] = "Viesti poistettu.";
    header('Location: viesti.php?id='.$_GET['id'].'&viesti=' . $_GET['viesti']);
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}