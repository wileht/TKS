<?php 
require_once 'libs/models/Kayttajaryhma.php';
$ryhmat = Kayttajaryhma::kaikkiRyhmat();

require_once 'libs/funktiot.php'; 
naytaNakyma('ryhmat.php', array('ryhmat' => $ryhmat));