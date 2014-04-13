<?php 
require_once 'libs/models/Aloitusviesti.php';
$aloitusviesti = Aloitusviesti::etsiAloitusviesti($_GET['viesti']);
require_once 'libs/funktiot.php';
naytaNakyma("uusiViesti.php", array('aloitusviesti' => $aloitusviesti));