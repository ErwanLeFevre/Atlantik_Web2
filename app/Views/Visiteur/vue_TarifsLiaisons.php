<?php
echo "<table class='table table-bordered'>";
echo "
<tr>
    <th rowspan=2>Catégorie</th>
    <th rowspan=2>Type</th>
    <th colspan=3>
        Période
        <TR>";
            foreach ($tarifsLiaisons as $tl)
            {
                echo "<TD>"
                .$tl->datedebut."</BR>"
                .$tl->datefin.
            "</TD>";
            }
            echo "
        </TR>
    </th>
</tr>";
foreach ($tarifsLiaisons as $tl)
{
    echo "<TR>";
    echo "<TD rowspan=3>".$tl->lettrecategorie." ".$tl->categorielibelle."</TD>";
    foreach ($tarifsLiaisons as $tlibelle){
        echo "<TR>";
        echo "<TD>".$tlibelle->type."</TD><TD>"
        .$tlibelle->tarif."</TD><TD>"
        .$tlibelle->tarif."</TD><TD>"
        .$tlibelle->tarif."</TD><TD>";
        echo "</TR>";
    }
    echo "</TD><TD>";
    echo "</TR>";
}
echo "</table>";
?>