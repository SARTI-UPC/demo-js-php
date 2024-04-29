<?php

function extComparator($a, $b) {
    $extA = pathinfo($a['name'], PATHINFO_EXTENSION);
    $extB = pathinfo($b['name'], PATHINFO_EXTENSION);
    return strcasecmp($extA, $extB);
}

function nameComparator($a, $b) {
    return strcasecmp($a['name'], $b['name']);
}


function sizeComparator($a, $b) {
    return $a['size'] - $b['size'];
}


function dateComparator($a, $b) {
    $date1 = $a['lastDate'];
    $date2 = $b['lastDate'];

    if ($date1 == $date2) {
        return 0;
    }
    return ($date1 < $date2) ? -1 : 1;
}
?>