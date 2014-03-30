<?php

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function onkoKirjautunut() {
    //session_start();
    if (isset($_SESSION['kirjautunut'])) {
        return true;
    }
    return false;
}