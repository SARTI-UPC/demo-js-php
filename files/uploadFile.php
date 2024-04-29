<?php
print_r($_FILES);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $archivo_nombre = $_FILES['file']['name'];
        echo "arxiu '$archivo_nombre'  rebut correctament.";
    } else {
        echo "Error al rebre l'arxiu.";
    }
} else {
    echo "Operació només disponible per el mètode 'POST'.";
}
?> 