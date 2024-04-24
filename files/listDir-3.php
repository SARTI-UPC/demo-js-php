<?php
$theFolder = $_GET['theFolder'];
if (!isset($theFolder)) {
    $theFolder = "/tmp";
}

if ($_SERVER['REQUEST_METHOD']=="GET") {
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    }
    else {
        $order = "";
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
}
else {  // POST - UPLOAD
    $op = $_POST["op"];
    $theFolder = $_POST["theFolder"];
    if ($op == "upload") {
        $src =  $_FILES['nouFile']['tmp_name'];
        $dst = $theFolder."/".$_FILES['nouFile']['name'];

        echo "<p>origen $src <br>";
        echo "<p>desti $dst <br>";

        $moved= move_uploaded_file( $_FILES['nouFile']['tmp_name'], $dst);

        if( $moved ) {
            echo "arxiu pujat correctament";         
        } 
        else {
            echo "error al pujar el fitxer";
        }

    }

}

?>
<H1><?=$theFolder?></H1>

<HTML>
    <HEAD>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>

            function renameFile(theFile) {
                console.log("Fitxer a esborrar", theFile);
                
                let newName = document.forms[0].elements["newName"].value;
                console.log(newName);
                window.location.href  = "listDir-3.php?folder=<?=$theFolder?>&op=rename&theFile="+theFile+"&newName="+newName;

            }
    </script>
    </HEAD>
    <BODY>
        UPLOAD
        <form action="listDir-3.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="theFolder" value="<?=$theFolder?>">
            <input type="hidden" name="op" value="upload">
            <p><input type="file" name="nouFile" value="nouFitxer.txt">
            <p><input type="submit" nane="enviar">
        </form>
        
    <hr>
        <form>
            Renombrar: <input type="text" name="newName" value="nouFitxer.txt">
        </form>
        <TABLE border="1">
        <TR>
            <TD align="center"  ><a href="listDir-3.php?theFolder=<?=$theFolder?>&order=name">[nom]</a></TD>
            <TD align="center"  ><a href="listDir-3.php?theFolder=<?=$theFolder?>&order=ext">[ext]</a></TD>
            <TD align="center"  ><a href="listDir-3.php?theFolder=<?=$theFolder?>&order=size">[size]</a></TD>
        
        </TR>

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

if (is_dir($theFolder)){
    if ($gestor = opendir($theFolder)) {

        $filesArray = array();
        while (($theFile = readdir($gestor)) !== false){
            if (!($theFile=="." || $theFile=="..")) {
                $filesArray[] = array(
                'name' => $theFile,
                'size' => filesize($theFolder."/".$theFile)
                );
            }
        }
        closedir($gestor);

        echo "order $order<br>";    
        if ($order=='name') {
            usort($filesArray, 'nameComparator');
        }
        else if ($order=="ext") {
            usort($filesArray, 'extComparator');
        
        }
        else if ($order=="size") {
            usort($filesArray, 'sizeComparator');
        
        }

        foreach ($filesArray as $file) {
                $theFile = $file['name'];
                $info = pathinfo($theFile);
                $name = $info['basename'];
                $ext = $info['extension'];
                $fullName = $theFolder."/".$theFile;
                $size = filesize($fullName);
                $lastDate = date("Y-m-d", filemtime($fullName));
                if (is_dir($fullName)) {
                ?>
                    <TR><TD> <span class="material-icons icono-carpeta">folder</span><a href="listDir-3.php?theFolder=<?=$fullName?>/">
                    <?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD>
                <?php
                }
                else if ($ext=='txt') {
                ?>
                <TR><TD><a href="visor.php?theFile=<?=$fullName?>" target="_blank"><?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD><TD><a href="listDir-3.php?folder=<?=$theFolder?>&op=delete&file=<?=$theFile?>"><i class="material-icons">delete</i></a></TD><TD><a onclick="javacript:updateFile('<?=$theFile?>')"><span class="material-icons">create</span></a></TD></a>

                <?php
                }

                else if ($ext=='pdf') {
                    ?>
                    <TR><TD><a href="visorPDF.php?theFile=<?=$fullName?>" target="_blank"><?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD><TD><a href="listDir-3.php?folder=<?=$theFolder?>&op=delete&file=<?=$theFile?>"><i class="material-icons">delete</i></a></TD><TD><a onclick="javacript:updateFile('<?=$theFile?>')"><span class="material-icons">create</span></a></TD></a>
        
                    <?php
                }
                else {
                    ?>
                    <TR><TD><?=$name?></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD><TD><a href="listDir-3.php?folder=<?=$theFolder?>&op=delete&file=<?=$theFile?>"><i class="material-icons">delete</i></a></TD><TD><a onclick="javacript:renameFile('<?=$theFile?>')"><span class="material-icons">create</span></a></TD></a>
        
                    <?php
                }?>
</TR>
<?php
        }
        
    }
}
    ?>
    
        </TABLE>    
    </BODY>
<HTML>