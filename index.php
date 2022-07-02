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
  ?>

  <?php
  include "config.php";
  $stmt = $conex->prepare('SELECT * FROM perros ORDER BY identificador DESC');
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <h1 class="h2">Inicio</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a style="margin-right:10px;" class="verificar btn btn-outline-dark btn-sm" href="verificacion.php"><span data-feather="check"></span> Verificar</a>
    <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><span data-feather="plus"></span> Nuevo</a>
  </div>
  </div>

    <div id="datosInicio" class="row row-cols-1 row-cols-md-5 g-4">

      <?php
      include 'db.php';
      $pdo = Base::connect();
      $sql = 'SELECT * FROM perros ORDER BY identificador DESC';
      foreach ($pdo->query($sql) as $row) {
        echo '<div class="col">';
        echo '<a href="ampliacion.php?identificador=' . $row['identificador'] . '">';
        echo '<div class="card h-100">';
        echo '<img src="img/' . $row['foto'] . '" class="card-img-top" alt="">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
        echo '<p class="card-text">- ' . $row['raza'] . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<small class="text-muted">Código: ' . $row['id'] . '<a class="borrar_btn" href=""><span data-feather="trash-2"></span></a>
        <a href="editar.php?identificador=' . $row['identificador'] . '"><span style="margin-right:20px;" data-feather="edit-2"></span></a></small>';
        echo '<input class="buscar_id" type="hidden" value="'.$row['identificador'].'"></input>';
        echo '</div></div></a></div>';
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

        $(".borrar_btn").click(function(e){
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