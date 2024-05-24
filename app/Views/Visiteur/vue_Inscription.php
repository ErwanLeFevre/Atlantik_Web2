<h2><?= $TitreDeLaPage ?></h2>

<?php if ($TitreDeLaPage == 'Inscription incorrecte'): ?>
    <?= service('validation')->listErrors(); ?>
<?php endif; ?>

<?= form_open('inscription') ?>

<?= csrf_field() ?>

<label for="txtNom">Nom : </label>
<input type="input" name="txtNom" value="<?= set_value('txtNom'); ?>" /><br/><br>

<label for="txtPrenom">Prénom : </label>
<input type="input" name="txtPrenom" value="<?= set_value('txtPrenom'); ?>" /><br/><br>

<label for="txtAdresse">Adresse : </label>
<input type="input" name="txtAdresse" value="<?= set_value('txtAdresse'); ?>" /><br/><br>

<label for="txtCP">Code Postal : </label>
<input type="input" name="txtCP" value="<?= set_value('txtCP'); ?>" /><br/><br>

<label for="txtVille">Ville : </label>
<input type="input" name="txtVille" value="<?= set_value('txtVille'); ?>" /><br/><br>

<label for="txtTelFixe">Téléphone Fixe : </label>
<input type="input" name="txtTelFixe" value="<?= set_value('txtTelFixe'); ?>" /><br/><br>

<label for="txtTelMobile">Téléphone Mobile : </label>
<input type="input" name="txtTelMobile" value="<?= set_value('txtTelMobile'); ?>" /><br/><br>

<label for="txtMel">Mel : </label>
<input type="input" name="txtMel" value="<?= set_value('txtMel'); ?>" /><br/><br>

<label for="txtMDP">Mot de Passe : </label>
<input type="password" name="txtMDP" value="<?= set_value('txtMDP'); ?>" /><br/><br>

<input type="submit" name="submit" value="Valider l'Inscription" />
<?= form_close(); ?>
