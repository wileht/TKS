<?php 
//$sivu = "muokkaaAloitusviestia.php";
//require_once 'views/pohja.php';
require_once 'libs/models/Aloitusviesti.php';
$viesti = Aloitusviesti::etsiAloitusviesti($_GET['viesti']);
require_once 'libs/funktiot.php';
naytaNakyma("muokkaaAloitusviestia.php", array('otsikko' => $viesti->getOtsikko(), 'sisalto' => $viesti->getSisalto()));