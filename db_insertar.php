<?php
    session_start();
    include 'config.php';
 
	if (!empty($_POST)) {
        $identificador = $_POST['identificador'];
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
        $ultimaSalida = $_POST['ultimaSalida'];

        $formatos = array('image/jpg','image/jpeg','image/png');
        $validar_img = in_array($_FILES['foto']['type'],$formatos);

        $sql2 = "SELECT * FROM perros WHERE id = '$id'";
        $query2 = mysqli_query($conex,$sql2);

        if($query2){
            if(mysqli_num_rows($query2) > 0){
                $_SESSION['error'] = "Este código ya está en uso. Dirígase a la página de <a href='verificacion.php'>Verificación</a> para obtener más información";
                header("Location: registro.php");
            }
            else{
                if($validar_img){
                    if(file_exists("img/" . $_FILES["foto"]["name"])){
                    $guardar = $_FILES["foto"]["name"];
                    $_SESSION['error'] = "Esta imagen ya existe '.$guardar.'";
                    header("Location: registro.php");
                    }
                    else{
                    $sql1 = "INSERT INTO perros (nombre,foto,id,sexo,raza,edad,peso,racion,turnos,cooldown,ultimaSalida,veces,entro) VALUES ('$nombre','$foto','$id','$sexo','$raza','$edad','$peso','$racion','$turnos','$cooldown','$ultimaSalida','0','0')";
                    $query1 = mysqli_query($conex,$sql1);
        
                    if($query1){
                        move_uploaded_file($_FILES["foto"]["tmp_name"], "img/".$_FILES["foto"]["name"]);
                        $_SESSION['exito'] = "Registro añadido con éxito";
                        header("Location: listado.php");
                    }
                    else{
                        $_SESSION['error'] = "Error al añadir registro";
                        header("Location: listado.php");
                    }
                }
            }
            else{
                $_SESSION['error'] = "Formato de archivo no soportado";
                header("Location: listado.php");
            }
        }
            }
        }

        
?>
