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

function onkoYllapitaja () {
    if (!onkoKirjautunut()) {
        return false;
    }
    require_once "libs/models/Kayttaja.php";
    if (Ryhmankayttajat::onkoYllapitaja($_SESSION["kirjautunut"])) {
        return true;
    }
    return false;
}