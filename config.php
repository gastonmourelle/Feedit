<?php

$conex = new mysqli("localhost","root","","dispensadorm2");
if($conex -> connect_error){
    die("Conexión fallida".$conex->connect_error);
}

?>