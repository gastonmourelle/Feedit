<?php

include 'config.php';

$peso = $_GET["peso"];
$ultrasonido = $_GET["ultrasonido"]; 

$query = "INSERT INTO almacenamiento (peso, ultrasonido) VALUES ('$peso', '$ultrasonido')";
$result = mysqli_query($conex,$query);

?>