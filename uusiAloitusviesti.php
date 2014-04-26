<?php

//$sivu = "uusiAloitusviesti.php";
//require_once 'views/pohja.php';
require_once 'libs/funktiot.php';
require_once 'libs/models/Keskustelualue.php';
$alueNimi = Keskustelualue::etsiNimiIdlla($_GET['id']);

if (onkoKayttajallaOikeuttaAlueeseen($_GET['id'])) {
    naytaNakyma("uusiAloitusviesti.php", array('alueNimi' => $alueNimi));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}