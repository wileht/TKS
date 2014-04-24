<?php 
require_once 'libs/models/ViestinLukeneet.php';
$lukeneet = ViestinLukeneet::kaikkiViestinLukeneet($_GET['viesti']);

require_once 'libs/funktiot.php'; 
naytaNakyma('viestinLukeneet.php', array('lukeneet' => $lukeneet));