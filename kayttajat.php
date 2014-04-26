<?php

require_once 'libs/funktiot.php';
//Vain ylläpitäjillä on oikeus tarkastella tätä sivua
if (onkoYllapitaja()) {
    require_once 'libs/models/Kayttaja.php';
    $kayttajat = Kayttaja::etsiKaikki();

    require_once 'libs/models/Kayttajaryhma.php';
    $ryhmat = Kayttajaryhma::kaikkiRyhmat();

    naytaNakyma('kayttajat.php', array('kayttajat' => $kayttajat, 'ryhmat' => $ryhmat));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}