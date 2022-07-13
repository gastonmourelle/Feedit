<?php
include 'autenticacion.php';
?>
<!DOCTYPE html>
<html lang="es">
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Inicio</title>
  <?php include
    'comp/head.php';
  include 'comp/estilos.php' ?>
</head>

<body>
  <?php
  include 'comp/menu.php';
  ?>

  <?php
  include "config.php";
  $stmt = $conex->prepare('SELECT * FROM perros ORDER BY nombre ASC');
  $stmt->execute();
  $result = $stmt->get_result();
  $cantidad = mysqli_num_rows($result);

  $sqlalm = $conex->prepare('SELECT distancia FROM almacenamiento LIMIT 1');
  $sqlalm->execute();
  $resultalm = $sqlalm->get_result();
  $alm =  $resultalm->fetch_assoc();
  $almacenamiento = 100 - ((100 * ($alm['distancia'])) / 25);
  $kg = ($almacenamiento * 35) / 100;
  ?>

  <h1 class="display-6">Inicio</h1>
  <?php
  include 'comp/alerts.php';
  ?>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a style="margin-right:10px;" class="verificar btn btn-outline-dark btn-sm" href="verificacion.php"><span data-feather="check"></span> Verificar</a>
    <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><span data-feather="plus"></span> Nuevo</a>
  </div>
  </div>

  <!-- Tarjetas -->
  <div style="margin-top:40px;margin-bottom:40px" class="row">
    <div class="col col_index">
      <span role="button" tabindex="0" data-toggle="tooltip" title="<?php echo $kg; ?>kg restantes">
        <div class="card tarjetas">
          <div class="card-body tarjetas_body">
            <h5 style="margin-bottom:30px" class="card-title">Almacenamiento</h5>
            <i class="fa-solid fa-box-archive tarjetas_span"></i>
            <h1 class="card-text float-end"><b><?php echo $almacenamiento; ?>%</b></h1>
          </div>
        </div>
      </span>
    </div>

    <div class="col col_index">
      <div class="card tarjetas">
        <div class="card-body tarjetas_body">
          <h5 style="margin-bottom:30px" class="card-title">Perros registrados</h5>
          <i class="fa-solid fa-paw d-inline-block tarjetas_span"></i>
          <h1 class="card-text float-end"><b><?php echo $cantidad ?></b></h1>
        </div>
      </div>
    </div>

    <div class="col col_index">
      <span role="button" tabindex="0" data-toggle="tooltip" title="25kg restantes">
        <div class="card tarjetas">
          <div class="card-body tarjetas_body">
            <h5 style="margin-bottom:30px" class="card-title">Titulo</h5>
            <i class="fa-solid fa-box-archive tarjetas_span"></i>
            <h1 class="card-text float-end"><b>00</b></h1>
          </div>
        </div>
      </span>
    </div>

    <div class="col col_index">
      <div class="card tarjetas">
        <div class="card-body tarjetas_body">
          <h5 style="margin-bottom:30px" class="card-title">Titulo</h5>
          <i class="fa-solid fa-paw d-inline-block tarjetas_span"></i>
          <h1 class="card-text float-end"><b>00</b></h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Perros -->
  <div id="datosInicio" class="row row-cols-1 row-cols-md-4 g-4">
    <?php
    include 'db.php';
    $pdo = Base::connect();
    $sql = 'SELECT * FROM perros ORDER BY nombre ASC';
    foreach ($pdo->query($sql) as $row) {
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
      <div class="col col_index">
        <a href="ampliacion.php?identificador=<?= $row['identificador'] ?>">
          <div class="card h-100">
            <img src="img/<?= $row['foto'] ?>" class="card-img-top img_index" alt="<?= $row['foto'] ?>">
            <div class="card-body">
              <span id="tooltip_comiendo" role="button" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $tooltip ?>">
                <h5 style="<?php echo $color ?>;margin-right:5px">●</h5>
              </span>
              <h5 class="card-title d-inline-block"><?= $row['nombre'] ?></h5>
              <small class="text-muted float-end"><b>UID: </b><?= $row['id'] ?></small>
              <p class="card-text"><?= $row['raza'] ?></p>
              <hr>
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
            </div>
            <input class="buscar_id" type="hidden" value="<?= $row['identificador'] ?>"></input>
          </div>
        </a>
      </div>
    <?php
    }
    Base::disconnect();
    ?>

  </div>
  <?php
  include 'comp/modalBorrar.php';
  include 'comp/scripts.php';
  ?>
  <script type="text/javascript">
    $(document).ready(function() {

      setTimeout(function() {
        $(".alert").alert('close');
      }, 4000);

      /* $(".borrar_btn").click(function(e) {
        e.preventDefault();
        var identificador = $('.buscar_id').val();
        $("#borrar_id").val(identificador);
        $("#modal_borrar").modal("show");
      }) */

      $("#buscar").keyup(function() {
        var consulta = $(this).val();
        $.ajax({
          url: 'buscarInicio.php',
          method: 'POST',
          data: {
            query: consulta
          },
          success: function(respuesta) {
            $("#datosInicio").html(respuesta);
          }
        });
      });
    });
  </script>
</body>

</html>