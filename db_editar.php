<?php
    session_start();
    include "config.php";
 
    $identificador = null;
    if ( !empty($_GET['identificador'])) {
        $identificador = $_REQUEST['identificador'];
    }
     
    if ( !empty($_POST)) {
        $nombre = $_POST['nombre'];
        $foto = $_FILES['foto']['name'];
		$id = $_POST['id'];
		$sexo = $_POST['sexo'];
        $raza = $_POST['raza'];
        $edad = $_POST['edad'];
        $peso = $_POST['peso'];
        $racion = $_POST['racion'];
        $turnos = $_POST['turnos'];
        $cooldown = $_POST['cooldown'];
        $veces = $_POST['veces'];
        
        $sql1 = "SELECT * FROM perros WHERE identificador='$identificador'";
        $query1 = mysqli_query($conex, $sql1);
        foreach($query1 as $row){
            if ($foto == NULL){
                $img_datos = $row['foto'];
            }
            else{
                if ($ruta = "img/".$row['foto']){
                    unlink($ruta);
                    $img_datos = $foto;
                }
            }
        }

		$sql2 = "UPDATE perros SET nombre = '$nombre', foto = '$img_datos', sexo = '$sexo', raza = '$raza', edad ='$edad', peso ='$peso', racion ='$racion', turnos ='$turnos', cooldown ='$cooldown', veces ='$veces' WHERE identificador = '$identificador'";
        $query2 = mysqli_query($conex,$sql2);

        if($query2){
            if ($foto == NULL){
                $_SESSION['exito'] = "Registro editado con éxito";
                header("Location: listado.php");
            }
            else{
                move_uploaded_file($_FILES["foto"]["tmp_name"], "img/".$_FILES["foto"]["name"]);
                $_SESSION['exito'] = "Registro editado con éxito";
                header("Location: listado.php");
            }
        }
        else{
            $_SESSION['error'] = "No se pudo editar el registro";
            header("Location: listado.php");
        }
    }
?>