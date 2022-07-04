<?php
include 'autenticacion.php';
?>

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
    <h1 class="display-6">Detalles</h1>
    </div>

    <div>

        <?php
        if ($query1->num_rows > 0) {
            while ($row = $query1->fetch_assoc()) {
                $racion = intval($row['racion']);
                $turnos = intval($row['turnos']);
                $estado = $row['entro'];
                $mensaje = "";
                if ($estado == 0) {
                    $color = "color:#adb5bd";
                    $tooltip = "Inactivo";
                } else {
                    $color = "color:#00AE25";
                    $tooltip = "Comiendo";
                }
                $porcentaje = (($row['veces'] * 100) / $row['turnos']);
                if ($porcentaje >= 100) {
                    $color2 = "#00B005";
                } else if ($porcentaje < 100 and $porcentaje >= 80) {
                    $color2 = "#B0C800";
                } else if ($porcentaje < 80 and $porcentaje >= 60) {
                    $color2 = "#FFB900";
                } else if ($porcentaje < 60 and $porcentaje >= 30) {
                    $color2 = "#D64E00";
                } else if ($porcentaje < 30 and $porcentaje > 0) {
                    $color2 = "#D30000";
                } else {
                    $color2 = "#D30000";
                    $mensaje = $row['nombre'] . " todavía no comió";
                }
        ?>
                <div class="row">
                    <div class="col-md-6">
                        <!-- MIGAS -->
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="listado.php">Listado</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row["nombre"] ?> (#<?php echo $row["identificador"] ?>)</li>
                            </ol>
                        </nav>
                        <!-- __MIGAS__ -->
                        <img class="rounded my-3 img-fluid w-100" src="img/<?php echo $row["foto"] ?>" alt="">
                    </div>
                    <div class="col-md-5 my-5">
                        <!-- TITULO -->
                        <div class="row">
                            <div class="col-md-12">
                                <span id="tooltip_comiendo" role="button" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $tooltip ?>">
                                    <h3 style="<?php echo $color ?>;">●</h3>
                                </span>
                                <h1 class="d-inline-block"><?php echo $row["nombre"] ?></h1>
                                <h5 class="subtitulo">- <?php echo $row["raza"] ?></h5>
                                <h6>Comidas de hoy:</h6>
                                <div style="height: 25px;background-color:#D0d0d0" class="progress">
                                    <p style="line-height:24px;color:#808080;">
                                        <?php
                                        echo $mensaje;
                                        ?>
                                    </p>
                                    <div class="progress-bar" role="progressbar" style="background-color:
                                    <?php
                                    echo $color2;
                                    ?>;
                                    width: 
                                    <?php
                                    echo $porcentaje;
                                    ?>%;" aria-valuenow="<?php echo $row["veces"] ?>" aria-valuemin="0" aria-valuemax="<?php echo $row["turnos"] ?>"><?php echo $row["veces"] ?> de <?php echo $row["turnos"] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive my-5">
                    <table class="table table-striped table-sm table-hover tabla" id="datos-tabla" data-sorting="true">
                        <thead>
                            <?php
                            include 'comp/alerts.php';
                            ?>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Ración por turno</th>
                                <th>Tiempo comiendo</th>
                                <th>Hora de entrada</th>
                                <th>Hora de salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rfid = $row["id"];
                            $sql2 = "SELECT * FROM logs WHERE rfid = '$rfid'  ORDER BY identificador DESC";
                            $query2 = mysqli_query($conex, $sql2);
                            if (mysqli_num_rows($query2) > 0) {
                                foreach ($query2 as $row) {
                                    $tiempoEntrada = strtotime($row['horaEntrada']);
                                    $tiempoSalida = strtotime($row['horaSalida']);
                                    $diferencia = ($tiempoSalida - $tiempoEntrada);
                                    $tiempoDiferencia = gmdate('H:i:s', $diferencia);
                                    $unaRacion = ($racion / $turnos)| 0;
                            ?>
                                    <tr style="vertical-align: middle;">
                                        <td><b><?php echo $row['identificador'] ?></b></a></td>
                                        <td><b><?php echo $row['nombre'] ?></b></a></td>
                                        <td><?php echo $unaRacion ?>g</td>
                                        <td><?php echo $tiempoDiferencia ?></td>
                                        <td><?php echo $row['horaEntrada'] ?></td>
                                        <td><?php echo $row['horaSalida'] ?></td>
                                    </tr>
                    <?php
                                }
                            } else {
                                echo "<h6>No se han encontrados resultados</h6>";
                            }
                        }
                    }
                    ?>
                        </tbody>
                    </table>
                </div>


                <?php
                include 'comp/scripts.php';
                ?>
</body>