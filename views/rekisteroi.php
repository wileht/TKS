<!DOCTYPE HTML>
<div class="container">
    <h1>Rekisteröidy</h1>
    <br>
    <form class="form-horizontal" role="form" action="rekisterointi.php" method="POST">
        <div class="form-group">
            <label for="inputText1" class="col-sm-2 control-label">Käyttäjätunnus</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputText1" name="username" placeholder="Käyttäjätunnus"
                       value="<?php echo $data->kayttaja; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword1" class="col-sm-2 control-label">Salasana</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword1" placeholder="Salasana"
                       name="password" value="<?php echo $data->salasana; ?>" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Luo käyttäjätunnus</button>
            </div>
        </div>
    </form>
</div>