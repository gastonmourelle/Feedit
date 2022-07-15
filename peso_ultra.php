<?php
include 'config.php';

$peso = $_POST["peso"];
$ultrasonido = $_POST["ultrasonido"];

$ultimo = "SELECT MAX(identificador) AS ultimo_id FROM logs";
$result = mysqli_query($conex, $ultimo);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$ultimoid = $row['ultimo_id'];

$query1 = "UPDATE almacenamiento SET ultrasonido = '$ultrasonido'";
mysqli_query($conex, $query1);

$query2 = "UPDATE logs SET peso = '$peso' WHERE identificador = '$ultimoid'";
mysqli_query($conex, $query2);

?>