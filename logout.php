<?php
session_start();
if(isset($_POST['logout'])){
    unset($_SESSION['auth']);
    unset($_SESSION['auth_rol']);
    unset($_SESSION['auth_user']);

    $_SESSION['mensaje'] = "Has cerrado sesión";
    header("Location: login.php");
    exit(0);
}

?>