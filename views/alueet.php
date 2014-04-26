<!DOCTYPE HTML>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h1></h1>
            <div class="panel panel-default">
                <ul class="nav">
                    <li class="active"><a href="alueet.php">Keskustelualueet</a></li>
                    <li><a href="kayttajat.php">Käyttäjät</a></li>
                    <li><a href="ryhmat.php">Käyttäjäryhmät</a></li>
                </ul>
            </div>
        </div>
        <div class="container col-md-7">
            <h1>Keskustelualueet</h1>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Alueet</th>
                        <th>Toiminnot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alueet as $alue): ?>
                        <tr>
                            <td><a href="keskustelualue.php?id=<?php echo $alue->getId() ?>"> <?php echo $alue->getNimi() ?></a></td>
                            <td><a href="poistaAlue.php?id=<?php echo $alue->getId(); ?>" role="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</a>
                                <a href="muokkaaAlueenRyhmia.php?id=<?php echo $alue->getId(); ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Muokkaa käyttöoikeuksia</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="uusiAlue.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Lisää uusi alue</a>
        </div>
    </div>
</div>