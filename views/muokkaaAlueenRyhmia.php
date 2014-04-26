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
            <h1>Muokkaa keskustelualueen käyttöoikeuksia</h1>
            <br>
            <form class="form-horizontal" role="form" action="alueMuokkaus.php" method="POST">
                <h5>Keskustelualue: <?php echo $data->nimi; ?></h5>
                <br>
                <div class="form-group">
                    <label for="inputText2" class="col-sm-2 control-label">Käyttäjäryhmät</label>
                    <div class="col-sm-5">
                        <table class="table table-condensed">
                            <tbody>
                                <?php foreach ($data->ryhmat as $ryhma): ?>
                                    <tr>
                                        <td><label class="checkbox-inline">
                                                <input type="checkbox" name="checklist[]" value="<?php echo $ryhma->getId(); ?>"> <?php echo $ryhma->getNimi(); ?>
                                            </label></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <p>Huom: Käyttäjäryhmien valitseminen tarkoittaa, että VAIN valitut käyttäjäryhmät voivat lukea aluetta.
                        Mikäli haluat alueen olevan kaikille avoin, jätä kaikki valinnat tyhjiksi. Ylläpitäjät voivat lukea kaikkia alueita.</p>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Lisää</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>