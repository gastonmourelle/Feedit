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
      <span role="button" tabindex="0" data-toggle="tooltip" title="25kg restantes">
        <div class="card tarjetas">
          <div class="card-body tarjetas_body">
            <h5 style="margin-bottom:30px" class="card-title">Almacenamiento</h5>
            <i class="fa-solid fa-box-archive tarjetas_span"></i>
            <h1 class="card-text float-end"><b>55</b>%</h1>
          </div>
        </div>
      </span>
    </div>

    <div class="col col_index">
      <div class="card tarjetas">
        <div class="card-body tarjetas_body">
          <h5 style="margin-bottom:30px" class="card-title">Perros registrados</h5>
          <i class="fa-solid fa-paw d-inline-block tarjetas_span"></i>
          <h1 class="card-text float-end"><b>82</b></h1>
        </div>
      </div>
    </div>

    <div class="col col_index">
      <span role="button" tabindex="0" data-toggle="tooltip" title="25kg restantes">
        <div class="card tarjetas">
          <div class="card-body tarjetas_body">
            <h5 style="margin-bottom:30px" class="card-title">Almacenamiento</h5>
            <i class="fa-solid fa-box-archive tarjetas_span"></i>
            <h1 class="card-text float-end"><b>55</b>%</h1>
          </div>
        </div>
      </span>
    </div>

    <div class="col col_index">
      <div class="card tarjetas">
        <div class="card-body tarjetas_body">
          <h5 style="margin-bottom:30px" class="card-title">Perros registrados</h5>
          <i class="fa-solid fa-paw d-inline-block tarjetas_span"></i>
          <h1 class="card-text float-end"><b>82</b></h1>
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
    foreach ($pdo->query($sql) as $row) { ?>
      <div class="col col_index">
        <a href="ampliacion.php?identificador=<?= $row['identificador'] ?>">
          <div class="card h-100">
            <img src="img/<?= $row['foto'] ?>" class="card-img-top img_index" alt="<?= $row['foto'] ?>">
            <div class="card-body">
              <h5 class="card-title d-inline-block"><?= $row['nombre'] ?></h5>
              <div class="float-end">
                <a href="editar.php?identificador=<?= $row['identificador'] ?>"><span class="iconos_perros" style="margin-right:20px;" data-feather="edit"></span></a>
                <a class="borrar_btn" href=""><span class="iconos_perros" data-feather="trash-2"></span></a>
              </div>
              <p class="card-text"><?= $row['raza'] ?></p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Código: <?= $row['id'] ?></small>
              <input class="buscar_id" type="hidden" value="<?= $row['identificador'] ?>"></input>
            </div>
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

      $(".borrar_btn").click(function(e) {
        e.preventDefault();
        var identificador = $('.buscar_id').val();
        $("#borrar_id").val(identificador);
        $("#modal_borrar").modal("show");
      })

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