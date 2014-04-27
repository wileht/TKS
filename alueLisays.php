<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Keskustelualue.php';
require_once 'libs/models/RyhmanKeskustelualueet.php';

//Luodaan lisäystä vaeten uusi Keskustelualue-luokan ilmentymä
$uusiAlue = new Keskustelualue();
$uusiAlue->setNimi($_POST['nimi']);

//Foorumi ei hyväksy kahta samannimistä keskustelualuetta
if (!$uusiAlue->onkoNimiVapaa()) {
    $_SESSION['ilmoitus'] = "Antamasi nimi on jo käytössä.";
    header('Location: uusiAlue.php');
} else {
//Mikäli keskustelualueen nimi on kelvollinen, alue lisätään tietokantaan
    if ($uusiAlue->onkoKelvollinen()) {
        $alueId = $uusiAlue->lisaaKantaan();

        //Asetetaan keskustelualueelle halutun mukaiset lukuoikeudet
        if (!empty($_POST['checklist'])) {
            foreach ($_POST['checklist'] as $check) {
                $uusiRyhmaAlue = new RyhmanKeskustelualueet();
                $uusiRyhmaAlue->setKayttajaryhma($check);
                $uusiRyhmaAlue->setKeskustelualue($alueId);
                $uusiRyhmaAlue->lisaaKantaan();
            }
        }
        $_SESSION['ilmoitus'] = "Keskustelualue luotu.";
        header('Location: alueet.php');
    } else {
        //Mikäli keskustelualueen nimi ei ole kelvollinen, käyttäjä palautetaan lisäysnäkymään

        if (isset($_POST["nimi"])) {
            $nimi = $_POST["nimi"];
        } else {
            $nimi = null;
        }

        $_SESSION['ilmoitus'] = "Keskustelualueen nimi ei saa olla tyhjä.";
        header('Location: uusiAlue.php');
    }
}