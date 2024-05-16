<br><br><br>
<?php
if ($clientAjoute) { // true (1) si ajout, false (0) sinon
    echo 'Inscription effectué.';
} else {
    echo 'Echec de l inscription.';
}
?>
<br><br><br>
<p><a href="<?php echo site_url('accueil') ?>">Retour à l'accueil'</a></p>