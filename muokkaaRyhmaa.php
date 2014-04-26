<?php

require_once 'libs/funktiot.php';
//Vain ylläpitäjillä on oikeus tarkastella tätä sivua
if (onkoYllapitaja()) {
    require_once 'libs/models/Kayttaja.php';
    require_once 'libs/models/Ryhmankayttajat.php';
    $kayttajat = Ryhmankayttajat::etsiRyhmanKayttajat($_GET['ryhmaId']);

    require_once 'libs/funktiot.php';
    naytaNakyma('muokkaaRyhmaa.php', array('kayttajat' => $kayttajat));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}