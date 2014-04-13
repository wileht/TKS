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
            <?php $alueId = $_GET['id']; ?>
            <?php foreach ($data->viestit as $viesti): ?>
                <tr>
                    <td><a href="viesti.php?id=<?php echo $alueId; ?>&viesti=<?php echo $viesti->getId() ?>"><?php echo htmlspecialchars($viesti->getOtsikko()) ?></td>
                    <td></td>
                    <td></td>                        
                </tr>
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
    <a href="uusiAloitusviesti.php?id=<?php echo $alueId; ?>" role="button" class="btn btn-success">
        <span class="glyphicon glyphicon-pencil"></span> Uusi viesti</a>
</div>