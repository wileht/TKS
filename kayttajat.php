<?php 
require_once 'libs/models/Kayttaja.php';
$kayttajat = Kayttaja::etsiKaikki();

require_once 'libs/models/Kayttajaryhma.php';
$ryhmat = Kayttajaryhma::kaikkiRyhmat();

require_once 'libs/funktiot.php'; 
naytaNakyma('kayttajat.php', array('kayttajat' => $kayttajat, 'ryhmat' => $ryhmat));