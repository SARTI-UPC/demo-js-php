<?php
$theFile = $_GET['theFile'];

?>

<H1> Visor de fitxers de text : <?=$theFile?> </H1> 

<?php
$text = "";
if ($gestor = fopen($theFile, 'r')) {
  while (($line = fgets($gestor)) !== false) {
   $text.=$line;
  }
  fclose($gestor);
}
?>


<FORM name="visor" action="writeFileFromVisor.php" method="POST">
  <input type="hidden" name="theFile" value="<?=$theFile?>">
<p><TEXTAREA name="content" rows="20" cols="70"><?=$text?></textarea>
<p><input type="submit" name="enviar">

</FORM>