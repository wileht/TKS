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
            <h1>Lisää uusi alue</h1>
            <br>
            <form class="form-horizontal" role="form" action="alueet.php" method="POST">
                <div class="form-group">
                    <label for="inputText1" class="col-sm-2 control-label">Nimi</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputText1" placeholder="Nimi">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputText2" class="col-sm-2 control-label">Käyttäjäryhmät</label>
                    <div class="col-sm-5">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <td><label class="checkbox-inline">
                                            <input type="checkbox"> Kalat
                                        </label></td>
                                </tr>
                                <tr>
                                    <td><label class="checkbox-inline">
                                            <input type="checkbox"> Hatut
                                        </label></td>
                                </tr>
                                <tr>
                                    <td><label class="checkbox-inline">
                                            <input type="checkbox"> Koppelot
                                        </label></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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