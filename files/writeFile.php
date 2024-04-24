<?php
$theText = $_GET['in'];
if (!isset($theText)) {
    $theText = "¡Hola, PHP mola!\n";
}

$theFile = '/tmp/theFile2.txt';

if ($gestor = fopen($theFile, 'a')) {
  fwrite($gestor, "\n".$theText);
  fclose($gestor);
}

echo "S'escriu $theText en el fitxer: $theFile<BR>";
?>