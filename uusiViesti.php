<?php

require_once 'libs/funktiot.php';

//Tarkistetaan onko kirjautuneella käyttäjällä oikeus tarkastella tätä sivua
if (onkoKayttajallaOikeuttaAlueeseen($_GET['id'])) {
    require_once 'libs/models/Aloitusviesti.php';
    $aloitusviesti = Aloitusviesti::etsiAloitusviesti($_GET['viesti']);

    require_once 'libs/models/Keskustelualue.php';
    $alueNimi = Keskustelualue::etsiNimiIdlla($_GET['id']);

    naytaNakyma("uusiViesti.php", array('aloitusviesti' => $aloitusviesti, 'alueNimi' => $alueNimi));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}