<?php

require_once 'libs/funktiot.php';
$id = (int) $_GET['id'];

if (onkoKayttajallaOikeuttaAlueeseen($id)) {

//Sivutusta varten
    if (isset($_GET['sivu'])) {
        $sivu = (int) $_GET['sivu'];

        if ($sivu < 1) {
            $sivu = 1;
        }
    } else {
        $sivu = 1;
    }

    $montako = 10;

//Etsitään keskustelualueen aloitusviestit
    require_once 'libs/models/Aloitusviesti.php';
    $viestit = Aloitusviesti::etsiAlueenViestit($id, $sivu, $montako);

    $sivuja = ceil(Aloitusviesti::lukumaara($id) / $montako);

    require_once 'libs/models/Keskustelualue.php';
    $alueNimi = Keskustelualue::etsiNimiIdlla($id);

    naytaNakyma('keskustelualue.php', array('sivuja' => $sivuja, 'sivu' => $sivu, 'viestit' => $viestit, 'alueNimi' => $alueNimi));
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}