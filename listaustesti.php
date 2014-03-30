<?php
//require_once sisällyttää annetun tiedoston vain kerran
require_once "libs/models/tietokantayhteys.php";
require_once "libs/models/ListaustestiKayttaja.php";

//Lista asioista array-tietotyyppiin laitettuna:
$lista = ListaustestiKayttaja::etsiKaikkiKayttajat();
?><!DOCTYPE HTML>
<html>
    <head><title>Otsikko</title></head>
    <body>
        <h1>Listaelementtitesti</h1>
        <ul>
            <?php foreach ($lista as $asia) { ?>
                <li><?php echo $asia->getUsername(); ?></li>
            <?php } ?>
        </ul>
    </body>
</html>