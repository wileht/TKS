<?php 
require_once 'libs/models/Aloitusviesti.php';
$aloitusviesti = Aloitusviesti::etsiAloitusviesti($_GET['viesti']);

require_once 'libs/models/Keskustelualue.php';
$alueNimi = Keskustelualue::etsiNimiIdlla($_GET['id']);

require_once 'libs/funktiot.php';
naytaNakyma("uusiViesti.php", array('aloitusviesti' => $aloitusviesti, 'alueNimi' => $alueNimi));