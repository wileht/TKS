<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Keskustelualue.php';

//Vain ylläpitäjä voi poistaa keskustelualueita
if (onkoYllapitaja()) {
    Keskustelualue::poistaKeskustelualue($_GET['id']);

    session_start();
    $_SESSION['ilmoitus'] = "Keskustelualue poistettu.";
    header('Location: alueet.php');
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}