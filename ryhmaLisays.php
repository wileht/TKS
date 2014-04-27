<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Kayttajaryhma.php';

//Luodaan lisäystä varten uusi Kayttajaryhma-luokan ilmentymä
$uusiRyhma = new Kayttajaryhma();
$uusiRyhma->setNimi($_POST['nimi']);

if (!$uusiRyhma->onkoNimiVapaa()) {
    $_SESSION['ilmoitus'] = "Antamasi nimi on jo käytössä.";
    header('Location: uusiRyhma.php');
} else {
//Mikäli ryhmän nimi on kelvollinen, ryhmä lisätään tietokantaan
    if ($uusiRyhma->onkoKelvollinen()) {
        $uusiRyhma->lisaaKantaan();

        $_SESSION['ilmoitus'] = "Käyttäjäryhmä luotu.";
        header('Location: ryhmat.php');
    } else {
        //Mikäli ryhmän nimi ei ole kelvollinen, käyttäjä palautetaan lisäysnäkymään
        $virheet = $uusiRyhma->getVirheet();

        if (isset($_POST["nimi"])) {
            $nimi = $_POST["nimi"];
        } else {
            $nimi = null;
        }

        naytaNakyma('uusiRyhma.php', array('nimi' => $nimi, 'virheet' => $virheet));
    }
}