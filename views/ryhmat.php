<!DOCTYPE HTML>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h1></h1>
            <div class="panel panel-default">
                <ul class="nav">
                    <li><a href="alueet.php">Keskustelualueet</a></li>
                    <li><a href="kayttajat.php">Käyttäjät</a></li>
                    <li class="active"><a href="ryhmat.php">Käyttäjäryhmät</a></li>
                </ul>
            </div>
        </div>
        <div class="container col-md-7">
            <h1>Käyttäjäryhmät</h1>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th class="col-md-4">Toiminnot</th>
                        <th>Ryhmä</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->ryhmat as $ryhma): ?>
                        <tr>
                            <td><a href="poistaRyhma.php?ryhmaId=<?php echo $ryhma->getId(); ?>" role="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</a> 
                                <a href="muokkaaRyhmaa.php?ryhmaId=<?php echo $ryhma->getId(); ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Poista jäseniä</a></td>
                            <td><?php echo $ryhma->getNimi(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="uusiRyhma.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Lisää uusi ryhmä</a>
        </div>
    </div>
</div>