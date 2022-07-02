<?php
include 'config.php';

if (isset($_GET['identificador'])) {
    $identificador = $_GET['identificador'];
    $foto = $_GET['foto'];

    $sql1 = "SELECT * FROM perros WHERE identificador='$identificador'";
    $query1 = mysqli_query($conex, $sql1);
    foreach($query1 as $row){
        $ruta = "img/".$row['foto'];
        }

    $sql2 = "DELETE FROM perros WHERE identificador = '$identificador'";
    $query2 = mysqli_query($conex, $sql2);

    if ($query2) {
        unlink($ruta);
        $_SESSION['exito'] = "Registro eliminado con éxito";
        header("Location: listado.php");
    } else {
        $_SESSION['error'] = "Error al eliminar el registro";
        header("Location: listado.php");
    }
}
?>