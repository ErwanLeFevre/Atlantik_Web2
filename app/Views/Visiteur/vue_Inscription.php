<h2><?= $TitreDeLaPage ?></h2>
<?php if ($TitreDeLaPage == 'Inscription incorrecte'): ?>
    <div class="alert alert-danger">
        <?= service('validation')->listErrors(); // affichage liste des erreurs, suite à erreur validation ?>
    </div>
<?php endif; ?>

<?= form_open('inscription') ?>
    <?= csrf_field(); ?>

    <label for="txtNom">Nom : </label>
    <input type="text" name="txtNom" value="<?= set_value('txtNom'); ?>" /><br/><br>

    <label for="txtPrenom">Prénom : </label>
    <input type="text" name="txtPrenom" value="<?= set_value('txtPrenom'); ?>" /><br/><br>

    <label for="txtAdresse">Adresse : </label>
    <input type="text" name="txtAdresse" value="<?= set_value('txtAdresse'); ?>" /><br/><br>

    <label for="txtCP">Code Postal : </label>
    <input type="text" name="txtCP" value="<?= set_value('txtCP'); ?>" /><br/><br>

    <label for="txtVille">Ville : </label>
    <input type="text" name="txtVille" value="<?= set_value('txtVille'); ?>" /><br/><br>

    <label for="txtTelFixe">Téléphone Fixe : </label>
    <input type="text" name="txtTelFixe" value="<?= set_value('txtTelFixe'); ?>" /><br/><br>

    <label for="txtTelMobile">Téléphone Mobile : </label>
    <input type="text" name="txtTelMobile" value="<?= set_value('txtTelMobile'); ?>" /><br/><br>

    <label for="txtMel">Email : </label>
    <input type="email" name="txtMel" value="<?= set_value('txtMel'); ?>" /><br/><br>

    <label for="txtMDP">Mot de Passe : </label>
    <input type="password" name="txtMDP" /><br/><br>

    <input type="submit" name="submit" value="Valider l'Inscription" />
<?= form_close(); ?>
