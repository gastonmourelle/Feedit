<?php
include "config.php";
$salida = "";

if (isset($_POST['query'])) {
  $buscar = $_POST['query'];
  $stmt = $conex->prepare("SELECT * FROM perros 
    WHERE nombre LIKE CONCAT('%',?,'%') 
    OR identificador LIKE CONCAT('%',?,'%') 
    OR id LIKE CONCAT('%',?,'%') 
    OR raza LIKE CONCAT('%',?,'%') 
    ORDER BY nombre ASC");
  $stmt->bind_param("ssss",$buscar, $buscar, $buscar, $buscar);
} else {
  $stmt = $conex->prepare("SELECT * FROM perros");
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $estado = $row['entro'];
    if ($estado == 0) {
      $color = "color:#adb5bd";
    } else {
      $color = "color:#00AE25";
    }
    $salida .= "<div class='col'>
    <a href='ampliacion.php?identificador=" . $row['identificador'] . "'>
    <div class='card h-100'>
    <img src='img/" . $row['foto'] . "' class='card-img-top' alt=''>
    <div class='card-body'>
    <h5 class='card-title'>" . $row['nombre'] . "</h5>
    <p class='card-text'>- " . $row['raza'] . "</p>
    </div>
    <div class='card-footer'>
    <small class='text-muted'>Código: " . $row['id'] . "<a href='db_borrar.php?identificador=" . $row['identificador'] . "'><span data-feather='trash-2'></span></a><a href='editar.php?identificador=" . $row['identificador'] . "'><span style='margin-right:20px;' data-feather='edit-2'></span></a></small>
    </div></div></a></div>
    ";
  }
  echo $salida;
} else {
  echo "<h6>No se han encontrados resultados para tu búsqueda</h6>";
}

include "comp/scripts.php";
