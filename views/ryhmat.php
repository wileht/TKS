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
            <h1>Käyttäjäryhmät</h1>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th class="col-md-3">Toiminnot</th>
                        <th>Ryhmä</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</button> 
                            <a href="muokkaaRyhmaa.php" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Muokkaa</a></td>
                        <td>Kalat</td>
                    </tr>
                    <tr>
                        <td><button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</button> 
                            <a href="muokkaaRyhmaa.php" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Muokkaa</a></td>
                        <td>Hatut</td>
                    </tr>
                    <tr>
                        <td><button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</button> 
                            <a href="muokkaaRyhmaa.php" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Muokkaa</a></td>                                
                        <td>Koppelot</td>
                    </tr>
                </tbody>
            </table>
            <a href="uusiRyhma.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Lisää uusi ryhmä</a>
        </div>
    </div>
</div>