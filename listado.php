<?php
include 'autenticacion.php';
?>

<!DOCTYPE html>
<html lang="es">
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Listado</title>
  <?php include 'comp/head.php';
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
  ?>

  <h1 class="display-6">Listado</h1>

  <div class="btn-toolbar mb-2 mb-md-0">
    <a style="margin-right:10px;" class="verificar btn btn-outline-dark btn-sm" href="verificacion.php"><span data-feather="check"></span> Verificar</a>
    <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><span data-feather="plus"></span> Nuevo</a>
  </div>
  </div>

  <div class="table-responsive">
    <table style="width:100%;" class="table table-striped table-sm table-hover tabla" id="datos-tabla" data-sorting="true">
      <thead>
        <?php
        include 'comp/alerts.php';
        include 'comp/modalBorrar_lista.php';
        ?>

        <tr>
          <th>#</th>
          <th>Foto</th>
          <th>Nombre</th>
          <th>Código</th>
          <th>Sexo</th>
          <th>Raza</th>
          <th>Edad</th>
          <th>Peso</th>
          <th>Ración diaria</th>
          <th>Tiempo de espera</th>
          <th>Turnos (hoy)</th>
          <th>Última comida</th>
          <th>Estado</th>
          <th style="width:10%">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'db.php';
        $pdo = Base::connect();
        $sql = 'SELECT * FROM perros ORDER BY nombre ASC';
        foreach ($pdo->query($sql) as $row) {
          $cooldownUnix = 10; /* <--- cambiarlo por $cooldown*3600 */
          $tiempoActualUnix = time() - 10800;
          $ultimaSalidaUnix = strtotime(($row['ultimaSalida'])) + 7200;
          $diferenciaTiempoUnix = $tiempoActualUnix - $ultimaSalidaUnix;
          $tiempoEsperaUnix = $cooldownUnix - $diferenciaTiempoUnix;
          $tiempoEspera = gmdate("H:i:s", $tiempoEsperaUnix);
          $estado = $row['entro'];
          $turnos = $row['turnos'];
          $veces = $row['veces'];
          if ($veces >= $turnos) {
            $check = "<span data-feather='check'></span>";
          } else {
            $check = "";
          }
          if ($diferenciaTiempoUnix < $cooldownUnix) {
            $color = "color:#D30000";
            $tooltip = "Tiene que esperar " . $tiempoEspera . " para volver a comer";
          }
          else if ($estado == 1) {
            $color = "color:rgb(67, 103, 202)";
            $tooltip = "Comiendo";
          } else if ($veces >= $turnos) {
            $color = "color:#D30000";
            $tooltip = "Ya usó todos sus turnos";
          } else {
            $color = "color:#00AE25";
            $tooltip = "Turno disponible";
          } ?>
          <tr style="vertical-align: middle;">
            <td><a href="ampliacion.php?identificador=<?= $row['identificador'] ?>"><b><?= $row['identificador'] ?></b></a></td>
            <td><a href="ampliacion.php?identificador=<?= $row['identificador'] ?>"><img src="img/<?= $row['foto'] ?>" alt="<?= $row['foto'] ?>" style="object-fit: cover;height:100px;width:100px;" class="rounded-circle"></a></td>
            <td><a href="ampliacion.php?identificador=<?= $row['identificador'] ?>"><b><?= $row['nombre'] ?></b></a></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['sexo'] ?></td>
            <td><?= $row['raza'] ?></td>
            <td><?= $row['edad'] ?></td>
            <td><?= $row['peso'] ?>kg</td>
            <td><?= $row['racion'] ?>g</td>
            <td><?= $row['cooldown'] ?>h</td>
            <td><?= $check . $row['veces'] ?><strong> / <?= $row['turnos'] ?></strong></td>
            <td><?= $row['ultimaEntrada'] ?></td>
            <td>
              <span id="tooltip_comiendo" role="button" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?= $tooltip ?>">
                <h4 style="<?= $color ?>">●</h4>
              </span>
            </td>
            <td>
              <a style="margin: 0 10px;" href="editar.php?identificador=<?= $row['identificador'] ?>">
                <span data-feather="edit"></span>
              </a>
              <a style="margin: 0 10px;" class="borrar_btn" href="">
                <span data-feather="trash-2"></span>
              </a>
              <p class="buscar_id" hidden><?= $row['identificador'] ?></p>
            </td>
          </tr>
        <?php
        }
        Base::disconnect();
        ?>

        </form>
  </div>
  </div>
  </div>
  </table>

  <?php
  include 'comp/modalBorrar.php';
  include 'comp/scripts.php';
  ?>
  <script type="text/javascript">
    $(document).ready(function() {

      setTimeout(function() {
        $(".alert").alert('close');
      }, 4000);

      $(".borrar_btn").click(function(e) {
        e.preventDefault();
        var identificador = $(this).closest('tr').find('.buscar_id').text();
        $("#borrar_id").val(identificador);
        $("#modal_borrar").modal("show");
      })

      $("#buscar").keyup(function() {
        var consulta = $(this).val();
        $.ajax({
          url: 'buscarListado.php',
          method: 'POST',
          data: {
            query: consulta
          },
          success: function(respuesta) {
            $("#datos-tabla").html(respuesta);
          }
        });
      });
    });
  </script>
</body>

</html>