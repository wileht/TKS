<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="etusivu.php"> Etusivu</a>
    > <a href="keskustelualue.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>">Keskustelualue</a>
    > Viesti
    <h1><?php echo htmlspecialchars($data->aloitusviesti->getOtsikko()); ?></h1>
    <a href="uusiViesti.php" role="button" class="btn btn-success">
        <span class="glyphicon glyphicon-pencil"></span> Vastaa viestiin</a>
    <br>
    <br>
    <table class="table table-bordered">
        <colgroup>
            <col class="col-xs-1">
            <col class="col-xs-10">
            <col class="col-xs-1">
        </colgroup>
        <thead>
            <tr>
                <th>Kirjoittaja</th>
                <th>Viesti</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($data->aloitusviesti->getKirjoittajaNimi()); ?></td>
                <td><?php echo nl2br(htmlspecialchars($data->aloitusviesti->getSisalto())); ?></td>
                <td><?php if (onkoKirjoittaja($data->aloitusviesti) || onkoYllapitaja()): ?><a href="muokkaaAloitusviestia.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>&viesti=<?php echo $data->aloitusviesti->getId(); ?>" 
                                                                                               role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Muokkaa</a><?php endif; ?>
                     <?php if (onkoYllapitaja()): ?><br><br><a href="poistaAloitusviesti.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>&viesti=<?php echo $data->aloitusviesti->getId(); ?>" 
                                       role="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</a></td><?php endif; ?>
            </tr>
            <?php foreach ($data->vastineet as $vastine): ?>
                <tr>
                    <td><?php echo htmlspecialchars($vastine->getKirjoittajaNimi()); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($vastine->getSisalto())); ?></td>
                    <td><?php if (onkoKirjoittaja($vastine) || onkoYllapitaja()): ?><a href="muokkaaVastinetta.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>&viesti=<?php echo $data->aloitusviesti->getId(); ?>&vastine=<?php echo $vastine->getId(); ?>" 
                                                                                                       role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Muokkaa</a>
                            <br><br><a href="poistaVastine.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>&viesti=<?php echo $data->aloitusviesti->getId(); ?>&vastine=<?php echo $vastine->getId(); ?>" 
                                       role="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</a></td><?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($data->sivu > 1): ?>
        <p><a href="viesti.php?id=<?php echo $alueId; ?>&viesti=<?php echo $_GET['viesti']; ?>&sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
        <?php endif; ?>
        <?php if ($data->sivu < $data->sivuja): ?>
            <a href="viesti.php?id=<?php echo $alueId; ?>&viesti=<?php echo $_GET['viesti']; ?>&sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
        <?php endif; ?>
        <br>
        <a href="uusiViesti.php?id=<?php echo $_GET['id']; ?>&viesti=<?php echo $_GET['viesti']; ?>" role="button" class="btn btn-success">
            <span class="glyphicon glyphicon-pencil"></span> Vastaa viestiin</a>
</div>