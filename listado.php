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
  if (isset($_SESSION['exito']) && $_SESSION['exito'] != '') {
    echo $_SESSION['exito'];
    unset($_SESSION['exito']);
  }
  if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
  }
  ?>

  <?php
  include "config.php";
  $stmt = $conex->prepare('SELECT * FROM perros ORDER BY identificador DESC');
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <h1 class="h2">Listado</h1>

  <div class="btn-toolbar mb-2 mb-md-0">
    <a style="margin-right:10px;" class="verificar btn btn-outline-dark btn-sm" href="verificacion.php"><span data-feather="check"></span> Verificar</a>
    <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><span data-feather="plus"></span> Nuevo</a>
  </div>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-sm table-hover tabla" id="datos-tabla" data-sorting="true">
      <thead>
        <tr>
          <th style="width:5%">#</th>
          <th>Foto</th>
          <th>Nombre</th>
          <th>Código</th>
          <th>Sexo</th>
          <th>Raza</th>
          <th>Edad</th>
          <th>Peso</th>
          <th>Ración diaria</th>
          <th>Turnos diarios</th>
          <th>Tiempo de espera</th>
          <th>Comidas de hoy</th>
          <th>Última comida</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'db.php';
        $pdo = Base::connect();
        $sql = 'SELECT * FROM perros ORDER BY identificador DESC';
        foreach ($pdo->query($sql) as $row) {
          $estado = $row['entro'];
          if ($estado == 0) {
            $color = "color:#adb5bd";
          } else {
            $color = "color:#00AE25";
          }
          echo '<tr style="vertical-align: middle;">';
          echo '<td><a href="ampliacion.php?identificador=' . $row['identificador'] . '"><b>' . $row['identificador'] . '</b></a></td>';
          echo '<td><a href="ampliacion.php?identificador=' . $row['identificador'] . '"><img src="img/' . $row['foto'] . '" alt="" style="object-fit: cover;height:100px;width:100px;" class="rounded-circle"></a></td>';
          echo '<td><a href="ampliacion.php?identificador=' . $row['identificador'] . '"><b>' . $row['nombre'] . '</b></a></td>';
          echo '<td>' . $row['id'] . '</td>';
          echo '<td>' . $row['sexo'] . '</td>';
          echo '<td>' . $row['raza'] . '</td>';
          echo '<td>' . $row['edad'] . '</td>';
          echo '<td>' . $row['peso'] . 'kg</td>';
          echo '<td>' . $row['racion'] . 'g</td>';
          echo '<td>' . $row['turnos'] . '</td>';
          echo '<td>' . $row['cooldown'] . 'h</td>';
          echo '<td>' . $row['veces'] . '</td>';
          echo '<td>' . $row['ultimaSalida'] . '</td>';
          echo '<td><h4 style="' . $color . '">●</h4></td>';
          echo '<td><a href="editar.php?identificador=' . $row['identificador'] . '"><span style="margin-right:20px;" data-feather="edit-2"></span></a>';
          echo '<a class="borrar_btn" href=""><span data-feather="trash-2"></span></a>';
          echo '<input class="buscar_id" type="hidden" value="'.$row['identificador'].'"></input>';
          echo '</td>';
          echo '</tr>';
        }
        Base::disconnect();
        ?>
    </table>
    
    <?php
    include 'comp/modalBorrar.php';
    include 'comp/scripts.php';
    ?>
    <script type="text/javascript">
      $(document).ready(function() {

        $(".borrar_btn").click(function(e){
          e.preventDefault();
          var identificador = $('.buscar_id').val();
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