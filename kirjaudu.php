<?php

require_once "libs/funktiot.php";

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

require_once 'libs/models/Kayttaja.php';
$oikeaKayttaja = Kayttaja::etsiKayttajaTunnuksilla($kayttaja,$salasana);

if($oikeaKayttaja == null) {
    naytaNakyma('kirjautuminen.php', array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."
    ));
}

session_start();

$_SESSION['kirjautunut'] = $oikeaKayttaja;

header('Location: etusivu.php');
//if ($kayttaja == $oikeaKayttaja->nimi && $salasana == $oikeaKayttaja->salasana) {
//    header('Location: index.php');
//} else {
//    naytaNakyma('kirjautuminen.php', array(
//        'kayttaja' => $kayttaja,
//        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."
//    ));
//}