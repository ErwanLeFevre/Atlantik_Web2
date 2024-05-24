
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Accueil</title>
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
        <a class="nav-link" href="<?php echo site_url('inscription') ?>">Inscription</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('voirsecteursliaisons') ?>">Voir les liaisons</a>
      </li>
      
      <?php
        $session = session();
        if(!is_null($session->get('identifiant'))) : ?>
        <?php echo 'Utilisateur connecté : ' . $session->get('identifiant').'&nbsp;&nbsp;'; ?>
        <li class="nav-item">
          <a href="<?php echo site_url('sedeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;
        </li>
        <?php endif; ?>

      <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('connexion') ?>">Se Connecter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link 3</a>
      </li>
    </ul>
  </div>
</nav>

<div>



                
           
