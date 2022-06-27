<?php
	$conex = mysqli_connect("localhost", "gaston", "dispensadorm2", "dispensadorm2");

    $sql1 = "UPDATE perros SET veces = 0";
    $exito1 = mysqli_query($conex,$sql1);
?>