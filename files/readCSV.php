<?php
$theCSV = 'theCSV.csv';

$productes = array();
if (($gestor = fopen($theCSV, 'r')) !== false) {
    while (($fila = fgetcsv($gestor, 0, ',')) !== false) {
        array_push($productes, $fila);
    }
    fclose($gestor);
} else {
    echo "Problemes a l'obrir el fitxer CSV.";
}

print_r($productes);
?>