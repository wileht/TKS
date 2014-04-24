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
            <h1>Lisää uusi käyttäjäryhmä</h1>
            <br>
            <form class="form-horizontal" role="form" action="ryhmaLisays.php" method="POST">
                <div class="form-group">
                    <label for="inputText1" class="col-sm-1 control-label">Nimi</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputText1" placeholder="Nimi" name="nimi"
                               value="<?php echo $data->nimi; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-default">Lisää</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>