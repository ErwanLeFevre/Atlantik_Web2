
<h2>Historique des Réservations</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>n° de réservation</th>
            <th>Date réservation</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date départ</th>
            <th>Total</th>
            <th>Payé</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($historiqueReservations as $reservation): ?>
            <tr>
                <td><?= $reservation->noreservation ?></td>
                <td><?= date('d/m/Y', strtotime($reservation->datereservation)) ?></td>
                <td><?= $reservation->portdepart ?></td>
                <td><?= $reservation->portarrivee ?></td>
                <td><?= date('d/m/Y', strtotime($reservation->datedepart)) ?></td>
                <td><?= number_format($reservation->montanttotal, 2) ?> €</td>
                <td><?= $reservation->paye ? 'Oui' : 'Non' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    


