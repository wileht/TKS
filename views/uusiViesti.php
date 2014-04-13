<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="etusivu.php"> Etusivu</a>
    > <a href="keskustelualue.php">Keskustelualue</a>
    > <a href="viesti.php">Viesti</a>
    > Uusi viesti
    <h1>Uusi viesti</h1>
    <form class="form-horizontal" role="form" action="vastineLahetys.php?viesti=<?php echo $_GET['viesti'] ?>" method="POST">
            <div class="form-group">
                <label for="sisalto" class="col-sm-1 control-label">Viesti</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="15" id="sisalto" name="sisalto"></textarea>
                </div>
            </div>
        <br>
        <p class="text-center"><button type="submit" class="btn btn-default">Lähetä</button></p>
    </form>
</div>