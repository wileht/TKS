<?php 
$viestiId = (int) $_GET['viesti'];

if (isset($_GET['sivu'])) {
    $sivu = (int)$_GET['sivu'];

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1) {
        $sivu = 1;
    }
} else {
    $sivu = 1;
}

$montako = 10;

require_once 'libs/models/Aloitusviesti.php';
$aloitusviesti = Aloitusviesti::etsiAloitusviesti($viestiId);

if ($aloitusviesti == null) {
    naytaNakyma('keskustelualue.php', array(
        'virhe' => "Viestiä ei löytynyt!"
    ));
}

require_once 'libs/models/Vastine.php';
$vastineet = Vastine::etsiVastineet($viestiId, $montako, $sivu);

$sivuja = ceil(Vastine::lukumaara($viestiId) / $montako);

require_once 'libs/funktiot.php';

    naytaNakyma('viesti.php', array('sivuja' => $sivuja, 'sivu' => $sivu, 'vastineet' => $vastineet, 'aloitusviesti' => $aloitusviesti));
//        $sivu = "keskustelualue.php";
//        require_once 'views/pohja.php';


//$sivu = "viesti.php";
//require_once 'libs/models/Keskustelualue.php';
//$alueet = Keskustelualue::kaikkiAlueet();
//require_once 'views/pohja.php'; 