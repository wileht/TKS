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
            <h1>Ryhmän jäsenet</h1>
            <form class="form-horizontal" role="form" action="poistaRyhmasta.php?ryhmaId=<?php echo $_GET['ryhmaId']; ?>" method="POST">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Käyttäjä</th>
                            <th>Viestejä</th>
                            <th>Viimeisin viesti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->kayttajat as $kayttaja): ?>
                            <tr>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox" name="checklist[]" value="<?php echo $kayttaja->getId(); ?>"> <?php echo $kayttaja->getNimi(); ?>
                                    </label></td>
                                <td><?php echo $kayttaja->montakoViestia(); ?></td>
                                <td><?php echo $kayttaja->viimeisinViesti(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista ryhmästä</button>
            </form>
        </div>
    </div>
</div>