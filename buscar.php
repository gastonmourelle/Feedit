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
        <th>#</th>
        <th>Nombre</th>
        <th>Código</th>
        <th>Sexo</th>
        <th>Raza</th>
        <th>Edad</th>
        <th>Peso</th>
        <th>Ración diaria</th>
        <th>Turnos diarios</th>
        <th>Tiempo de espera</th>
        <th>Veces que ya comió</th>
        <th>Última comida</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>";
    while($row=$result->fetch_assoc()){
        $salida .= "<tr>
        <td><b>" . $row['identificador']."</b></td>
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
        <a href='editar.php?id=".$row['id']."'><i style='font-size:16px;margin-right:20px;' class='fa-solid fa-pen'>Editar</i></a>
  			<a href='db_borrar.php?id=".$row['id']."'><i style='font-size:16px;' class='fa-solid fa-trash-can'>Borrar</i></a>
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