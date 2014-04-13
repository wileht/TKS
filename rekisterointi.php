<?php
require_once "libs/funktiot.php";

//Rekisteröitymistä ei hyväksytä, jos annettu käyttäjätunnus tai salasana on tyhjä
if (empty($_POST["username"])) {
    naytaNakyma('rekisteroi.php', array(
        'virhe' => "Rekisteröityminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}
$kayttaja = $_POST["username"];

if (empty($_POST["password"])) {
    naytaNakyma('rekisteroi.php', array(
        'kayttaja' => $kayttaja,
        'virhe' => "Rekisteröityminen epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana = $_POST["password"];

require_once 'libs/models/Kayttaja.php';
$onkoVapaa = Kayttaja::onkoTunnusVapaa($kayttaja);

//Rekisteröitymistä ei myöskään hyväksytä, jos annettu käyttäjätunnus on jo käytössä
if (!$onkoVapaa) {
    naytaNakyma('rekisteroi.php', array(
        'kayttaja' => $kayttaja,
        'virhe' => "Rekisteröityminen epäonnistui! Antamasi tunnus on jo käytössä."
    ));
} else {
    $uusiKayttaja = new Kayttaja();
    $uusiKayttaja->setNimi($kayttaja);
    $uusiKayttaja->setSalasana($salasana);

    //Mikäli käyttäjätunnus on vapaa ja kelvollinen, se lisätään tietokantaan ja käyttäjä kirjataan sisään
    if ($uusiKayttaja->onkoKelvollinen()) {
        $uusiKayttaja->lisaaKantaan();

        session_start();
        $_SESSION['kirjautunut'] = $uusiKayttaja->getId();
        $_SESSION['ilmoitus'] = "Rekisteröityminen onnistui.";
        header('Location: etusivu.php');
    } else {
        $virheet = $uusiKayttaja->getVirheet();

        if (isset($_POST["username"])) {
            $kayttaja = $_POST["username"];
        } else {
            $kayttaja = null;
        }
        if (isset($_POST["password"])) {
            $salasana = $_POST["password"];
        } else {
            $salasana = null;
        }

        naytaNakyma('rekisteroi.php', array(
            'virheet' => $virheet, 'kayttaja' => $kayttaja, 'salasana' => $salasana
        ));
    }
}