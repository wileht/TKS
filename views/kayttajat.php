<!DOCTYPE HTML>
<div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h1></h1>
                    <div class="panel panel-default">
                        <ul class="nav">
                            <li><a href="alueet.php">Keskustelualueet</a></li>
                            <li class="active"><a href="kayttajat.php">Käyttäjät</a></li>
                            <li><a href="ryhmat.php">Käyttäjäryhmät</a></li>
                        </ul>
                    </div>
                </div>
                <div class="container col-md-7">
                    <h1>Käyttäjät</h1>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Käyttäjä</th>
                                <th>Viestejä(?)</th>
                                <th>Viimeisin viesti(?)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox"> Tapsa
                                    </label></td>
                                <td>13</td>
                                <td>27.2.1014 22:34 </td>
                            </tr>
                            <tr>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox"> Teppo
                                    </label></td>
                                <td>1</td>
                                <td>17.3.2014 05:34</td>
                            </tr>
                            <tr>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox"> Tipi
                                    </label></td>
                                <td>2</td>
                                <td>19.3.2014 18:21</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-plus"></span> Lisää käyttäjäryhmään <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Kalat</a></li>
                            <li><a href="#">Hatut</a></li>
                            <li><a href="#">Koppelot</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista valitut käyttäjät</button>
                </div>
            </div>
        </div>