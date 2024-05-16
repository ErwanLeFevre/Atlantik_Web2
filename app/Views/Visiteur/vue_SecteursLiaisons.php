
<?php

echo "<table class='table table-bordered'>";
echo "
<tr>
<th>Secteur</th>
<th>Code Liaison</th>
<th>Distance en milles marin</th>
<th>Port de départ</th>
<th>Port d'arrivée</th>
</tr>";
foreach ($secteursLiaisons as $sl)
{
    echo "<TR>";
    echo "<TD>".$sl->nomsecteur."</TD><TD>"
    .$sl->noliaison."</TD><TD>"
    .$sl->distance."</TD><TD>"
    .$sl->portdepart."</TD><TD>"
    .$sl->portarrivee."</TD><TD>";
    echo "</TR>";
}
echo "</table>";
?>