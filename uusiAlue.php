<?php

require_once 'libs/funktiot.php';
//Vain ylläpitäjillä on oikeus tarkastella tätä sivua
if (onkoYllapitaja()) {
    require_once 'libs/models/Kayttajaryhma.php';

    $ryhmat = Kayttajaryhma::kaikkiRyhmat();

    naytaNakyma('uusiAlue.php', array('ryhmat' => $ryhmat));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}