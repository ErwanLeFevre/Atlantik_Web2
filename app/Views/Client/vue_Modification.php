<h2><?= esc($TitreDeLaPage) ?></h2>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>

<?= form_open('modification') ?>
    <?= csrf_field(); ?>

    <div class="form-group">
        <label for="txtNom">Nom :</label>
        <input type="text" name="txtNom" class="form-control" value="<?= esc($client->NOM); ?>" />
    </div>

    <div class="form-group">
        <label for="txtPrenom">Prénom :</label>
        <input type="text" name="txtPrenom" class="form-control" value="<?= esc($client->PRENOM); ?>" />
    </div>

    <div class="form-group">
        <label for="txtAdresse">Adresse :</label>
        <input type="text" name="txtAdresse" class="form-control" value="<?= esc($client->ADRESSE); ?>" />
    </div>

    <div class="form-group">
        <label for="txtCP">Code Postal :</label>
        <input type="text" name="txtCP" class="form-control" value="<?= esc($client->CODEPOSTAL); ?>" />
    </div>

    <div class="form-group">
        <label for="txtVille">Ville :</label>
        <input type="text" name="txtVille" class="form-control" value="<?= esc($client->VILLE); ?>" />
    </div>

    <div class="form-group">
        <label for="txtTelFixe">Téléphone Fixe :</label>
        <input type="text" name="txtTelFixe" class="form-control" value="<?= esc($client->TELEPHONEFIXE); ?>" />
    </div>

    <div class="form-group">
        <label for="txtTelMobile">Téléphone Mobile :</label>
        <input type="text" name="txtTelMobile" class="form-control" value="<?= esc($client->TELEPHONEMOBILE); ?>" />
    </div>

    <div class="form-group">
        <label for="txtMel">Email :</label>
        <input type="email" name="txtMel" class="form-control" value="<?= esc($client->MEL); ?>" />
    </div>

    <div class="form-group">
        <label for="txtMDP">Mot de Passe (laisser vide pour ne pas changer) :</label>
        <input type="password" name="txtMDP" class="form-control" />
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
<?= form_close(); ?>
