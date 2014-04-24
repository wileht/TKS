<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Ryhmankayttajat.php';

if (!empty($_POST['checklist'])) {
    foreach ($_POST['checklist'] as $check) {
        $uusiRyhmaKayttaja = new RyhmanKayttajat();
        $uusiRyhmaKayttaja->setKayttaja($check);
        $uusiRyhmaKayttaja->setKayttajaryhma($_POST['tahanRyhmaan']);
        $uusiRyhmaKayttaja->lisaaKantaan();
    }

    $_SESSION['ilmoitus'] = "Käyttäjä(t) lisättiin onnistuneesti.";
    header('Location: kayttajat.php');
} else {
    $_SESSION['ilmoitus'] = "Et valinnut yhtäkään käyttäjää.";
    header('Location: kayttajat.php');
}
