<?php
session_start();
include 'config.php';

if(isset($_POST['submit_registro'])){
    $user = mysqli_real_escape_string($conex, $_POST['user_registro']);
    $email = mysqli_real_escape_string($conex, $_POST['email_registro']);
    $pass = mysqli_real_escape_string($conex, $_POST['pass_registro']);
    $cpass = mysqli_real_escape_string($conex, $_POST['cpass_registro']);

    if($pass == $cpass){
        $sql1 = "SELECT email FROM usuarios WHERE email = '$email'";
        $query1 = mysqli_query($conex,$sql1);

        $sql3 = "SELECT user FROM usuarios WHERE user = '$user'";
        $query3 = mysqli_query($conex,$sql3);

        if((mysqli_num_rows($query1)) OR (mysqli_num_rows($query3)) > 0){
            $_SESSION['error'] = "Usuario o correo ya existente";
            header("Location: registrarse.php");
            exit(0);
            }
            else{
                $sql2 = "INSERT INTO usuarios (user,email,pass) VALUES ('$user','$email','$pass')";
                $query2 = mysqli_query($conex,$sql2);

                if($query2){
                    header("Location: login.php");
                    $_SESSION['exito'] = "Usted se ha registrado con éxito";
                    exit(0);
                }
                else{
                    $_SESSION['error'] = "Ha habido un error";
                    header("Location: registrarse.php");
                    exit(0);
                }
            }
    }
    else{
        $_SESSION['error'] = "Sus contraseñas no coinciden";
        header("Location: registrarse.php");
        exit(0);
    }
}
else{
    header("Location: registrarse.php");
    exit(0);
}
?>