<?php
$theFolder = "/tmp";
if (is_dir($theFolder)){
  if ($gestor = opendir($theFolder)){

?>
<HTML>
    <BODY>
        <TABLE border="1">

<?php
    while (($theFile = readdir($gestor)) !== false){
        $info = pathinfo($theFile);
        //print_r($info);
        $name = $info['basename'];
        $ext = $info['extension'];
        $size = filesize($theFile);
        $lastDate = date("Y-m-d", filemtime($theFile));
        ?>
        <TR><TD><?=$name?></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD>
        <?php
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