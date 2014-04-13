<!DOCTYPE HTML>
<div class="container">
            <h1>Haku</h1>
            <br>
            <form class="form-horizontal" role="form" action="haku.php" method="POST">
                <div class="form-group">
                    <label for="inputText1" class="col-sm-1 control-label">Hakusanat</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputText1" placeholder="Hakusanat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputText2" class="col-sm-1 control-label">Kirjoittaja</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputText2" placeholder="Kirjoittaja">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDate1" class="col-sm-1 control-label">Julkaistu</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="inputDate1" placeholder="Ennen (PP.KK.VVVV)">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="inputDate2" placeholder="Jälkeen (PP.KK.VVVV)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Hae</button>
                    </div>
                </div>
            </form>
        </div>