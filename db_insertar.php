<?php
     
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
        $veces = $_POST['veces'];
        $ultimaSalida = $_POST['ultimaSalida'];

        $validar_img = $_FILES['foto']['type']=="image/jpg" || 
        $_FILES['foto']['type']=="image/jpeg" || 
        $_FILES['foto']['type']=="image/png"
        ;
        if($validar_img){
            if(file_exists("img/" . $_FILES["foto"]["name"])){
            $guardar = $_FILES["foto"]["name"];
            $_SESSION['error'] = "Esta imagen ya existe '.$guardar.'";
            header("Location: registro.php");
            }
            else{
            $sql1 = "INSERT INTO perros (nombre,foto,id,sexo,raza,edad,peso,racion,turnos,cooldown,veces,ultimaSalida) VALUES ('$nombre','$foto','$id','$sexo','$raza','$edad','$peso','$racion','$turnos','$cooldown','$veces','$ultimaSalida') ON DUPLICATE KEY UPDATE id=id;";
            $query1 = mysqli_query($conex,$sql1);

            if($query1){
                move_uploaded_file($_FILES["foto"]["tmp_name"], "img/".$_FILES["foto"]["name"]);
                $_SESSION['exito'] = "Registro añadido";
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
?>
