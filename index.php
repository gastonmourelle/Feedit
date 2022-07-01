<!DOCTYPE html>
<html lang="es">
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Inicio</title>
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

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Inicio</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <a style="margin-right:10px;" class="verificar btn btn-outline-dark btn-sm" href="verificacion.php"><span data-feather="check"></span> Verificar</a>
        <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><span data-feather="plus"></span> Nuevo</a>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-5 g-4">
    <?php
    include 'db.php';
    $pdo = Base::connect();
    $sql = 'SELECT * FROM perros ORDER BY identificador DESC';
    foreach ($pdo->query($sql) as $row) {
      echo '<div class="col">';
      echo '<div class="card h-100">';
      echo '<img src="img/'.$row['foto'].'" class="card-img-top" alt="">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">'.$row['nombre'].'</h5>';
      echo '<p class="card-text">- '.$row['raza'].'</p>';
      echo '</div>';
      echo '<div class="card-footer">';
      echo '<small class="text-muted">Código: '.$row['id'].'<a href="db_borrar.php?id=' . $row['id'] . '"><span data-feather="trash-2"></span></a><a href="editar.php?id=' . $row['id'] . '"><span style="margin-right:20px;" data-feather="edit-2"></span></a></small>';
      echo '</div></div></div>';
    }
    Base::disconnect();
    ?>
    </div>

  </main>


  <?php include 'comp/scripts.php'; ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#buscar").keyup(function() {
        var consulta = $(this).val();
        $.ajax({
          url: 'buscar.php',
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