<?php

// Simulación de una base de datos de productos
$products = array(
    array("id" => 1, "name" => "Cireres", "category" => "fruites", "price" => 16),
    array("id" => 2, "name" => "XXXXX", "category" => "fruites", "price" => 23),
    array("id" => 3, "name" => "Castanyes", "category" => "fruites", "price" => 32),
    array("id" => 4, "name" => "Platans", "category" => "fruites", "price" => 46),
    array("id" => 5, "name" => "Kiwis", "category" => "fruites", "price" => 55)
);

header('Content-Type: application/json');
echo json_encode($products);