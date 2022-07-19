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
  $stmt->bind_param("ssss", $buscar, $buscar, $buscar, $buscar);
} else {
  $stmt = $conex->prepare("SELECT * FROM perros");
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $tiempoActualUnix = time() - 10800;
    $ultimaSalidaUnix = strtotime(($row['ultimaSalida'])) + 7200;
    $diferenciaTiempoUnix = $tiempoActualUnix - $ultimaSalidaUnix;
    $cooldownUnix = intval($row['cooldown'] * 10); /* <--- cambiarlo por $cooldown*3600 */
    $tiempoEsperaUnix = $cooldownUnix - $diferenciaTiempoUnix;
    $tiempoEspera = gmdate("H:i:s", $tiempoEsperaUnix);
    $ultimaComida = date('d/m H:i', strtotime($row['ultimaEntrada']));
    $racion = intval($row['racion']);
    $veces = intval($row['veces']);
    $turnos = intval($row['turnos']);
    $unaRacion = ($racion / $turnos) | 0;
    $cantidadHoy = $unaRacion * $veces;
    $diferenciaCantidad = $racion - $cantidadHoy;
    $estado = $row['entro'];
    $mensaje = "";
    if ($diferenciaTiempoUnix < $cooldownUnix) {
      $color = "color:#D30000";
      $tooltip = "Tiene que esperar " . $tiempoEspera . " para volver a comer";
    } else if ($estado == 1) {
      $color = "color:rgb(67, 103, 202)";
      $tooltip = "Comiendo";
    } else if ($veces >= $turnos) {
      $color = "color:#D30000";
      $tooltip = "Ya usó todos sus turnos";
    } else {
      $color = "color:#00AE25";
      $tooltip = "Turno disponible";
    }
    if ($cantidadHoy >= $racion) {
      $tooltip2 = "Este perro ya comió";
    } else {
      $tooltip2 = $diferenciaCantidad . "g restantes";
    }
    $porcentaje = (($row['veces'] * 100) / $row['turnos']);
    if ($porcentaje >= 100) {
      $color2 = "#00B005";
    } else if ($porcentaje < 100 and $porcentaje >= 80) {
      $color2 = "#B0C800";
    } else if ($porcentaje < 80 and $porcentaje >= 60) {
      $color2 = "#FFB900";
    } else if ($porcentaje < 60 and $porcentaje >= 40) {
      $color2 = "#FF9B00";
    } else if ($porcentaje < 40 and $porcentaje >= 20) {
      $color2 = "#D64E00";
    } else if ($porcentaje < 20 and $porcentaje > 0) {
      $color2 = "#D30000";
    } else {
      $color2 = "#D30000";
      $mensaje = $row['nombre'] . " todavía no comió";
    }
    $salida .= "<div class='col col_index'>
    <a href='ampliacion.php?identificador=" . $row['identificador'] . "'>
      <div class='card h-100'>
        <img src='img/" . $row['foto'] . "' class='card-img-top img_index' alt='" . $row['foto'] . "'>
        <div class='card-body'>
          <span id='tooltip_comiendo' role='button' class='d-inline-block' tabindex='0' data-toggle='tooltip' title='" . $tooltip . "'>
            <h5 style='" . $color . ";margin-right:5px'>●</h5>
          </span>
          <h5 class='card-title d-inline-block'>" . $row['nombre'] . "</h5>
          <small class='text-muted float-end'>" . $row['id'] . "</small>
          <p class='card-text'>" . $row['raza'] . "</p>
          <hr>
          <span role='button' tabindex='0' data-toggle='tooltip' title='" . $tooltip2 . "'>
            <div style='height: 20px;background-color:rgb(219, 219, 219)' class='progress'>
              <p style='line-height:24px;color:#808080;'>
                " . $mensaje
      . "
              </p>
              <div class='progress-bar' role='progressbar' style='background-color:" . $color2 . ";width:" . $porcentaje . "%;' aria-valuenow='" . $row['veces'] . "' aria-valuemin='0' aria-valuemax='" . $row['turnos'] . "'>" . $row['veces'] . " de " . $row['turnos'] . " turnos</div>
            </div>
          </span>
        </div>
        <input class='buscar_id' type='hidden' value='" . $row['identificador'] . "'></input>
      </div>
    </a>
  </div>
    ";
  }
  echo $salida;
} else {
  echo "<h6>No se han encontrados resultados para su búsqueda</h6>";
}

include "comp/scripts.php";
