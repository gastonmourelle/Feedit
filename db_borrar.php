<?php
include 'db.php';
include 'config.php';
$identificador = 0;

if (!empty($_GET['identificador'])) {
    $identificador = $_REQUEST['identificador'];
}

if (!empty($_POST)) {
    $identificador = $_POST['identificador'];
    $foto = $_POST['foto'];

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

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->
    <link rel="stylesheet" href="css/temp.css">
    <title>Eliminar</title>
</head>

<body>
    <div>

        <div>
            <form action="db_borrar.php" method="post">
                <input type="hidden" name="identificador" value="<?php echo $identificador; ?>" />
                <p>¿Está seguro que desea eliminar este registro?</p>
                <div>
                    <button type="submit">Si</button>
                    <a href="listado.php">No</a>
                </div>
            </form>
        </div>

    </div>
</body>

</html>