<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="etusivu.php"> Etusivu</a>
    > <a href="keskustelualue.php?id=<?php echo $_GET['id']; ?>">Keskustelualue</a>
    > <a href="keskustelualue.php?id=<?php echo $_GET['viesti']; ?>">Viesti</a>
    > Muokkaa viestiä
    <h1>Muokkaa viestiä</h1>
    <br>
    <form class="form-horizontal" role="form" action="vastineMuokkaus.php?id=<?php echo $_GET['id']; ?>&viesti=<?php echo $_GET['viesti']; ?>&vastine=<?php echo $_GET['vastine']; ?>" method="POST">
            <div class="form-group">
                <label for="sisalto" class="col-sm-1 control-label">Viesti</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="15" id="sisalto" name="sisalto"><?php echo htmlspecialchars($data->sisalto); ?></textarea>
                </div>
            </div>
        <br>
        <p class="text-center"><button type="submit" class="btn btn-default">Lähetä</button></p>
    </form>
</div>