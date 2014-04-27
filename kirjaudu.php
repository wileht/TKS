<?php

require_once "libs/funktiot.php";
//Jos käyttäjätunnus tai salasana on tyhjä, kirjautumista ei hyväksytä
if (empty($_POST["username"])) {
    naytaNakyma('kirjautuminen.php', array(
        'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}
$kayttaja = $_POST["username"];

if (empty($_POST["password"])) {
    naytaNakyma('kirjautuminen.php', array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana = $_POST["password"];

//Jos annettua käyttäjä--salasana-yhdistelmää ei löydy, ei kirjautumista myöskään hyväksytä
require_once 'libs/models/Kayttaja.php';
$oikeaKayttaja = Kayttaja::etsiKayttajaTunnuksilla($kayttaja, $salasana);

if ($oikeaKayttaja == null) {
    naytaNakyma('kirjautuminen.php', array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."
    ));
}

//Jos ongelmia ei ilmene, käyttäjä kirjataan sisään
session_start();
$_SESSION['kirjautunut'] = $oikeaKayttaja->getId();

header('Location: etusivu.php');