<?php
include 'autenticacion.php';
?>

<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Logs</title>
    <?php
    include 'comp/head.php';
    include 'comp/estilos.php';
    ?>
</head>

<body>
    <?php
    include 'comp/menu.php';
    include 'config.php';
    ?>
    <h1 class="display-6">Logs diarios</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="date" name="desde" class="form-control" value="
                        <?php
                        if (isset($_GET['desde'])) {
                            echo $_GET['desde'];
                        } else {
                            echo date("Y-m-d",time());
                        }
                        ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="date" name="hasta" class="form-control" value="
                        <?php
                        if (isset($_GET['hasta'])) {
                            echo $_GET['hasta'];
                        } else {
                            echo date("Y-m-d",time());
                        }
                        ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-sm">Filtrar</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="excel.php" method="post">
            <button type="submit" name="descargar_excel" class="btn btn-outline-dark btn-sm">
                <span data-feather="download-cloud"></span> Exportar XLS
            </button>
        </form>
    </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover tabla" id="datos-tabla" data-sorting="true">
            <thead>
                <?php
                include 'comp/alerts.php';
                ?>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Tiempo comiendo</th>
                    <th>Hora de entrada</th>
                    <th>Hora de salida</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['desde']) && isset($_GET['hasta'])) {
                    $desde = $_GET['desde'];
                    $hasta = $_GET['hasta'];
                    if (strtotime($desde) < strtotime($hasta)) {

                        $sql1 = "SELECT * FROM logs WHERE horaSalida BETWEEN '$desde' AND '$hasta' ORDER BY identificador DESC";
                        $query1 = mysqli_query($conex, $sql1);

                        if (mysqli_num_rows($query1) > 0) {
                            foreach ($query1 as $row) {
                                $tiempoEntrada = strtotime($row['horaEntrada']);
                                $tiempoSalida = strtotime($row['horaSalida']);
                                $diferencia = ($tiempoSalida - $tiempoEntrada);
                                $tiempoDiferencia = gmdate('H:i:s', $diferencia);
                ?>
                                <tr style="vertical-align: middle;">
                                    <td><b><?php echo $row['identificador'] ?></b></td>
                                    <td><b><?php echo $row['nombre'] ?></b></td>
                                    <td><?php echo $tiempoDiferencia ?></td>
                                    <td><?php echo $row['horaEntrada'] ?></td>
                                    <td><?php echo $row['horaSalida'] ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <center><span style="margin-right:5px" data-feather="alert-triangle"></span><?php echo "No se han encontrado resultados para su búsqueda" ?></center>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <center><span style="margin-right:5px" data-feather="alert-triangle"></span><strong>Error: </strong><?php echo "El rango de fechas es inválido" ?></center>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                } else {
                    $tiempoActualUnix = time() - 10800;
                    $tiempoActual = gmdate('Y-m-d H:i:s', $tiempoActualUnix);
                    $diaActual = gmdate('Y-m-d', $tiempoActualUnix);

                    $sql2 = "SELECT * FROM logs WHERE horaSalida BETWEEN '$diaActual 00:00:01' AND '$diaActual 23:59:59' ORDER BY identificador DESC";
                    $query2 = mysqli_query($conex, $sql2);

                    if (mysqli_num_rows($query2) > 0) {
                        foreach ($query2 as $row) {
                            $tiempoEntrada = strtotime($row['horaEntrada']);
                            $tiempoSalida = strtotime($row['horaSalida']);
                            $diferencia = ($tiempoSalida - $tiempoEntrada);
                            $tiempoDiferencia = gmdate('H:i:s', $diferencia);
                        ?>
                            <tr style="vertical-align: middle;">
                                <td><b><?php echo $row['identificador'] ?></b></td>
                                <td><b><?php echo $row['nombre'] ?></b></td>
                                <td><?php echo $tiempoDiferencia ?></td>
                                <td><?php echo $row['horaEntrada'] ?></td>
                                <td><?php echo $row['horaSalida'] ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <center><span style="margin-right:5px" data-feather="alert-triangle"></span><?php echo "No se han encontrado resultados" ?></center>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php
                    }
                }
                ?>

        </table>

        <?php
        include 'comp/scripts.php';
        ?>
</body>