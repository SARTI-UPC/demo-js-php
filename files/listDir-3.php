<?php
include 'library/commands.php';
include 'library/comparator.php';
error_reporting(0);

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
            $file2Delete = $theFolder. "/".$_GET['file'];
            deleteFile($file2Delete);
        }
        else if ($op == "rename") {

            $src = $theFolder."/".$_GET["theFile"];
            $dst = $theFolder."/".$_GET["newName"];        
            renameFile($src, $dst);
        }        
    }
}
else {  // POST - UPLOAD
    $op = $_POST["op"];
    $theFolder = $_POST["theFolder"];
    if ($op == "upload") {
        $src =  $_FILES['nouFile']['tmp_name'];
        $dst = $theFolder."/".$_FILES['nouFile']['name'];
        uploadFile($src, $dst);
    }

}

?>
<H1><?=$theFolder?></H1>

<HTML>
    <HEAD>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css"> 
    <link rel="stylesheet" href="css/modal.css"> 
    <script src="js/files.js"></script>
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
    <div id="drop-area">Deixa aquí els teus fitxers</div>
    <script src="js/drag-drop.js"></script>
    <hr>
        <form>
            Renombrar: <input type="text" name="newName" value="nouFitxer.txt">
        </form>
        <TABLE id="filesContainer" border="1">
        <TR>
            <TD align="center"  ><a href="listDir-3.php?theFolder=<?=$theFolder?>&order=name">[nom]</a></TD>
            <TD align="center"  ><a href="listDir-3.php?theFolder=<?=$theFolder?>&order=ext">[ext]</a></TD>
            <TD align="center"  ><a href="listDir-3.php?theFolder=<?=$theFolder?>&order=size">[size]</a></TD>
            <TD align="center"  ><a href="listDir-3.php?theFolder=<?=$theFolder?>&order=date">[data]</a></TD>   
            <td>&nbsp;</td>
            <td>&nbsp;</td>     
        </TR>

<?php


if (is_dir($theFolder)){

    $filesArray = getAllFiles($theFolder);

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
    else if ($order == "date") {
        usort($filesArray, 'dateComparator');
    }

    foreach ($filesArray as $file) {
        $theFile = $file['name'];
        $name = $theFile; // $info['basename'];
        $ext = $file['ext'];
        $fullName = $theFolder."/".$theFile;
        $size = $file['size'];
        
        $lastDate = $file['lastDate'];
        if (is_dir($fullName)) {
        ?>
            <TR><TD> <span class="material-icons icono-carpeta">folder</span><a href="listDir-3.php?theFolder=<?=$fullName?>/">
            <?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD>
        <?php
        }
        else if ($ext=='txt') {
        ?>
        <TR><TD><a href="visor.php?theFile=<?=$fullName?>" target="_blank"><?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD><TD><a  onclick="showModal('<?=$theFolder?>', '<?=$theFile?>')"><i class="material-icons">delete</i></a></TD><TD><a onclick="javacript:renameFile('<?=$theFolder?>','<?=$theFile?>')"><span class="material-icons">create</span></a></TD></a>

        <?php
        }

        else if ($ext=='pdf') {
            ?>
            <TR><TD><a href="visorPDF.php?theFile=<?=$fullName?>" target="_blank"><?=$name?></a></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD><TD><a onclick="showModal('<?=$theFolder?>', '<?=$theFile?>')"><i class="material-icons">delete</i></a></TD><TD><a onclick="javacript:renameFile('<?=$theFolder?>','<?=$theFile?>')"><span class="material-icons">create</span></a></TD></a>

            <?php
        }
        else {
            ?>
            <TR><TD><?=$name?></TD><TD><?=$ext?></TD><TD><?=$size?></TD><TD><?=$lastDate?></TD><TD><a  onclick="showModal('<?=$theFolder?>', '<?=$theFile?>')"><i class="material-icons">delete</i></a></TD><TD><a onclick="javacript:renameFile('<?=$theFolder?>','<?=$theFile?>')"><span class="material-icons">create</span></a></TD></a>

            <?php
        }?>
</TR>
<?php
        }
        
    
}
    ?>
    
        </TABLE>   
        
<div id="confirmModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>¿Estàs segur que vols esborrar aquest arxiu ?</p>
    <button id="confirmarBtn">Confirmar</button>
    <button id="cancelarBtn">Cancelar</button>
  </div>
</div> 
<script src="js/modal.js"></script>
    </BODY>
<HTML>