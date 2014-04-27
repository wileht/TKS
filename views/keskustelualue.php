<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="etusivu.php"> Etusivu</a>
    > <?php echo $data->alueNimi; ?>
    <h1><?php echo $data->alueNimi; ?></h1>
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Otsikko</th>
                <th>Aloittaja</th>
                <th>Vastauksia</th>
                <th>Viimeisin viesti</th>
            </tr>
        </thead>
        <tbody>
            <?php $alueId = $_GET['id']; ?>
            <?php foreach ($data->viestit as $viesti): ?>
                <tr>
                    <td><?php if (!onkoKirjautunutLukenut($viesti->getId())): ?><a href="viesti.php?id=<?php echo $alueId; ?>&viesti=<?php echo $viesti->getId() ?>" role="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-envelope"></span> Lukematta</a><?php endif; ?>
                        <a href="viesti.php?id=<?php echo $alueId; ?>&viesti=<?php echo $viesti->getId() ?>"><?php echo htmlspecialchars($viesti->getOtsikko()) ?></td>
                    <td><?php echo $viesti->getKirjoittajaNimi(); ?></td>
                    <td><?php echo $viesti->getVastineita(); ?></td>
                    <td><?php echo date("d.m.Y H:i", strtotime($viesti->etsiUusimmanVastineenPvm())); ?></td>                        
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
    Sivuja: <?php echo $data->sivuja; ?>, Nykyinen sivu: <?php echo $data->sivu; ?>
    <br>
    <br>
    <a href="uusiAloitusviesti.php?id=<?php echo $alueId; ?>" role="button" class="btn btn-success">
        <span class="glyphicon glyphicon-pencil"></span> Uusi viesti</a>
</div>
