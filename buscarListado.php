<?php
include "config.php";
$salida = "";

if (isset($_POST['query'])) {
  $buscar = $_POST['query'];
  $stmt = $conex->prepare("SELECT * FROM perros 
    WHERE nombre LIKE CONCAT('%',?,'%') 
    OR id LIKE CONCAT('%',?,'%') 
    OR raza LIKE CONCAT('%',?,'%') 
    ORDER BY identificador DESC");
  $stmt->bind_param("sss", $buscar, $buscar, $buscar);
} else {
  $stmt = $conex->prepare("SELECT * FROM perros");
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $salida = "<thead>
      <tr>
      <th style='width:5%'>#</th>
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
    <tbody>";
  while ($row = $result->fetch_assoc()) {
    $estado = $row['entro'];
    if ($estado == 0) {
      $color = "color:#adb5bd";
    } else {
      $color = "color:#00AE25";
    }
    $salida .= "<tr style='vertical-align: middle;'>
        <td><a href='ampliacion.php?identificador=" . $row['identificador'] . "'><b>" . $row['identificador'] . "</b></a></td>
        <td><a href='ampliacion.php?identificador=" . $row['identificador'] . "'><img src='img/" . $row['foto'] . "' alt='' style='object-fit: cover;height:100px;width:100px' class='rounded-circle'></a></td>
        <td><a href='ampliacion.php?identificador=" . $row['identificador'] . "'><b>" . $row['nombre'] . "</b></a></td>
        <td>" . $row['id'] . "</td>
        <td>" . $row['sexo'] . "</td>
        <td>" . $row['raza'] . "</td>
        <td>" . $row['edad'] . "</td>
        <td>" . $row['peso'] . "kg</td>
        <td>" . $row['racion'] . "g</td>
        <td>" . $row['turnos'] . "</td>
        <td>" . $row['cooldown'] . "h</td>
        <td>" . $row['veces'] . "</td>
        <td>" . $row['ultimaSalida'] . "</td>
        <td><h4 style='" . $color . "'>●</h4></td>
        <td>
        <a href='editar.php?identificador=" . $row['identificador'] . "'><span style='margin-right:20px;' data-feather='edit-2'></span></a>
  			<a href='db_borrar.php?identificador=". $row['identificador'] ."'><span data-feather='trash-2'></span></a>
        </td>
      </tr>";
  }
  $salida .= "</tbody>";
  echo $salida;
} else {
  echo "No se han encontrado resultados";
}

include "comp/scripts.php";
