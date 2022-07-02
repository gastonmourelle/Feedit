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
      <th>Tiempo de espera</th>
      <th>Turnos (hoy)</th>
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
      $tooltip = "Inactivo";
    } else {
      $color = "color:#00AE25";
      $tooltip = "Comiendo";
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
        <td>" . $row['cooldown'] . "h</td>
        <td>" . $row['veces'] . "<strong> / ".$row['turnos']."</strong></td>
        <td>" . $row['ultimaSalida'] . "</td>
        <td><span id='tooltip_comiendo' role='button' class='d-inline-block' tabindex='0' data-toggle='tooltip' title='".$tooltip."'><h4 style='" . $color . "'>●</h4></span></td>
        <td>
        <a href='editar.php?identificador=" . $row['identificador'] . "'><span style='margin-right:20px;' data-feather='edit-2'></span></a>
  			<a class='borrar_btn' href=''><span data-feather='trash-2'></span></a>
        <input class='buscar_id' type='hidden' value='" . $row['identificador'] . "'></input>
        </td>
      </tr>";
  }
  $salida .= "</tbody>";
  echo $salida;
} else {
  echo "No se han encontrado resultados";
}
include 'comp/modalBorrar.php';
include "comp/scripts.php";

?>

<script type="text/javascript">
  $(document).ready(function() {

    $(".borrar_btn").click(function(e) {
      e.preventDefault();
      var identificador = $('.buscar_id').val();
      $("#borrar_id").val(identificador);
      $("#modal_borrar").modal("show");
    })
  });
</script>