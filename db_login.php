<?php
session_start();
include 'config.php';

if(isset($_POST['login_submit'])){
    $user = mysqli_real_escape_string($conex,$_POST['login_user']);
    $pass = mysqli_real_escape_string($conex,$_POST['login_pass']);

    $sql1 = "SELECT * FROM usuarios WHERE (user = '$user' OR email = '$user') AND pass = '$pass' LIMIT 1";
    $query1 = mysqli_query($conex, $sql1);

    if(mysqli_num_rows($query1) > 0)
    {
        foreach($query1 as $datos){
            $id = $datos['id'];
            $usuario = $datos['user'];
            $correo = $datos['email'];
            $rol = $datos['rol'];
        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$rol";
        $_SESSION['auth_user'] = [
            'user_id' => $id,
            'user_name' => $usuario,
            'user_email' => $correo,
        ];
        $_SESSION['exito'] = "Bienvenido, ".$usuario;
        header("Location: index.php");
        exit(0);
    }
    else{
        $_SESSION['error'] = "Sus datos no son correctos";
        header("Location: login.php");
        exit(0);
    }
}
else{
    header("Location: login.php");
    exit(0);
}
?>