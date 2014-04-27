<!DOCTYPE HTML>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h1></h1>
            <div class="panel panel-default">
                <ul class="nav">
                    <li><a href="alueet.php">Keskustelualueet</a></li>
                    <li class="active"><a href="kayttajat.php">Käyttäjät</a></li>
                    <li><a href="ryhmat.php">Käyttäjäryhmät</a></li>
                </ul>
            </div>
        </div>
        <div class="container col-md-7">
            <h1>Käyttäjät</h1>
            <form class="form-horizontal" role="form" action="lisaaKayttajaryhmaan.php" method="POST">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Käyttäjä</th>
                            <th>Viestejä</th>
                            <th>Viimeisin viesti</th>
                            <th>Poista</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->kayttajat as $kayttaja): ?>
                            <tr>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox" name="checklist[]" value="<?php echo $kayttaja->getId(); ?>"> <?php echo $kayttaja->getNimi(); ?>
                                    </label></td>
                                <td><?php echo $kayttaja->montakoViestia(); ?></td>
                                <td><?php echo date("d.m.Y H:i", strtotime($kayttaja->viimeisinViesti())); ?></td>
                                <td><a href="poistaKayttaja.php?kayttajaId=<?php echo $kayttaja->getId(); ?>" role="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="btn-group">
                    <label>Lisää käyttäjäryhmään</label>
                    <select name="tahanRyhmaan">
                        <?php foreach ($data->ryhmat as $ryhmä): ?>
                            <option value="<?php echo $ryhmä->getId(); ?>" name="tahanRyhmaan"><?php echo $ryhmä->getNimi(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span> Lisää käyttäjäryhmään</button>
            </form>
        </div>
    </div>
</div>
