<?php
include "config.php";
$salida = "";

if(isset($_POST['query'])){
    $buscar = $_POST['query'];
    $stmt=$conex->prepare("SELECT * FROM perros 
    WHERE nombre LIKE CONCAT('%',?,'%') 
    OR id LIKE CONCAT('%',?,'%') 
    OR raza LIKE CONCAT('%',?,'%') 
    ORDER BY identificador DESC");
    $stmt->bind_param("sss",$buscar,$buscar,$buscar);
}
else{
    $stmt=$conex->prepare("SELECT * FROM perros");
}
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows>0){
    $salida = "<thead>
      <tr>
      <th data-type='number'>#</th>
      <th>Foto</th>
      <th>Nombre</th>
      <th>Código</th>
      <th>Sexo</th>
      <th>Raza</th>
      <th data-type='number'>Edad</th>
      <th data-type='number'>Peso</th>
      <th data-type='number'>Ración diaria</th>
      <th data-type='number'>Turnos diarios</th>
      <th data-type='number'>Tiempo de espera</th>
      <th data-type='number'>Veces que ya comió</th>
      <th data-type='date'>Última comida</th>
      <th>Acciones</th>
      </tr>
    </thead>
    <tbody>";
    while($row=$result->fetch_assoc()){
        $salida .= "<tr style='vertical-align: middle;'>
        <td><b>" . $row['identificador']."</b></td>
        <td><img src='img/" . $row['foto'] . "' alt='' style='object-fit: cover;height:100px;width:100px' class='rounded-circle'></td>
        <td><b>" . $row['nombre']."</b></td>
        <td>" . $row['id']."</td>
        <td>" . $row['sexo']."</td>
        <td>" . $row['raza']."</td>
        <td>" . $row['edad']."</td>
        <td>" . $row['peso']."kg</td>
        <td>" . $row['racion']."g</td>
        <td>" . $row['turnos']."h</td>
        <td>" . $row['cooldown']."</td>
        <td>" . $row['veces']."</td>
        <td>" . $row['ultimaSalida']."</td>
        <td>
        <a href='editar.php?id=".$row['id']."'><span style='margin-right:20px;' data-feather='edit-2'></span></a>
  			<a href='db_borrar.php?id=".$row['id']."'><span data-feather='trash-2'></span></a>
        </td>
      </tr>";
    }
    $salida .="</tbody>";
    echo $salida;
}
else{
    echo "No se han encontrado resultados";
}
?>