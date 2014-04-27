<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Keskustelualue.php';
require_once 'libs/models/RyhmanKeskustelualueet.php';

//Poistetaan ensin keskustelualueen vanhat lukuoikeudet
RyhmanKeskustelualueet::poistaAlueenVanhatOikeudet($_GET['id']);

//Lisätään uudet, halutut lukuoikeudet
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