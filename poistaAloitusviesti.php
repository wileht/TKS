<?php
require_once 'libs/funktiot.php';
require_once 'libs/models/Aloitusviesti.php';
$viesti = Aloitusviesti::etsiAloitusviesti($_GET['viesti']);

//Vain ylläpitäjä voi poistaa aloitusviestejä, koska aloitusviestin poistaminen poistaa myös sen vastineet
if (onkoYllapitaja()) {
    Aloitusviesti::poistaAloitusviesti($_GET['viesti']);
    
    session_start();
    $_SESSION['ilmoitus'] = "Viesti poistettu.";
    header('Location: keskustelualue.php?id=' . $_GET['id']);
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}