<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Aloitusviesti.php';
require_once 'libs/models/Vastine.php';

//Ilman hakusanoja ei voi hakea
if (empty($_POST["hakusanat"])) {
    naytaNakyma('haku.php', array(
        'virhe' => "Haku epäonnistui! Et antanut hakusanoja."
    ));
}

//Hajotetaan hakusanat yksittäisiksi sanoiksi
$hakusanat = $_POST["hakusanat"];
$sanat = explode(" ", $hakusanat);
$sanoja = count($sanat);

//Liian pitkää hakusanayhdistelmää ei hyväksytä
if ($sanoja > 10) {
    naytaNakyma('haku.php', array(
        'virhe' => "Haku epäonnistui! Annoit liikaa hakusanoja.",
    ));
}

//Suoritetaan haku kaikille hakusanoille erikseen ja kootaan kaikki tulokset samaan listaan
$a = array();
foreach ($sanat as $sana) {
    //Haku suoritetaan sekä aloitusviesteille että vastineille
    $aloitusviestit = Aloitusviesti::etsiHakusanalla($sana);
    if ($aloitusviestit != null) {
        foreach ($aloitusviestit as $aloitusviesti) {
            $a[] = $aloitusviesti;
        }
    }

    $vastineet = Vastine::etsiHakusanalla($sana);
    if ($vastineet != null) {
        foreach ($vastineet as $vastine) {
            $a[] = $vastine;
        }
    }
}

//Lopulliseen tuloslistaan hyväksytään vain tulokset, joissa esiintyy kaikki annetut hakusanat. Halutun kaltaiset viestit
//esiintyvät siis aiemmin saadussa tuloslistassa niin monta kertaa kuin annetussa hakusanayhdistelmässä oli sanoja.
//Kerätään tämän ehdon toteuttavat viestit omaan listaansa.
$b = array();
foreach ($a as $jasen) {
    $count = 0;
    foreach ($a as $jasen1) {
        if ($jasen == $jasen1) {
            $count++;
        }
    }
    if ($count == $sanoja) {
        $b[] = $jasen;
    }
}

//Hakusanojen lisäksi käyttäjä pystyy asettamaan hakutuloksille myös muunlaisia ehtoja. Kerätään näiden ehtojen
//poistamat tulokset omaan listaansa.
$poistettavat = array();

//Mikäli viestin kirjoittajalle on annettu ehto, lisätään poistettaviin viesteihin kaikki viestit, joiden kirjoittaja
//ei ole halutun niminen.
$kirjoittaja = $_POST['kirjoittaja'];
if (!empty($kirjoittaja)) {
    foreach ($b as $viesti) {
        if ($kirjoittaja != $viesti->getKirjoittajaNimi()) {
            $poistettavat[] = $viesti;
        }
    }
}

//Mikäli hakutuloksien halutaan olevan tiettyä päivämäärää aiemmin kirjoitettuja, lisätään poistettaviin liian uudet viestit.
if (!empty($_POST['ennen'])) {
    $ennen = $_POST['ennen'] + " 00:00:00";
    foreach ($b as $viesti) {
        if ($ennen < $viesti->getPaivamaara()) {
            $poistettavat[] = $viesti;
        }
    }
}

//Mikäli hakutuloksien halutaan olevan tiettyä päivämäärää tuoreempia, lisätään poistettaviin liian vanhat viestit.
if (!empty($_POST['jalkeen'])) {
    $jalkeen = $_POST['jalkeen'] + " 00:00:00";
    foreach ($b as $viesti) {
        if ($jalkeen > $viesti->getPaivamaara()) {
            $poistettavat[] = $viesti;
        }
    }
}

//Verrataan täyttä hakutuloslistaa ja poistettavien listaa, ja kerätään poistettavien rivien avaimet omaan listaansa.
$avaimet = array();
foreach ($b as $bJasen) {
    if (($key = array_search($bJasen, $poistettavat)) !== false) {
        $avaimet[] = $key;
    }
}

//Käytetään aiemmin luotua avainlistaa poistamaan hakutuloslistalta halutut rivit.
foreach ($avaimet as $key) {
    unset($b[$key]);
}

//Varmistetaan, että kukin viesti esiintyy hakutuloksissa vain kerran
$b = array_map("unserialize", array_unique(array_map("serialize", $b)));

naytaNakyma('hakutulokset.php', array('tulokset' => $b));