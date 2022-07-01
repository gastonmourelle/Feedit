<?php
include 'db.php';
include 'config.php';
$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    $id = $_POST['id'];

    $sql1 = "DELETE FROM perros WHERE id = '$id'";
    $query1 = mysqli_query($conex, $sql1);

    if ($query1) {
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