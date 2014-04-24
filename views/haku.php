<!DOCTYPE HTML>
<div class="container">
    <h1>Haku</h1>
    <br>
    <form class="form-horizontal" role="form" action="hakeminen.php" method="POST">
        <div class="form-group">
            <label for="hakusanat" class="col-sm-1 control-label">Hakusanat</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="hakusanat" name="hakusanat" placeholder="Hakusanat"
                       value="<?php echo $data->hakusanat; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="kirjoittaja" class="col-sm-1 control-label">Kirjoittaja</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="kirjoittaja" name="kirjoittaja" placeholder="Kirjoittaja"
                       value="<?php echo $data->kirjoittaja; ?>">
            </div>
        </div> 
        <div class="form-group">
            <label for="ennen" class="col-sm-1 control-label">Julkaistu</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="ennen" name="ennen" placeholder="Ennen (VVVV-KK-PP)"
                       value="<?php echo $data->ennen; ?>">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="jalkeen" name="jalkeen" placeholder="Jälkeen (VVVV-KK-PP)"
                       value="<?php echo $data->jalkeen; ?>">
            </div>
</div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Hae</button>
            </div>
        </div>
    </form>
    <p>Huom: Haku palauttaa vain tulokset, joissa on KAIKKI annetut hakusanat.</p>
</div>