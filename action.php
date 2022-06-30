<?php

include "config.php";
$output = "";

if(isset($_POST['query'])){
    $search = $_POST['query'];
    $stmt=$conex->prepare("SELECT * FROM perros WHERE nombre LIKE CONCAT('%',?,'%') OR raza LIKE CONCAT('%',?,'%') ORDER BY identificador DESC");
    $stmt->bind_param("ss",$search,$search);
}
else{
    $stmt=$conex->prepare("SELECT * FROM perros");
}
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows>0){
    $output = "<thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Código</th>
      </tr>
    </thead>
    <tbody>";
    while($row=$result->fetch_assoc()){
        $output .= "<tr>
        <td>" . $row['identificador']."</td>
        <td>" . $row['nombre']."</td>
        <td>" . $row['id']."</td>
      </tr>";
    }
    $output .="</tbody>";
    echo $output;
}
else{
    echo "No se han encontrado resultados";
}

?>