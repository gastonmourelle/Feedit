<?php

$conex = new mysqli("localhost","root","","feedit");
if($conex -> connect_error){
    die("Conexión fallida".$conex->connect_error);
}

?>