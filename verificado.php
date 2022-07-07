<?php
include 'autenticacion.php';
include 'db.php';
$id = null;
if (!empty($_GET['id'])) {
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
if (null == $datos['nombre']) {
	$mensaje = "Este código no está registrado";
	$datos['id'] = $id;
	$datos['identificador'] = "______________________";
	$datos['nombre'] = "______________________";
	$datos['sexo'] = "______________________";
	$datos['raza'] = "______________________";
	$datos['edad'] = "______________________";
	$datos['peso'] = "______________________";
	$datos['racion'] = "______________________";
	$datos['turnos'] = "______________________";
	$datos['cooldown'] = "______________________";
	$datos['veces'] = "______________________";
	$datos['ultimaSalida'] = "______________________";
} else {
	$mensaje = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Verificación</title>
	<?php
	include 'comp/head.php';
	include 'comp/estilos.php';
	?>
</head>

<body>
	<?php
	if ($mensaje != "") { ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<center><span style="margin-right:5px" data-feather="alert-triangle"></span><?php echo $mensaje ?></center>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php
	}
	?>
	<table class="table tabla" id="datos-tabla" data-sorting="true">
		<tr>
			<td><b>#</b></td>
			<td><?php echo $datos['identificador']; ?></td>
		</tr>
		<tr>
			<td><b>Nombre</b></td>
			<td><?php echo $datos['nombre']; ?></td>
		</tr>
		<tr>
			<td><b>Código</b></td>
			<td><?php echo $datos['id']; ?></td>
		</tr>
		<tr>
			<td><b>Sexo</b></td>
			<td><?php echo $datos['sexo']; ?></td>
		</tr>
		<tr>
			<td><b>Raza</b></td>
			<td><?php echo $datos['raza']; ?></td>
		</tr>
		<tr>
			<td><b>Edad (aprox)</b></td>
			<td><?php echo $datos['edad']; ?> </td>
		</tr>
		<tr>
			<td><b>Peso</b></td>
			<td><?php echo $datos['peso']; ?>kg</td>
		</tr>
		<tr>
			<td><b>Ración diaria</b></td>
			<td><?php echo $datos['racion']; ?>g</td>
		</tr>
		<tr>
			<td><b>Turnos diarios</b></td>
			<td><?php echo $datos['turnos']; ?></td>
		</tr>
		<tr>
			<td><b>Tiempo de espera</b></td>
			<td><?php echo $datos['cooldown']; ?> horas</td>
		</tr>
		<tr>
			<td><b>Veces que ya comió</b></td>
			<td><?php echo $datos['veces']; ?></td>
		</tr>
		<tr>
			<td><b>Última comida</b></td>
			<td><?php echo $datos['ultimaEntrada']; ?></td>
		</tr>
	</table>
</body>

</html>