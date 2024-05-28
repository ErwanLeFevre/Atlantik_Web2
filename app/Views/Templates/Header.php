<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Atlantik</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('voirsecteursliaisons') ?>">Voir les liaisons</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('horairestraversees') ?>">Voir les Horaires</a>
            </li>
            <?php
            $session = session();
            if ($session->has('NOM')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('') ?>">Historique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('modification') ?>">Paramètres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('deconnexion') ?>">Se Déconnecter</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('inscription') ?>">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('connexion') ?>">Se Connecter</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div>
