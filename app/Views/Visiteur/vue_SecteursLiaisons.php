<h2><?= $TitreDeLaPage ?></h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan=2>Secteur</th>
            <th colspan=4>Liaison
            <tr>
                <th>Code Liaison</th>
                <th>Distance en milles marin</th>
                <th>Port de départ</th>
                <th>Port d'arrivée</th>
            </tr>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($secteursLiaisons as $sl): ?>
            <tr>
                <td><?= $sl->nomsecteur ?></td>
                <td><?= anchor('voirsecteursliaisons/'.$sl->liaison, $sl->liaison) ?></td>
                <td><?= $sl->distance ?></td>
                <td><?= $sl->portdepart ?></td>
                <td><?= $sl->portarrivee ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>