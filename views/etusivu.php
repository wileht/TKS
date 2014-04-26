<!DOCTYPE HTML>
<div class="container">
    <h1>Etusivu</h1>
    <?php if (empty($alueet)): ?>
        <p>Lisää keskustelualueita Ylläpito-välilehdestä.</p>
    <?php endif; ?>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Alue</th>
                <th>Aiheita</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alueet as $alue): ?>
                <tr>
                    <td><?php if (!onkoKayttajallaOikeuttaAlueeseen($alue->getId())): ?><span class="glyphicon glyphicon-ban-circle" title="Sinulla ei ole oikeuksia tarkastella tätä keskustelualuetta."></span><?php endif; ?>
                        <a href="keskustelualue.php?id=<?php echo $alue->getId() ?>"><?php echo $alue->getNimi() ?></a></td>
                    <td><?php echo $alue->getViesteja(); ?></td>
                    <td><?php if (!onkoKirjautunutLukenutAlueen($alue->getId()) && onkoKayttajallaOikeuttaAlueeseen($alue->getId())): ?><a href="keskustelualue.php?id=<?php echo $alue->getId() ?>" role="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-envelope"></span> Lukemattomia viestejä</a><?php endif; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>