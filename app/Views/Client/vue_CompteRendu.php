

        <h2>Compagnie Atlantik</h2>
        <h3>Liaison <?= $reservation['traversee']->portdepart ?> - <?= $reservation['traversee']->portarrivee ?></h3>
        <p>Traversée n°<?= $reservation['traversee']->notraversee ?> le <?= date('d/m/Y', strtotime($reservation['traversee']->dateheuredepart)) ?> à <?= date('H:i', strtotime($reservation['traversee']->dateheuredepart)) ?></p>
        
        <p>Réservation enregistrée sous le n° <?= $reservation['noReservation'] ?></p>
        <p><?= $reservation['client']->nom ?> <?= $reservation['client']->adresse ?> <?= $reservation['client']->cp ?> <?= $reservation['client']->ville ?></p>
        
        <ul>
            <?php foreach ($reservation['quantites'] as $type => $quantite): ?>
                <?php if ($quantite > 0): ?>
                    <li><?= $type ?> : <?= $quantite ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        
        <p>Montant total à régler : <?= number_format($reservation['montantTotal'], 2) ?> euros</p>
        <p>Modalités de règlement : Carte Bancaire</p>


