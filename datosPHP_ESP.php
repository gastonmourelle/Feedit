<?php
    include 'db.php';
    include 'uid.php';
    include 'tiempo.php';
    $conex = mysqli_connect("localhost", "gaston", "dispensadorm2", "dispensadorm2");

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Base::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM perros where id = '$UIDresultado'";
    $q = $pdo->prepare($sql);
    $q->execute();
    $datos = $q->fetch(PDO::FETCH_ASSOC);

    $nombre = ($datos['nombre']);
    $turnos = ($datos['turnos']);
    $cooldown = ($datos['cooldown']);
    $veces = ($datos['veces']);
    $ultima = strtotime(($datos['ultima'])) + 7200;

    $tiempoActualUnix = time() - 10800;
    $horaActual = gmdate('H:i:s', $tiempoActualUnix);
    $tiempoActual = gmdate('Y-m-d H:i:s', $tiempoActualUnix);
    $horaConsulta = gmdate('H:i:s', $tiempoConsultaUnix);
    $tiempoConsulta = gmdate('Y-m-d H:i:s', $tiempoConsultaUnix);
    
    $diferenciaTiempoUnix = $tiempoActualUnix - $ultima;
    $cooldownUnix = $cooldown + 10; /* <--- cambiarlo por *3600 */

    c("Nombre: " . $nombre);
    c("----FORMATEADO----");
    c("Hora actual: " . $horaActual);
    c("Consulta: " . $horaConsulta);
    c("----UNIX----");
    c("Diferencia: " . $diferenciaTiempoUnix);
    c("Cooldown: " . $cooldownUnix);
    c("Ultima: " . $ultima);

    if ($turnos >= $veces AND $diferenciaTiempoUnix >= $cooldownUnix){
        c("puede comer");

	    $sql1 = "UPDATE perros SET ultima = '$tiempoConsulta' WHERE id = '$UIDresultado'";
        $exito1 = mysqli_query($conex,$sql1);

        $sql2 = "UPDATE perros SET veces = '$veces' + 1 WHERE id = '$UIDresultado'";
        $exito2 = mysqli_query($conex,$sql2);
    }
    else if ($turnos < $veces)
    {
        c("comiste muchas veces");
    }
    else if ($diferenciaTiempoUnix < $cooldownUnix)
    {
        c("no esperaste el cooldown");
    }





    /* HABILITAR LOGS */
    function c($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
    
    Base::disconnect();
?>

<!DOCTYPE html>
<html lang="es">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    <link rel="stylesheet" href="css/temp.css">
		<title>Datos enviados al ESP</title>
	</head>