<?php 
require_once 'libs/models/Kayttaja.php';
require_once 'libs/models/Ryhmankayttajat.php';
$kayttajat = Ryhmankayttajat::etsiRyhmanKayttajat($_GET['ryhmaId']);

require_once 'libs/funktiot.php'; 
naytaNakyma('muokkaaRyhmaa.php', array('kayttajat' => $kayttajat));