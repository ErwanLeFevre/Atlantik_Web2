<?php

function getUniquePeriods($tarifsLiaison) {
    $periods = [];
    foreach ($tarifsLiaison as $tl) {
        $period = $tl->datedebut . ' - ' . $tl->datefin;
        if (!in_array($period, $periods)) {
            $periods[] = $period;
        }
    }
    return $periods;
}

// Récupérer les périodes uniques
$uniquePeriods = getUniquePeriods($tarifsLiaisons);

echo "<table class='table table-bordered'>";
echo "
<tr>
    <th rowspan=2>Catégorie</th>
    <th rowspan=2>Type</th>
    <th colspan=".count($uniquePeriods).">Période</th>
</tr>
<tr>";
foreach ($uniquePeriods as $period) {
    echo "<th>".$period."</th>";
}
echo "</tr>";

$categories = [];
foreach ($tarifsLiaisons as $tl) {
    $category = $tl->lettrecategorie.' '.$tl->categorielibelle;
    if (!isset($categories[$category])) {
        $categories[$category] = [];
    }
    if (!isset($categories[$category][$tl->type])) {
        $categories[$category][$tl->type] = [];
    }
    foreach ($uniquePeriods as $period) {
        if (!isset($categories[$category][$tl->type][$period])) {
            $categories[$category][$tl->type][$period] = '-';
        }
    }
}

foreach ($tarifsLiaisons as $tl) {
    $category = $tl->lettrecategorie.' '. $tl->categorielibelle;
    $period = $tl->datedebut.' - '.$tl->datefin;
    $categories[$category][$tl->type][$period] = $tl->tarif;
}

foreach ($categories as $category => $types) {
    $rowspan = count($types);
    $firstType = true;
    foreach ($types as $type => $periods) {
        echo "<tr>";
        if ($firstType) {
            echo "<td rowspan='".$rowspan."'>".$category."</td>";
            $firstType = false;
        }
        echo "<td>".$type."</td>";
        foreach ($uniquePeriods as $period) {
            echo "<td>".$periods[$period]."</td>";
        }
        echo "</tr>";
    }
}

echo "</table>";
?>
