<?php 
require_once 'libs/funktiot.php';
require_once 'libs/models/Kayttajaryhma.php';

$ryhmat = Kayttajaryhma::kaikkiRyhmat();

naytaNakyma('uusiAlue.php', array('ryhmat' => $ryhmat));