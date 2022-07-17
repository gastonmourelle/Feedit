<?php
session_start();
include 'config.php';
include 'uid.php';

$peso = $_POST["peso"];
$ultrasonido = $_POST["ultrasonido"];

$ultimo = "SELECT MAX(identificador) AS ultimo_id FROM logs";
$result = mysqli_query($conex, $ultimo);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$ultimoid = $row['ultimo_id'];

$sql2 = "SELECT * FROM perros WHERE id = '$UIDresultado'";
$result2 = mysqli_query($conex, $sql2);
$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$racion = $row2['racion'];
$turnos = $row2['turnos'];
$unaRacion = ($racion / $turnos);

$query1 = "UPDATE almacenamiento SET ultrasonido = '$ultrasonido'";
mysqli_query($conex, $query1);

$query2 = "UPDATE logs SET peso = '$peso' WHERE identificador = '$ultimoid' AND rfid = '$UIDresultado'";
mysqli_query($conex, $query2);

$query3 = "UPDATE logs SET dispensado = '$unaRacion' WHERE identificador = '$ultimoid' AND rfid = '$UIDresultado'";
mysqli_query($conex, $query3);

?>