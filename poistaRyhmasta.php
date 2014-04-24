<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Ryhmankayttajat.php';
session_start();
if (onkoYllapitaja()) {
    if (!empty($_POST['checklist'])) {
        foreach ($_POST['checklist'] as $check) {
            Ryhmankayttajat::poistaKayttajaRyhmasta($check, $_GET['ryhmaId']);
        }
        $_SESSION['ilmoitus'] = "Käyttäjä(t) poistettu.";
        header('Location: muokkaaRyhmaa.php?ryhmaId=' . $_GET['ryhmaId']);
    } else {
        $_SESSION['ilmoitus'] = "Et valinnut yhtäkään käyttäjää.";
        header('Location: muokkaaRyhmaa.php?ryhmaId=' . $_GET['ryhmaId']);
    }
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}