<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Logs Diarios</title>
    <?php
    session_start();
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
                    <th style="width:5%">#</th>
                    <th>Nombre</th>
                    <th>Tiempo comiendo</th>
                    <th>Hora de entrada</th>
                    <th>Hora de salida</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $pdo = Base::connect();
                $tiempoActualUnix = time() - 10800;
                $tiempoActual = gmdate('Y-m-d H:i:s', $tiempoActualUnix);
                $diaActual = gmdate('Y-m-d', $tiempoActualUnix);
                $sql = "SELECT * FROM logs WHERE horaSalida BETWEEN '$diaActual 00:00:01' AND '$diaActual 23:59:59' ORDER BY identificador DESC";
                foreach ($pdo->query($sql) as $row) {
                    $tiempoEntrada = strtotime($row['horaEntrada']);
                    $tiempoSalida = strtotime($row['horaSalida']);
                    $diferencia = ($tiempoSalida - $tiempoEntrada);
                    $tiempoDiferencia = gmdate('H:i:s', $diferencia);
                    echo '<tr style="vertical-align: middle;">';
                    echo '<td><b>' . $row['identificador'] . '</b></a></td>';
                    echo '<td><b>' . $row['nombre'] . '</b></a></td>';
                    echo '<td>' . $tiempoDiferencia . '</td>';
                    echo '<td>' . $row['horaEntrada'] . '</td>';
                    echo '<td>' . $row['horaSalida'] . '</td>';
                    echo '</tr>';
                }
                Base::disconnect();
                ?>
        </table>

        <?php
        include 'comp/scripts.php';
        ?>
        <script type="text/javascript">
      $(document).ready(function() {

        setTimeout(function() {
          $(".alert").alert('close');
        }, 4000);
      });
      </script>
</body>