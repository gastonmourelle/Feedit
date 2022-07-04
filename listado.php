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
          $estado = $row['entro'];
          $turnos = $row['turnos'];
          $veces = $row['veces'];
          if ($veces >= $turnos) {
            $check = "<span data-feather='check'></span>";
          } else {
            $check = "";
          }
          if ($estado == 0) {
            $color = "color:#adb5bd";
            $tooltip = "Inactivo";
          } else {
            $color = "color:#00AE25";
            $tooltip = "Comiendo";
          } ?>
          <tr style="vertical-align: middle;">
            <td><a href="ampliacion.php?identificador=<?php echo $row['identificador'] ?>"><b><?php echo $row['identificador'] ?></b></a></td>
            <td><a href="ampliacion.php?identificador=<?php echo $row['identificador'] ?>"><img src="img/<?php echo $row['foto'] ?>" alt="<?php echo $row['foto'] ?>" style="object-fit: cover;height:100px;width:100px;" class="rounded-circle"></a></td>
            <td><a href="ampliacion.php?identificador=<?php echo $row['identificador'] ?>"><b><?php echo $row['nombre'] ?></b></a></td>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['sexo'] ?></td>
            <td><?php echo $row['raza'] ?></td>
            <td><?php echo $row['edad'] ?></td>
            <td><?php echo $row['peso'] ?>kg</td>
            <td><?php echo $row['racion'] ?>g</td>
            <td><?php echo $row['cooldown'] ?>h</td>
            <td><?php echo $check . $row['veces'] ?><strong> / <?php echo $row['turnos'] ?></strong></td>
            <td><?php echo $row['ultimaSalida'] ?></td>
            <td>
              <span id="tooltip_comiendo" role="button" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $tooltip ?>">
                <h4 style="<?php echo $color ?>">●</h4>
              </span>
            </td>
            <td>
              <a style="margin: 0 10px;" href="editar.php?identificador=<?php echo $row['identificador'] ?>">
                <span data-feather="edit-2"></span>
              </a>
              <a style="margin: 0 10px;" class="borrar_btn" href="">
                <span data-feather="trash-2"></span>
              </a>
              <p class="buscar_id" hidden><?php echo $row['identificador'] ?></p>
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