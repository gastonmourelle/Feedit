<?php
session_start();
if(isset($_SESSION['auth'])){
    if(!isset($_SESSION['mensaje'])){
        $_SESSION['mensaje'] = "Ya estás logueado";
    }
    header("Location: index.php");
    exit(0);
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Iniciar sesión</title>
    <?php
    include 'comp/head.php';
    include 'comp/estilos.php';
    ?>
    <link href="css/login.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="db_login.php" method="post">
            <img class="mb-4" src="svg/slack.svg" alt="" width="200">
            <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
            <?php
            include 'comp/alerts.php';
            ?>
            <div class="form-floating">
                <input type="text" name="login_user" class="form-control" id="floatingInput" placeholder="Introduzca su nombre de usuario" required>
                <label for="floatingInput">Usuario o correo electrónico</label>
            </div>
            <div class="form-floating">
                <input type="password" name="login_pass" class="form-control" id="floatingPassword" placeholder="Introduzca su contraseña" required>
                <label for="floatingPassword">Contraseña</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="login_submit" type="submit">Iniciar sesión</button>
            <p style="margin-top:20px"><a href="registrarse.php">Registrarse</a></p>
        </form>
    </main>


    <?php 
    include 'comp/scripts.php';
    ?>
</body>

</html>