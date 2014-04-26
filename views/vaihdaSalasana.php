<!DOCTYPE HTML>
<div class="container">
    <h1>Vaihda salasana</h1>
    <br>
    <form class="form-horizontal" role="form" action="salasanavaihto.php" method="POST">
        <div class="form-group">
            <label for="inputPassword1" class="col-sm-2 control-label">Uusi salasana</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword1" name="password1" placeholder="Uusi salasana"
                       value="<?php echo $data->salasana1; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword2" class="col-sm-2 control-label">Vahvista uusi salasana</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword2" placeholder="Vahvista uusi salasana"
                       name="password2" value="<?php echo $data->salasana2; ?>" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Vaihda salasana</button>
            </div>
        </div>
    </form>
</div>