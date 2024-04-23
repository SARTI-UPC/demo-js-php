<?php
$theFolder = $_GET['theFolder'];
if (!isset($theFolder)) {
    $theFolder = "/Applications/XAMPP/xamppfiles/htdocs/";
}
?>
<H1><?=$theFolder?></H1>
<?php
if (is_dir($theFolder)){
  if ($gestor = opendir($theFolder)){

?>
<HTML>
    <BODY>
        <TABLE border="1">

<?php
    while (($theFile = readdir($gestor)) !== false){
        if (!($theFile=="." || $theFile=="..")) {

            $info = pathinfo($theFile);
            $name = $info['basename'];
            $ext = $info['extension'];
            $size = filesize($theFolder.$theFile);
            $lastDate = date("Y-m-d", filemtime($theFolder.$theFile));
            if (is_dir($theFolder.$theFile)) {
            ?>
                <TR><TD><a href="listDir.php?theFolder=<?=$theFolder.$theFile?>/">
                <?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD>
            <?php
            }
            else {
            ?>
            <TR><TD><?=$name?></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD>

            <?php
            }
        }
    }
    ?>
    </TR>
    <?php

    closedir($gestor);
    }
}
?>
        </TABLE>    
    </BODY>
<HTML>