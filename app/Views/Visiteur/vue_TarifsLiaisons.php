<?php
echo "<table class='table table-bordered'>";
echo "
<tr>
<th>Categorie</th>
<th>Type</th>
<th><TR>Période</TR>
<TR><th></th>
<th></th>
<th></th></TR>
</th>
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