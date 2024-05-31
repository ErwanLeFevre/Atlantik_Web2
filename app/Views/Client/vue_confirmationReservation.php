
    <h2>Compagnie Atlantik</h2>
    <h3>Liaison <?= $traversee->portdepart ?> - <?= $traversee->portarrivee ?></h3>
    <p>Traversée n°<?= $traversee->notraversee ?> le <?= date('d/m/Y', strtotime($traversee->dateheuredepart)) ?> à <?= date('H:i', strtotime($traversee->dateheuredepart)) ?></p>
    
    <p>Réservation enregistrée sous le n° <?= $noReservation ?></p>
    <p><?= $client->nom ?> <?= $client->adresse ?> <?= $client->cp ?> <?= $client->ville ?></p>
    
    <ul>
        <?php foreach ($quantites as $type => $quantite): ?>
            <?php if ($quantite > 0): ?>
                <li><?= $type ?> : <?= $quantite ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    
    <p>Montant total à régler : <?= number_format($montantTotal, 2) ?> euros</p>
    <p>Modalités de règlement : Carte Bancaire</p>

