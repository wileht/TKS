<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="etusivu.php"> Etusivu</a>
    > <a href="keskustelualue.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>">Keskustelualue</a>
    > Viesti
    <h1>Viesti</h1>
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
                <td><?php echo htmlspecialchars($data->aloitusviesti->getSisalto()); ?></td>
                <td><a href="muokkaaAloitusviestia.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>&viesti=<?php echo $data->aloitusviesti->getId(); ?>" 
                       role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-cog"></span> Muokkaa</a>
                    <br><br><a href="poistaAloitusviesti.php?id=<?php echo $data->aloitusviesti->getKeskustelualue(); ?>&viesti=<?php echo $data->aloitusviesti->getId(); ?>" 
                       role="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Poista</a></td>
                </tr>
            <?php foreach ($data->vastineet as $vastine): ?>
<!--            <tr>
                <td>Tipi</td>
                <td><a href="http://fi.wikipedia.org/wiki/Kettu">Wikipedia</a>: Punakettu on kettujen suvun (Vulpes) kookkain laji, tosin kettujen koon alueellinen 
                    vaihtelu on todella suurta. Täysikasvuisen ketun pituus ilman häntää vaihtelee välillä 45–90 cm; 
                    tuuhea häntä on 30–55 cm pitkä.[2] Ketun paino vaihtelee muutamasta kilosta jopa yli kymmeneen kiloon. 
                    Suomessa ketun keskipaino on hieman yli viisi kiloa.[3]
                    <br>
                    Väriltään kettu on tavallisesti punaruskea punakettu; sävy voi vaihdella vaalean kellanruskeasta hyvinkin syvänpunaiseen. 
                    Sillä on valkoinen tai harmaa vatsanalus sekä tavallisesti mustat korvankärjet ja raajat. Myös hännänpää on tavallisesti valkoinen, 
                    ja eläimen kurkussa ja rinnassa voi olla valkeita merkkejä. Luonnossa tavataan muitakin värimuotoja, kuten hopeakettuja (noin 10 % ketuista,
                    varsinkin Pohjois-Amerikassa ja Siperiassa), joiden sävy vaihtelee hopeanvärisestä lähes mustaan. 
                    Ristikettu on punaisen ja mustan ketun risteymä, jonka selässä on tavallisesti musta ristikuvio.[4]
                </td>
            </tr>-->
            <tr>
                    <td><?php echo htmlspecialchars($vastine->getKirjoittajaNimi()); ?></td>
                    <td><?php echo htmlspecialchars($vastine->getSisalto()); ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="uusiViesti.php" role="button" class="btn btn-success">
        <span class="glyphicon glyphicon-pencil"></span> Vastaa viestiin</a>
</div>