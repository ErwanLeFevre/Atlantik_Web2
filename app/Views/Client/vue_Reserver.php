<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Compagnie Atlantik</h2>
        <h3>Liaison <?= $traversee->portdepart ?> - <?= $traversee->portarrivee ?></h3>
        <p>Traversée n°<?= $traversee->notraversee ?> le <?= date('d/m/Y', strtotime($traversee->dateheuredepart)) ?> à <?= date('H:i', strtotime($traversee->dateheuredepart)) ?></p>
        
        <h4>Saisir les informations relatives à la réservation</h4>
        <p>Nom : <?= $client->nom ?></p>
        <p>Adresse : <?= $client->adresse ?></p>
        <p>Cp : <?= $client->cp ?> Ville : <?= $client->ville ?></p>
        
        <form action="<?= site_url('confirmerreservation') ?>" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tarif en €</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarifsLiaisons as $tarif): ?>
                        <tr>
                            <td><?= $tarif->type ?> - <?= $tarif->tarif ?></td>
                            <td>
                                <input type="number" name="quantite[<?= $tarif->type ?>]" value="0" min="0">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
    </div>
</body>
</html>
