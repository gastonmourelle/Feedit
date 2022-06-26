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
  <div class="container">
            <div>
                <div class="tabla">
                  <table class="table table-hover table-borderless">
      <!-- <nav class="navbar navbar-expand-lg bg-light"><ul class="navbar-nav">
  			<li class="nav-item"><a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a></li>
  			<li class="nav-item"><a class="nav-link" href="registro.php">Registro</a></li>
  			<li class="nav-item"><a class="nav-link" href="verificacion.php">Verificación</a></li>
  		</ul> </nav>-->

      <div class="container">
  <div class="row">
    <div class="col-auto me-auto">
      <h1 class="titulo"><a style="color: var(--negro);" aria-current="page" href="inicio.php""><i class="fa-solid fa-house-chimney"></i></a> Listado de perros</h1>
    </div>
    <div class="col-auto">
    <?php
    $conex = mysqli_connect("localhost", "gaston", "dispensadorm2", "dispensadorm2");
    $tiempoActualUnix = time() - 10800;
    $horaActual = gmdate('H:i:s', $tiempoActualUnix);
     echo '<p>Hora actual: '. $horaActual . '</p>';
     ?>
      <a
        class="verificar btn btn-outline-dark btn-sm"
        href="verificacion.php"
        ><i class="fa-solid fa-check"></i> Verificar</a
      >
      <a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"
        ><i style="color: white" class="fa-solid fa-plus"></i> Nuevo</a
      >
    </div>
  </div>
</div>
<thead>
                      <tr>
                        <!-- <th>Foto</th> -->
                        <th style="width:5%">#</th>
                        <th>Nombre</th>
                        <th>Código</th>
  					  <th>Sexo</th>
  					  <th>Raza</th>
              <th>Edad (aprox)</th>
                        <th>Peso</th>
                        <th>Ración diaria</th>
                        <th>Turnos diarios</th>
                        <th>Tiempo de espera</th>
                        <th>Veces que ya comió</th>
                        <th>Última comidaaaaaa</th>
  					  <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                   include 'db.php';
                   $pdo = Base::connect();
                   $sql = 'SELECT * FROM perros ORDER BY identificador DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td><b>'. $row['identificador'] . '</b></td>';
                            echo '<td><b>'. $row['nombre'] . '</b></td>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['sexo'] . '</td>';
							echo '<td>'. $row['raza'] . '</td>';
							echo '<td>'. $row['edad'] . '</td>';
							echo '<td>'. $row['peso'] . 'kg</td>';
							echo '<td>'. $row['racion'] . 'g</td>';
							echo '<td>'. $row['turnos'] . '</td>';
							echo '<td>'. $row['cooldown'] . 'hs</td>';
							echo '<td>'. $row['veces'] . '</td>';
							echo '<td>'. $row['ultima'] . '</td>';
							echo '<td><a href="editar.php?id='.$row['id'].'"><i style="font-size:16px;margin-right:20px;" class="fa-solid fa-pen">Editar</i></a>';
  							echo ' ';
  							echo '<a href="db_borrar.php?id='.$row['id'].'"><i style="font-size:16px;" class="fa-solid fa-trash-can">Borrar</i></a>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Base::disconnect();
                  ?>
                  </tbody>
				</table>
			</div>
		</div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
	</body>
</html>
