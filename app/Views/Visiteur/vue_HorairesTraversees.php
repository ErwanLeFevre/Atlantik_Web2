

<h2><?php echo $TitreDeLaPage; ?></h2>

<!-- Sélection du secteur -->
<form method="post" action="<?php echo base_url('horairestraversees'); ?>">
    <div class="form-group">
        <label for="noSecteur">Secteur :</label>
        <select name="noSecteur" id="noSecteur" class="form-control" onchange="this.form.submit()">
            <option value="">Sélectionner un secteur</option>
            <?php foreach ($secteurs as $secteur): ?>
                <option value="<?php echo $secteur->NOSECTEUR; ?>" <?php echo (isset($_POST['noSecteur']) && $_POST['noSecteur'] == $secteur->NOSECTEUR) ? 'selected' : ''; ?>>
                    <?php echo $secteur->NOM; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<!-- Sélection de la liaison et de la date si un secteur est sélectionné -->
<?php if (!empty($secteur)): ?>
<form method="post" action="<?php echo base_url('horairestraversees'); ?>">
    <div class="form-group">
        <label for="noLiaison">Liaison :</label>
        <select name="noLiaison" id="noLiaison" class="form-control">
            <?php foreach ($liaisons as $liaison): ?>
                <option value="<?php echo $liaison->NOLIAISON; ?>" <?php echo (isset($_POST['noLiaison']) && $_POST['noLiaison'] == $liaison->NOLIAISON) ? 'selected' : ''; ?>>
                    <?php echo $liaison->NOLIAISON; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="dateTraversee">Date :</label>
        <input type="date" name="dateTraversee" id="dateTraversee" class="form-control" value="<?php echo isset($_POST['dateTraversee']) ? $_POST['dateTraversee'] : ''; ?>" required>
    </div>
    <input type="hidden" name="noSecteur" value="<?php echo isset($_POST['noSecteur']) ? $_POST['noSecteur'] : ''; ?>">
    <button type="submit" class="btn btn-primary">Afficher les traversées</button>
</form>
<?php endif; ?>

<!-- Affichage des traversées si une liaison et une date sont sélectionnées -->
<?php if (!empty($tableauTraversees)): ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>N°</th>
            <th>Heure</th>
            <th>Bateau</th>
            <?php foreach ($categories as $categorie): ?>
                <th><?php echo $categorie->libelle; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tableauTraversees as $traversee): ?>
            <tr>
                <td><a href="<?php echo base_url('reservation/' . $traversee['noTraversee']); ?>"><?php echo $traversee['noTraversee']; ?></a></td>
                <td><?php echo $traversee['heure']; ?></td>
                <td><?php echo $traversee['bateau']; ?></td>
                <?php foreach ($categories as $categorie): ?>
                    <td><?php echo $traversee[$categorie->lettrecategorie]; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>