<!DOCTYPE HTML>
<div class="container">
    <br>
    <a href="viesti.php?id=<?php echo $_GET['id']; ?>&viesti=<?php echo $_GET['viesti']; ?>">Takaisin viestiin</a>
    <h1>Viestin lukeneet</h1>
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Käyttäjä</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->lukeneet as $kayttaja): ?>
                <tr>
                    <td><?php echo htmlspecialchars($kayttaja->getNimi()) ?></td>                       
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>