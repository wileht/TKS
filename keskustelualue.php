<?php

$id = (int) $_GET['id'];

//$sivunro = 1;
//$sivunro = (int) $_GET['sivu'];
//if (isset($_GET['sivu'])) {
//    $sivunro = $sivunro + 1;
//    //$sivunro = $_GET['sivu'];
//    
//    if ($sivunro < 1) {
//        $sivunro = 1;
//    }
//} else {
//    $sivunro = (int) $_GET['sivu'];
//    $sivunro = 1;
//}
//$sivunro = 1;

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
$viestit = Aloitusviesti::etsiAlueenViestit($id, $sivu, $montako);

$sivuja = ceil(Aloitusviesti::lukumaara($id) / $montako);

require_once 'libs/funktiot.php';

//$viestit != null) 
    naytaNakyma('keskustelualue.php', array('sivuja' => $sivuja, 'sivu' => $sivu, 'viestit' => $viestit));
//        $sivu = "keskustelualue.php";
//        require_once 'views/pohja.php';
//} else {
//    naytaNakyma('etusivu.php', array(
//        'virhe' => "Keskustelualuetta ei löytynyt!"
//    ));
//}