

function renameFile(theFolder, theFile) {
    console.log("Fitxer a renombrar", theFile);
    let newName = document.forms[1].elements["newName"].value;
    console.log(newName);
    window.location.href  = "listDir-3.php?folder="+theFolder+"&op=rename&theFile="+theFile+"&newName="+newName;

}



