<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Keskustelualue.php';
require_once 'libs/models/RyhmanKeskustelualueet.php';

RyhmanKeskustelualueet::poistaAlueenVanhatOikeudet($_GET['id']);

if (!empty($_POST['checklist'])) {
    foreach ($_POST['checklist'] as $check) {
        $uusiRyhmaAlue = new RyhmanKeskustelualueet();
        $uusiRyhmaAlue->setKayttajaryhma($check);
        $uusiRyhmaAlue->setKeskustelualue($alueId);
        $uusiRyhmaAlue->lisaaKantaan();
    }
}
$_SESSION['ilmoitus'] = "Muokkaus onnistui.";
header('Location: alueet.php');