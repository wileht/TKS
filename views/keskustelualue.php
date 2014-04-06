<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="etusivu.php"> Etusivu</a>
    > Keskustelualue
    <h1>Keskustelualue</h1>
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Otsikko</th>
                <th>Vastauksia</th>
                <th>Viimeisin viesti(?)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->viestit as $viesti): ?>
            <?php $alueId = $viesti->getKeskustelualue(); ?>
                <tr>
                    <td><a href="viesti.php?viesti=<?php echo $viesti->getId() ?>"><?php echo htmlspecialchars($viesti->getOtsikko()) ?></td>
                    <td></td>
                    <td></td>                        
                </tr>
    <!--                    <tr>
                    <td><a href="viesti.php">Viesti</a></td>
                    <td>13</td>
                    <td>27.2.1014 22:34 </td>
                </tr>
                <tr>
                    <td>Mörköhavainto 12.3.2014 klo 01:23, Kerava</td>
                    <td>1</td>
                    <td>17.3.2014 05:34</td>
                </tr>
                <tr>
                    <td>Lisää keskustelua</td>
                    <td>2</td>
                    <td>19.3.2014 18:21</td>
                </tr>-->
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($data->sivu > 1): ?>
        <a href="keskustelualue.php?id=<?php echo $alueId; ?>&sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
        <a href="keskustelualue.php?id=<?php echo $alueId; ?>&sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>
    <br>
    <a href="uusiAloitusviesti.php?id=<?php echo $_GET['id']; ?>" role="button" class="btn btn-success">
        <span class="glyphicon glyphicon-pencil"></span> Uusi viesti</a>
</div>