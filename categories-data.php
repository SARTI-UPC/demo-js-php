<?php
$theCategory = $_GET['category'];

include ("lib/productes.php");


header('Content-Type: application/json');
echo json_encode($categories[$theCategory-1]);
