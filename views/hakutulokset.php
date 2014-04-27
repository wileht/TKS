<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="etusivu.php"> Etusivu</a>
    > Hakutulokset
    <h1>Hakutulokset</h1>
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Otsikko</th>
                <th>Kirjoittaja</th>
                <th>Keskustelualue</th>
                <th>Päivämäärä</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->tulokset as $viesti): ?>
                <tr>
                    <td><a href="viesti.php?id=<?php echo $viesti->getKeskustelualue(); ?>&viesti=<?php echo $viesti->getAloitusviesti() ?>"><?php echo htmlspecialchars($viesti->getOtsikko()) ?></td>
                    <td><?php echo $viesti->getKirjoittajaNimi(); ?></td>
                    <td><?php echo $viesti->getKeskustelualueNimi(); ?></td>
                    <td><?php echo date("d.m.Y H:m", strtotime($viesti->getPaivamaara())); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($data->sivu > 1): ?>
        <a href="hakutulokset.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
        <a href="hakutulokset.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>
</div>