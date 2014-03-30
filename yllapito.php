<?php
require_once "libs/funktiot.php";
require_once "libs/models/Ryhmankayttajat.php";

if (Ryhmankayttajat::onkoYllapitaja()) {
    $sivu = "yllapito.php";
    require_once 'views/pohja.php';

//    $sivu = "etusivu.php";
//    require_once 'views/pohja.php';
} else {
    naytaNakyma('etusivu.php', array(
        'virhe' => "Sinulla ei ole oikeuksia tarkastella tätä sivua.",
    ));
}