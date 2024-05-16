<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Inscription incorrecte')
  echo service('validation')->listErrors(); // affichage liste des erreurs, suite à erreur validation

echo form_open('ajouterclient')
?>

<?php echo csrf_field(); ?>

<label for="txtNom">Nom : </label>
<input type="input" name="txtNom" value="<?php echo set_value('txtNom'); ?>" /><br/><br>

<label for="txtPrenom">Prénom : </label>
<input type="input" name="txtPrenom" value="<?php echo set_value('txtPrenom'); ?>" /><br/><br>

<label for="txtAdresse">Adresse : </label>
<input type="input" name="txtPrixHT" value="<?php echo set_value('txtPrixHT'); ?>" /><br/><br>

<label for="txtCP">Code Postal : </label>
<input type="input" name="txtCP" value="<?php echo set_value('txtCP'); ?>" /><br/><br>

<label for="txtVille">Ville : </label>
<input type="input" name="txtVille" value="<?php echo set_value('txtVille'); ?>" /><br/><br>

<label for="txtTelFixe">Téléphone Fixe : </label>
<input type="input" name="txtTelFixe" value="<?php echo set_value('txtTelFixe'); ?>" /><br/><br>

<label for="txtTelMobile">Téléphone Mobile : </label>
<input type="input" name="txtTelMobile" value="<?php echo set_value('txtTelMobile'); ?>" /><br/><br>

<label for="txtMel">Mel : </label>
<input type="input" name="txtMel" value="<?php echo set_value('txtMel'); ?>" /><br/><br>

<label for="txtMDP">Mot de Passe : </label>
<input type="input" name="txtMDP" value="<?php echo set_value('txtMDP'); ?>" /><br/><br>

<input type="submit" name="submit" value="Valider l'Inscription" />
<?php echo form_close(); ?>

