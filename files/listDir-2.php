<?php
$theFolder = $_GET['theFolder'];
if (!isset($theFolder)) {
    $theFolder = "/tmp";
}


if (isset($_GET['op'])) {
    $op = $_GET['op'];
    if ($op=="delete") {
        $file2Delete = $_GET['file'];
        echo "op $op file : $file2Delete <br>";
        echo $theFolder."/".$file2Delete;
        if (unlink($theFolder."/".$file2Delete)) {
            echo " arxiu $file2Delete esborrat! <br>";
        }
        else {
            echo "No s'ha pogut esborrar l'arxiu $file2Delete!<br>";  
        }
    
    }
    else if ($op == "rename") {
        $theFile = $_GET["theFile"];
        $newName = $_GET["newName"];
        echo "op $op file : $theFile nou nom: $newName <br>";
        if (rename($theFolder."/".$theFile, $theFolder."/".$newName)) {
            echo "Arxiu renombrat!!!.";
        } 
        else {
            $error = error_get_last();
            echo "Error al renombrar l'arxiu: " . $error['message'];
        }
    }
}

?>
<H1><?=$theFolder?></H1>
<?php
if (is_dir($theFolder)){
  if ($gestor = opendir($theFolder)){

?>
<HTML>
    <HEAD>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>

            function updateFile(theFile) {
                console.log("Fitxer a esborrar", theFile);
                
                let newName = document.forms[0].elements["newName"].value;
                console.log(newName);
                window.location.href  = "listDir-2.php?folder=<?=$theFolder?>&op=rename&theFile="+theFile+"&newName="+newName;

            }
    </script>
    </HEAD>
    <BODY>
        <form>
            <input type="text" name="newName" value="nouFitxer.txt">
        </form>
        <TABLE border="1">

<?php
    while (($theFile = readdir($gestor)) !== false){
        if (!($theFile=="." || $theFile=="..")) {

            $info = pathinfo($theFile);
            $name = $info['basename'];
            $ext = $info['extension'];
            $fullName = $theFolder."/".$theFile;
            $size = filesize($fullName);
            $lastDate = date("Y-m-d", filemtime($fullName));
            if (is_dir($fullName)) {
            ?>
                <TR><TD><a href="listDir-2.php?theFolder=<?=$fullName?>/">
                <?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD>
            <?php
            }
            else {
            ?>
            <TR><TD><?=$name?></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD><TD><a href="listDir-2.php?folder=<?=$theFolder?>&op=delete&file=<?=$theFile?>"><i class="material-icons">delete</i></a></TD><TD><a onclick="javacript:updateFile('<?=$theFile?>')"><span class="material-icons">create</span></a></TD></a>

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