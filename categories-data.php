<?php
$theCategory = $_GET['category'];
$frescos = array(    
    array("id" => 1, "name" => "frutas"),
    array("id" => 2, "name" => "Verduras y Hortalizas"),
    array("id" => 3, "name" => "Pescado"),
);

$refrigerados = array(    
    array("id" => 1, "name" => "yogures"),
    array("id" => 2, "name" => "Natas"),
    array("id" => 3, "name" => "Ahumados"),
);

$bodega = array(    
    array("id" => 1, "name" => "vinos tintos"),
    array("id" => 2, "name" => "vinos blancos"),
    array("id" => 3, "name" => "vinos rosados"),
);


// Simulación de una base de datos de productos
$categories = array(
    array("id" => 1, "name" => "frescos", "subcategory" => $frescos),
    array("id" => 2, "name" => "refrigerados", "subcategory" => $refrigerados),
    array("id" => 3, "name" => "Bodega", "subcategory" => $bodega),
);

header('Content-Type: application/json');
echo json_encode($categories[$theCategory-1]);
