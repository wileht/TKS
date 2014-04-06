<?php 
$sivu = "etusivu.php";
require_once 'libs/models/Keskustelualue.php';
$alueet = Keskustelualue::kaikkiAlueet();
require_once 'views/pohja.php'; 