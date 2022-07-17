<?php
include 'autenticacion.php';
include 'config.php';

$identificador = "";
if (isset($_GET["identificador"])) {
    $identificador = $_GET["identificador"];
}
$sql1 = "SELECT * FROM perros WHERE identificador = $identificador";
$query1 = $conex->query($sql1);
?>

<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Ficha</title>
    <?php
    include 'comp/head.php';
    include 'comp/estilos.php';
    ?>
</head>

<body>
    <?php
    include 'comp/menu.php';
    ?>
    <h1 class="display-6">Ficha</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a style="margin-right:10px;" class="verificar btn btn-outline-dark btn-sm" href="verificacion.php"><span data-feather="check"></span> Verificar</a>
        <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><span data-feather="plus"></span> Nuevo</a>
    </div>
    </div>

    <div>

        <?php
        if ($query1->num_rows > 0) {
            while ($row = $query1->fetch_assoc()) {
                $tiempoActualUnix = time() - 10800;
                $ultimaSalidaUnix = strtotime(($row['ultimaSalida'])) + 7200;
                $diferenciaTiempoUnix = $tiempoActualUnix - $ultimaSalidaUnix;
                $cooldownUnix = 10; /* <--- cambiarlo por $cooldown*3600 */
                $tiempoEsperaUnix = $cooldownUnix - $diferenciaTiempoUnix;
                $tiempoEspera = gmdate("H:i:s", $tiempoEsperaUnix);
                $ultimaComida = date('d/m H:i', strtotime($row['ultimaEntrada']));
                $racion = intval($row['racion']);
                $veces = intval($row['veces']);
                $turnos = intval($row['turnos']);
                $unaRacion = ($racion / $turnos) | 0;
                $cantidadHoy = $unaRacion * $veces;
                $diferenciaCantidad = $racion - $cantidadHoy;
                $estado = $row['entro'];
                $mensaje = "";
                if ($diferenciaTiempoUnix < $cooldownUnix) {
                    $color = "color:#D30000";
                    $tooltip = "Tiene que esperar " . $tiempoEspera . " para volver a comer";
                } else if ($estado == 1) {
                    $color = "color:rgb(67, 103, 202)";
                    $tooltip = "Comiendo";
                } else if ($veces >= $turnos) {
                    $color = "color:#D30000";
                    $tooltip = "Ya usó todos sus turnos";
                } else {
                    $color = "color:#00AE25";
                    $tooltip = "Turno disponible";
                }
                if ($cantidadHoy >= $racion) {
                    $tooltip2 = "Este perro ya comió";
                } else {
                    $tooltip2 = $diferenciaCantidad . "g restantes";
                }
                $porcentaje = (($row['veces'] * 100) / $row['turnos']);
                if ($porcentaje >= 100) {
                    $color2 = "#00B005";
                } else if ($porcentaje < 100 and $porcentaje >= 80) {
                    $color2 = "#B0C800";
                } else if ($porcentaje < 80 and $porcentaje >= 60) {
                    $color2 = "#FFB900";
                } else if ($porcentaje < 60 and $porcentaje >= 40) {
                    $color2 = "#FF9B00";
                } else if ($porcentaje < 40 and $porcentaje >= 20) {
                    $color2 = "#D64E00";
                } else if ($porcentaje < 20 and $porcentaje > 0) {
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
                        <img style="object-fit: cover;height:600px;" class="rounded my-3 img-fluid w-100" src="img/<?php echo $row["foto"] ?>" alt="">

                    </div>
                    <div class="col-md-6 my-5">
                        <!-- TITULO -->
                        <div class="row">
                            <div class="col-md-8">
                                <span id="tooltip_comiendo" role="button" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $tooltip ?>">
                                    <h4 style="<?php echo $color ?>;margin-right:10px">●</h4>
                                </span>
                                <h1 class="d-inline-block"><?php echo $row["nombre"] ?></h1>
                                <h6 class="subtitulo"><?php echo $row["raza"] ?></h6>
                            </div>

                            <div class="col-md-3 my-3 d-flex justify-content-end">
                                <input class="buscar_id" type="hidden" value="<?php echo $row["identificador"] ?>"></input>
                                <a style="margin-right:40px;" href="editar.php?identificador=<?php echo $row["identificador"] ?>"><span class="iconos_ampliacion" data-feather="edit"></span></a>
                                <a style="margin-left:20px;" class="borrar_btn" href=""><span class="iconos_ampliacion" data-feather="trash-2"></span></a>
                            </div>
                        </div>

                        <div class="row listado_ampliacion">
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col">
                                        <span role="button" tabindex="0" data-toggle="tooltip" title="<?php echo $tooltip2 ?>">
                                            <div style="height: 20px;background-color:rgb(219, 219, 219)" class="progress">
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
                                            ?>%;" aria-valuenow="<?php echo $row["veces"] ?>" aria-valuemin="0" aria-valuemax="<?php echo $row["turnos"] ?>"><?php echo $row["veces"] ?> de <?php echo $row["turnos"] ?> turnos</div>
                                            </div>
                                        </span>
                                        <div class="d-flex justify-content-end">
                                            <p><b><?php echo $cantidadHoy ?>g</b> de <b><?php echo $racion ?>g</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row listado_ampliacion">
                            <div class="col-md-3">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>ID</b></li>
                                    <li class="list-group-item">#<?php echo $row["identificador"] ?></li>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Código UID</b></li>
                                    <li class="list-group-item"><?php echo $row["id"] ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row listado_ampliacion">
                            <div class="col-md-6">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Sexo</b></li>
                                    <li class="list-group-item"><?php echo $row["sexo"] ?></li>
                                </ul>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Raza</b></li>
                                    <li class="list-group-item"><?php echo $row["raza"] ?></li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Edad</b></li>
                                    <li class="list-group-item"><?php echo $row["edad"] ?> años</li>
                                </ul>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Peso</b></li>
                                    <li class="list-group-item"><?php echo $row["peso"] ?>kg</li>
                                </ul>
                            </div>
                        </div>

                        <div class="row listado_ampliacion">
                            <div class="col-md-5">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Cantidad (hoy)</b></li>
                                    <li class="list-group-item"><?php echo $cantidadHoy ?>g</li>
                                </ul>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Turnos (hoy)</b></li>
                                    <li class="list-group-item"><?php echo $row["veces"] ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Última comida</b></li>
                                    <li class="list-group-item"><?php echo $ultimaComida ?></li>
                                </ul>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Estado</b></li>
                                    <li class="list-group-item"><?php echo $tooltip ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row listado_ampliacion">
                            <div class="col-md-5">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Ración diaria (total)</b></li>
                                    <li class="list-group-item"><?php echo $row["racion"] ?>g</li>
                                </ul>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Turnos diarios</b></li>
                                    <li class="list-group-item"><?php echo $row["turnos"] ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Ración por turno</b></li>
                                    <li class="list-group-item"><?php echo $unaRacion ?>g</li>
                                </ul>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item"><b>Tiempo de espera entre turnos</b></li>
                                    <li class="list-group-item"><?php echo $row["cooldown"] ?> horas</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:20px;margin-left: 10px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 style="margin-bottom:40px;">Historial de turnos</h4>
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
                                <th>Ración</th>
                                <th>Restante</th>
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
                            ?>
                                    <tr style="vertical-align: middle;">
                                        <td><b><?php echo $row['identificador'] ?></b></a></td>
                                        <td><b><?php echo $row['nombre'] ?></b></a></td>
                                        <td><?php echo $row['dispensado'] ?>g</td>
                                        <td><?php echo $row['peso'] ?>g</td>
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
                    }
                    ?>
                        </tbody>
                    </table>
                </div>


                <?php
                include 'comp/modalBorrar.php';
                include 'comp/scripts.php';
                ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".borrar_btn").click(function(e) {
                            e.preventDefault();
                            var identificador = $('.buscar_id').val();
                            $("#borrar_id").val(identificador);
                            $("#modal_borrar").modal("show");
                        })
                    });
                </script>
</body>