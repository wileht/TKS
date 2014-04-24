<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Kayttajaryhma.php';

$uusiRyhma = new Kayttajaryhma();
$uusiRyhma->setNimi($_POST['nimi']);

//Mikäli viesti on kelvollinen, se lisätään tietokantaan
if ($uusiRyhma->onkoKelvollinen()) {
    $uusiRyhma->lisaaKantaan();

    $_SESSION['ilmoitus'] = "Käyttäjäryhmä luotu.";
    header('Location: ryhmat.php');
} else {
    //Mikäli viesti ei ole kelvollinen, käyttäjä palautetaan kirjoitusnäkymään
    $virheet = $uusiRyhma->getVirheet();

    if (isset($_POST["nimi"])) {
        $nimi = $_POST["nimi"];
    } else {
        $nimi = null;
    }

    naytaNakyma('uusiRyhma.php', array('nimi' => $nimi, 'virheet' => $virheet));
}