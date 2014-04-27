<?php

$sivu = "etusivu.php";
require_once 'libs/models/Keskustelualue.php';

//Etusivu on lähinnä keskustelualuelista, haetaan tätä varten keskustelualueet tietokannasta
$alueet = Keskustelualue::kaikkiAlueet();
require_once 'views/pohja.php';
