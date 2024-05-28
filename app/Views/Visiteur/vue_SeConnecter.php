<h2><?= esc($TitreDeLaPage) ?></h2>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>

<?= form_open('connexion') ?>
    <?= csrf_field(); ?>

    <div class="form-group">
        <label for="txtnom">Nom :</label>
        <input type="text" name="txtnom" class="form-control" value="<?= set_value('txtnom'); ?>" />
    </div>
    
    <div class="form-group">
        <label for="txtMotDePasse">Mot de passe :</label>
        <input type="password" name="txtMotDePasse" class="form-control" />
    </div>
    
    <button type="submit" class="btn btn-primary">Se connecter</button>
<?= form_close(); ?>