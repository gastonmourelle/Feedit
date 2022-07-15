<?php
session_start();
include 'config.php';
$salida = '';

if (isset($_POST['descargar_excel'])) {
    $tiempoActualUnix = time() - 10800;
                $tiempoActual = gmdate('Y-m-d H:i:s', $tiempoActualUnix);
                $diaActual = gmdate('Y-m-d', $tiempoActualUnix);
    $sql1 = "SELECT * FROM logs WHERE horaSalida BETWEEN '$diaActual 00:00:01' AND '$diaActual 23:59:59' ORDER BY identificador DESC";
    $query1 = mysqli_query($conex, $sql1);
    
    if(mysqli_num_rows($query1) > 0){
        $salida .= '
        <table><tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tiempo comiendo</th>
            <th>Comida restante</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
            </tr>
    ';
    while($row = mysqli_fetch_array($query1)){
        $tiempoEntrada = strtotime($row['horaEntrada']);
                    $tiempoSalida = strtotime($row['horaSalida']);
                    $diferencia = ($tiempoSalida - $tiempoEntrada);
                    $tiempoDiferencia = gmdate('H:i:s', $diferencia);
        $salida .= "
        <tr>
        <td>" . $row['identificador'] . "</td>
        <td>" . $row['nombre'] . "</td>
        <td>" . $tiempoDiferencia . "</td>
        <td>" . $row['peso'] . "g</td>
        <td>" . $row['horaEntrada'] . "</td>
        <td>" . $row['horaSalida'] . "</td>
        </tr>
        ";
    }
    $salida .= "</table>";
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=logs-".$diaActual.".xls");
    echo $salida;
    }
    else{
        $_SESSION['error'] = "No se pudo exportar el archivo";
        header('Location: logs_diarios.php');
        exit(0);
    }
}
?>