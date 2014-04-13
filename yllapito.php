<?php

require_once "libs/funktiot.php";

//Vain ylläpitäjillä on oikeus tarkastella tätä sivua
if (onkoYllapitaja()) {
    $sivu = "yllapito.php";
    require_once 'views/pohja.php';
} else {
    $_SESSION['ilmoitus'] = "Sinulla ei ole oikeuksia tarkastella tätä sivua.";
    header('Location: etusivu.php');
}