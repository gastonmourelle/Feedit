<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Ampliación</title>
    <?php
    include 'comp/head.php';
    include 'comp/estilos.php';
    ?>
</head>

<body>
    <?php
    include 'comp/menu.php';
    include 'config.php';

    $identificador = "";
    if (isset($_GET["identificador"])) {
        $identificador = $_GET["identificador"];
    }
    $sql1 = "SELECT * FROM perros WHERE identificador = $identificador";
    $query1 = $conex->query($sql1);
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Detalles</h1>
        </div>
        <?php
        if ($query1->num_rows > 0) {
            while ($row = $query1->fetch_assoc()) {
        ?>
                <h1><?php echo $row["nombre"] ?></h1>
        <?php
            }
        }
        ?>
    </main>

    <?php
    include 'comp/scripts.php';
    ?>
</body>