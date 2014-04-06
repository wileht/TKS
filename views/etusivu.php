<!DOCTYPE HTML>
<div class="container">
    <h1>Etusivu</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Alue</th>
                <th>Viestejä(?)</th>
                <th>Viimeisin viesti(?)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alueet as $alue): ?>
                <tr>
                    <td><a href="keskustelualue.php?id=<?php echo $alue->getId() ?>"><?php echo $alue->getNimi() ?></a></td>
                    <td>1</td>
                    <td>pvm</td>
                    <td><button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-envelope"></span> Lukemattomia viestejä</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>