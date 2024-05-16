<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Inscription incorrecte')
  echo service('validation')->listErrors(); // affichage liste des erreurs, suite à erreur validation
?>
<div class="container mt-3">
  <table class="table table-bordered table-xl">
    <thead>
      <tr>
        <th>Secteur</th>
        <th>Liaison</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td></td>
        <td>Code Liaison</td>
        <td>Distance en milles marin</td>
        <td>Port de départ</td>
        <td>Port d'arrivé</td>
      </tr>
      <tr>        
        <td>
            <?php foreach ($lesLiaisons as $uneLiaison) :
                echo '<td>'.anchor('voirLesLiaisons/'.$uneLiaison->nosecteur, $uneLiaison->noliaison, $uneLiaison->distance, $uneLiaison->noport_depart, $uneLiaison->noport_arrivee).'</td>';
            endforeach ?>
        </td>
        <td>

        </td>
      </tr>
    </tbody>
  </table>
</div>
