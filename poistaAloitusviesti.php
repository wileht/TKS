<?php
require_once 'libs/models/Aloitusviesti.php';
Aloitusviesti::poistaAloitusviesti($_GET['viesti']);

session_start();
$_SESSION['ilmoitus'] = "Viesti poistettu.";
header('Location: keskustelualue.php?id=' . $_GET['id']);