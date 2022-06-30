<?php
	include "config.php";

    $sql1 = "UPDATE perros SET veces = 0";
    $exito1 = mysqli_query($conex,$sql1);
    
?>