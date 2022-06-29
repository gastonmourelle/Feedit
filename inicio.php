<!DOCTYPE html>
<html lang="es">
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/df00b792cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css"> -->
  <link rel="stylesheet" href="css/temp.css">
  <title>Inicio</title>
</head>

<body>

  <a class="verificar btn btn-outline-dark btn-sm" href="verificacion.php"><i class="fa-solid fa-check"></i> Verificar</a>
  <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><i style="color: white" class="fa-solid fa-plus"></i> Nuevo</a>
  <h1>CRUD</h1>
  <?php
  $conex = mysqli_connect("localhost", "gaston", "dispensadorm2", "dispensadorm2");
  $tiempoActualUnix = time() - 10800;
  $horaActual = gmdate('H:i:s', $tiempoActualUnix);
  echo '<p>Hora actual: ' . $horaActual . '</p>';
  ?>
  <input type="text" name="search" id="search_text">
  <?php
  include "config.php";
  $stmt = $conn->prepare('SELECT * FROM perros ORDER BY identificador DESC');
  $stmt->execute();
  $result = $stmt->get_result();
  ?>
  <table id="table_data">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Código</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['identificador'] ?></td>
          <td><?= $row['nombre'] ?></td>
          <td><?= $row['id'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("#search_text").keyup(function() {
        var search = $(this).val();
        $.ajax({
          url: 'action.php',
          method: 'POST',
          data: {
            query: search
          },
          success: function(response) {
            $("#table_data").html(response);
          }
        });
      });
    });
  </script>
</body>

</html>