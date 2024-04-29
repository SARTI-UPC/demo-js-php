<?php

function deleteFile( $file2Delete) {
    echo "op $op file : $file2Delete <br>";
    if (unlink($file2Delete)) {
        echo " arxiu $file2Delete esborrat! <br>";
    }
    else {
        echo "No s'ha pogut esborrar l'arxiu $file2Delete!<br>";  
    }    
}


function renameFile($theFile, $newName) {
    echo "op $op file : $theFile nou nom: $newName <br>";
    if (rename($theFile, $newName)) {
        echo "Arxiu renombrat!!!.";
    } 
    else {
        $error = error_get_last();
        echo "Error al renombrar l'arxiu: " . $error['message'];
    }

}

function getAllFiles($theFolder)  {
    $filesArray = array();
    if ($gestor = opendir($theFolder)) {

        while (($theFile = readdir($gestor)) !== false){
            $fullPath = $theFolder."/".$theFile;
            if (!($theFile=="." || $theFile=="..")) {
                $filesArray[] = array(
                'name' => $theFile,
                'size' => filesize($fullPath),
                 'ext' => pathinfo($fullPath)['extension'],
                 'lastDate' => date("Y-m-d", filemtime($fullPath))
                );
            }
        }
        closedir($gestor);
    }
        return $filesArray;
}

function uploadFile ($src, $dst) {

    echo "<p>origen $src <br>";
    echo "<p>desti $dst <br>";

    $moved= move_uploaded_file( $src, $dst);

    if( $moved ) {
        echo "arxiu pujat correctament";         
    } 
    else {
        echo "error al pujar el fitxer";
    }

}



?>