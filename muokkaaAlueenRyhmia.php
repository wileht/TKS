<?php
require_once 'libs/funktiot.php';
//Vain ylläpitäjillä on oikeus tarkastella tätä sivua
if (onkoYllapitaja()) {
    require_once 'libs/models/Kayttajaryhma.php';
    require_once 'libs/models/Keskustelualue.php';

    $ryhmat = Kayttajaryhma::kaikkiRyhmat();
    $nimi = Keskustelualue::etsiNimiIdlla($_GET['id']);

    naytaNakyma('muokkaaAlueenRyhmia.php', array('ryhmat' => $ryhmat, 'nimi' => $nimi));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}