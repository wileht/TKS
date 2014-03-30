<?php
require_once "libs/funktiot.php";
if (!onkoKirjautunut() && $sivu != "kirjautuminen.php") {
    header('Location: kirjautuminen.php');
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Keskustelufoorumi</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="js/jquery-2.1.0.js" />
        <script type="text/javascript" src="js/jquery-2.1.0.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <link href="js/jquery-2.1.0.js" rel="stylesheet">
    </head>
    <body>
        <ul class="nav nav-tabs">
            <li><a href="etusivu.php">Etusivu</a></li>
            <li><a href="haku.php">Haku</a></li>
            <li><a href="yllapito.php">Ylläpito</a></li>
            <li><a href="uloskirjaus.php">Kirjaudu ulos</a></li>
        </ul>
        <div class="content">
            <?php if (!empty($data->virhe)): ?>
                <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
            <?php endif; ?>
            <?php require 'views/' . $sivu; ?>
        </div>
    </body>
</html>