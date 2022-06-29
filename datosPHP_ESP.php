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
    $id = ($datos['id']);
    $turnos = ($datos['turnos']);
    $cooldown = ($datos['cooldown']);
    $veces = ($datos['veces']);
    $ultimaSalidaUnix = strtotime(($datos['ultimaSalida'])) + 7200;
    $ultimaEntrada = gmdate('Y-m-d H:i:s', (strtotime(($datos['ultimaEntrada'])) + 7200));
    $entro = ($datos['entro']);

    $tiempoActualUnix = time() - 10800;
    $tiempoActual = gmdate('Y-m-d H:i:s', $tiempoActualUnix);
    
    $diferenciaTiempoUnix = $tiempoActualUnix - $ultimaSalidaUnix;
    $cooldownUnix = 10; /* <--- cambiarlo por *3600 */

    if ($entro == 0 AND $turnos > $veces AND $diferenciaTiempoUnix >= $cooldownUnix){
        c("puede comer");

        $query1 = "UPDATE perros SET ultimaEntrada = NOW() WHERE id = '$UIDresultado'";
        mysqli_query($conex,$query1);

        $query2 = "UPDATE perros SET entro = 1 WHERE id = '$UIDresultado'";
        mysqli_query($conex,$query2);

        $query3 = "UPDATE perros SET foto = 'entra' WHERE id = '$UIDresultado'";
        mysqli_query($conex,$query3);
    }
    else if ($entro == 1){

        $query1 = "UPDATE perros SET ultimaSalida = NOW() WHERE id = '$UIDresultado'";
        mysqli_query($conex,$query1);

        $query2 = "INSERT INTO logs (nombre, rfid, horaEntrada, horaSalida) values ('$nombre', '$id', '$ultimaEntrada', NOW())";
        mysqli_query($conex,$query2);

        $query3 = "UPDATE perros SET veces = '$veces' + 1 WHERE id = '$UIDresultado'";
        mysqli_query($conex,$query3);

        $query4 = "UPDATE perros SET entro = 0 WHERE id = '$UIDresultado'";
        mysqli_query($conex,$query4);
    }
    else if ($turnos < $veces){
        c("comiste muchas veces");
    }
    else if ($diferenciaTiempoUnix < $cooldownUnix){
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