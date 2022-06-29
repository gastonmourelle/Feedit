<?php

$conn = new mysqli("localhost","root","","dispensadorm2");
if($conn -> connect_error){
    die("Conexión fallida".$conn->connect_error);
}

?>