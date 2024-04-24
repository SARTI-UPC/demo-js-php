<?php


$theFile = $_POST['theFile'];
$theText = $_POST['content'];
if (!isset($theText)) {
    $theText = "¡Hola, PHP mola!\n";
}

if ($gestor = fopen($theFile, 'w')) {
  fwrite($gestor, "\n".$theText);
  fclose($gestor);
}
?>
<HTML>
  <BODY>
<h1> fitxer <?=$theFile?> <br>

<br><BR><HR>
<?=$theText?>

</BODY>
</HTML>
