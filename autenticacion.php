<?php
session_start();
include 'config.php';

if(!isset($_SESSION['auth'])){
    $_SESSION['error'] = "Tienes que iniciar sesión para visitar la página";
    header("location: login.php");
    exit(0);
}
else{
}

?>