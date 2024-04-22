<?php

$name = $_POST["name"];
$category = $_POST["category"];
$price = $_POST["price"];
$id = $_POST["id"];
$operation = $_POST["operation"];

print_r($_POST);
echo "<P><p>Dades sobre fitxers";
print_r($_FILES);


echo "name: $name <br>";
echo "category: $category <br>";
echo "price: $price <br>";
echo "id: $id <br>";
echo "operation: $operation <br>";

$src =  $_FILES['imatge']['tmp_name'];
$dst = "/tmp/".$_FILES['imatge']['name'];

echo "<p>origen $src <br>";
echo "<p>desti $dst <br>";

move_uploaded_file( $_FILES['imatge']['tmp_name'], $dst);


?>