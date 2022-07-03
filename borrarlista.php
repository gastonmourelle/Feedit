<?php
session_start();
include 'config.php';

if(isset($_POST['borrarlista_submit'])){
    $ids = $_POST['borrarlista_check_id'];
    $foto = $_GET['foto'];
    $extraer = implode(',' , $ids);

    $sql1 = "SELECT * FROM perros";
    $query1 = mysqli_query($conex, $sql1);
    foreach($query1 as $row){
        $ruta = "img/".$row['foto'];
        }

    $sql2 = "DELETE FROM perros WHERE identificador IN($extraer)";
    $query2 = mysqli_query($conex, $sql2);

    if($query2){
        unlink($ruta);
        $_SESSION['exito'] = "Registros eliminados con éxito";
        header('location: listado.php');
    }
    else{
        $_SESSION['error'] = "No se pudieron eliminar los registros";
        header('location: listado.php');
    }
}

?>