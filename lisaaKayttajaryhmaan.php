<?php

require_once 'libs/funktiot.php';
//Vain ylläpitäjillä on oikeus tarkastella tätä sivua
if (onkoYllapitaja()) {
    require_once 'libs/models/Ryhmankayttajat.php';

    //Lisätään käyttäjä haluttuihin käyttäjäryhmiin
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
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}