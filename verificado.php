<?php
    include 'db.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Base::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM perros where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$datos = $q->fetch(PDO::FETCH_ASSOC);
	Base::disconnect();
	
	$mensaje = null;
	if (null==$datos['nombre']) {
		$mensaje = "Este código todavía no está registrado";
		$datos['id']=$id;
		$datos['identificador']="--------";
		$datos['nombre']="--------";
		$datos['sexo']="--------";
		$datos['raza']="--------";
		$datos['edad']="--------";
		$datos['peso']="--------";
		$datos['racion']="--------";
		$datos['turnos']="--------";
		$datos['cooldown']="--------";
		$datos['veces']="--------";
		$datos['ultima']="--------";
	} else {
		$mensaje = null;
	}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" href="css/estilos.css"> -->
	<link rel="stylesheet" href="css/temp.css">
</head>
 
	<body>	
		<div>
			<form>
				<table>
					<tr>
						<td>
						<b>Datos</b>
					</td>
					</tr>
					<tr>
						<td>
							<table>
							<tr>
									<td>#</td>
									<td><?php echo $datos['identificador'];?></td>
								</tr>
								<tr>
									<td>Nombre</td>
									<td><?php echo $datos['nombre'];?></td>
								</tr>
								<tr>
									<td>Código</td>
									<td><?php echo $datos['id'];?></td>
								</tr>
								<tr>
									<td>Sexo</td>
									<td><?php echo $datos['sexo'];?></td>
								</tr>
								<tr>
									<td>Raza</td>
									<td><?php echo $datos['raza'];?></td>
								</tr>
								<tr>
									<td>Edad (aprox)</td>
									<td><?php echo $datos['edad'];?></td>
								</tr>
								<tr>
									<td>Peso</td>
									<td><?php echo $datos['peso'];?>kg</td>
								</tr>
								<tr>
									<td>Ración diaria</td>
									<td><?php echo $datos['racion'];?>g</td>
								</tr>
								<tr>
									<td>Turnos diarios</td>
									<td><?php echo $datos['turnos'];?></td>
								</tr>
								<tr>
									<td>Tiempo de espera</td>
									<td><?php echo $datos['cooldown'];?>hs</td>
								</tr>
								<tr>
									<td>Veces que ya comió</td>
									<td><?php echo $datos['veces'];?></td>
								</tr>
								<tr>
									<td>Última comida</td>
									<td><?php echo $datos['ultima'];?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<p style="color:red;"><?php echo $mensaje;?></p>
	</body>
</html>