<?php 
session_start();
unset($_SESSION["kirjautunut"]);
$sivu = "kirjautuminen.php";
require_once 'views/pohja.php'; 