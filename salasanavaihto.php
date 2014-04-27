<?php

require_once "libs/funktiot.php";
require_once "libs/models/Kayttaja.php";

//Jos jompikumpi salasanakentistä on tyhjä, vaihtoa ei hyväksytä
if (empty($_POST["password1"])) {
    naytaNakyma('vaihdaSalasana.php', array(
        'virhe' => "Salasanan vaihto epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana1 = $_POST["password1"];

if (empty($_POST["password2"])) {
    naytaNakyma('vaihdaSalasana.php', array(
        'salasana1' => $salasana1,
        'virhe' => "Salasanan vaihto epäonnistui! Et vahvistanut salasanaa.",
    ));
}
$salasana2 = $_POST["password2"];

//Jos annetut salasanat eivät tästmää, vaihtoa ei hyväksytä
if ($_POST['password1'] != $_POST['password2']) {
    naytaNakyma('vaihdaSalasana.php', array(
        'salasana1' => $salasana1,
        'salasana2' => $salasana2,
        'virhe' => "Salasanan vaihto epäonnistui! Annetut salasanat eivät täsmää.",
    ));
}

//Luodaan uusi Kayttaja-luokan ilmentymä, jotta luokan metodeja voidaan kutsua
$uusiKayttaja = new Kayttaja();
$uusiKayttaja->setSalasana($salasana1);

//Mikäli salasana kelvollinen, sitä vastaavaa riviä muutetaan tietokannassa
if ($uusiKayttaja->onkoKelvollinen()) {
    $uusiKayttaja->muutaSalasanaa($_SESSION['kirjautunut'], $salasana1);

    $_SESSION['ilmoitus'] = "Salasanan vaihto onnistui.";
    header('Location: etusivu.php');
} else {
    $virheet = $uusiKayttaja->getVirheet();

    if (isset($_POST["password1"])) {
        $salasana1 = $_POST["password1"];
    } else {
        $salasana1 = null;
    }

    naytaNakyma('vaihdaSalasana.php', array(
        'virheet' => $virheet, 'salasana1' => $salasana1
    ));
}