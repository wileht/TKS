<?php 
//$sivu = "uusiAloitusviesti.php";
//require_once 'views/pohja.php';

require_once 'libs/models/Keskustelualue.php';
$alueNimi = Keskustelualue::etsiNimiIdlla($_GET['id']);

require_once 'libs/funktiot.php';
naytaNakyma("uusiAloitusviesti.php", array('alueNimi' => $alueNimi));