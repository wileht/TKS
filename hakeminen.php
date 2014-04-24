<?php

require_once 'libs/funktiot.php';
require_once 'libs/models/Aloitusviesti.php';
require_once 'libs/models/Vastine.php';

if (empty($_POST["hakusanat"])) {
    naytaNakyma('haku.php', array(
        'virhe' => "Haku epäonnistui! Et antanut hakusanoja."
    ));
}

$hakusanat = $_POST["hakusanat"];
$kirjoittaja = $_POST['kirjoittaja'];
$ennen = $_POST['ennen'] + " 00:00:00";
$jalkeen = $_POST['jalkeen'] + " 00:00:00";

$sanat = explode(" ", $hakusanat);
$sanoja = count($sanat);

if ($sanoja > 10) {
    naytaNakyma('haku.php', array(
        'virhe' => "Haku epäonnistui! Annoit liikaa hakusanoja.",
    ));
}

$a = array();
foreach ($sanat as $sana) {
    if ($sana == "ja" || $sana == "on" || $sana == "ei" || $sana == "mutta" || $sana == "että" || $sana == "tai") {
        $sanoja--;
        continue;
    }
    
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

$poistettavat = array();
if (!empty($kirjoittaja)) {
    foreach ($b as $viesti) {
        if ($kirjoittaja != $viesti->getKirjoittajaNimi()) {
            $poistettavat[] = $viesti;
        }
    }
}

if (!empty($ennen)) {
    foreach ($b as $viesti) {
        if ($ennen < $viesti->getPaivamaara()) {
            $poistettavat[] = $viesti;
        }
    }
}

if (!empty($jalkeen)) {
    foreach ($b as $viesti) {
        if ($jalkeen > $viesti->getPaivamaara()) {
            $poistettavat[] = $viesti;
        }
    }
}

foreach ($poistettavat as $poistettava) {
    if (($key = array_search($poistettava, $b)) !== false) {
        unset($b[$key]);
    }
}

$b = array_map("unserialize", array_unique(array_map("serialize", $b)));

//if (isset($_GET['sivu'])) {
//    $sivu = (int) $_GET['sivu'];
//
//    if ($sivu < 1) {
//        $sivu = 1;
//    }
//} else {
//    $sivu = 1;
//}
$sivu = 1;
$montako = 50;

$sivuja = ceil(count($b) / $montako);

naytaNakyma('hakutulokset.php', array('sivuja' => $sivuja, 'sivu' => $sivu, 'tulokset' => $b, 'montako' => $montako));