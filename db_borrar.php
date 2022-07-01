<?php
include 'db.php';
include 'config.php';
$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    $id = $_POST['id'];
    $foto = $_POST['foto'];

    $sql1 = "SELECT * FROM perros WHERE id='$id'";
    $query1 = mysqli_query($conex, $sql1);
    foreach($query1 as $row){
        $ruta = "img/".$row['foto'];
        }

    $sql2 = "DELETE FROM perros WHERE id = '$id'";
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
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
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