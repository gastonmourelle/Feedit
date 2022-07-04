<?php
include 'autenticacion.php';
include 'db.php';
$identificador = null;
if (!empty($_GET['identificador'])) {
	$identificador = $_REQUEST['identificador'];
}

$pdo = Base::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM perros where identificador = ?";
$q = $pdo->prepare($sql);
$q->execute(array($identificador));
$datos = $q->fetch(PDO::FETCH_ASSOC);
Base::disconnect();
?>

<!DOCTYPE html>
<html lang="es">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Editar datos</title>
	<?php include 'comp/head.php';
	include 'comp/estilos.php' ?>
</head>

<body>
	<?php
	include 'comp/menu.php'; ?>

	<h1 class="display-6">Editar datos</h1>
	<p id="porDefecto" hidden><?php echo $datos['sexo']; ?></p>
	</div>

	<div class="row">
		<div class="col-md-6">
			<form class="row g-3" action="db_editar.php?identificador=<?php echo $identificador ?>" method="POST" enctype="multipart/form-data">
				<div class="textarea input-group flex-nowrap">
					<span class="input-group-text" id="addon-wrapping">Código UID</span>
					<textarea class="form-control" name="id" readonly><?php echo $datos['id']; ?></textarea>
				</div>

				<div class="col-md-6"">
			<label for=" div_refresh" class="form-label">Nombre</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="div_refresh" name="nombre" value="<?php echo $datos['nombre']; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<label class="form-label">Sexo</label>
					<select name="sexo" id="selSexo" class="form-select">
						<option selected disabled></option>
						<option value="Macho">Macho</option>
						<option value="Hembra">Hembra</option>
					</select>
				</div>

				<div class="col-md-7">
					<label for="raza" class="form-label">Raza</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="raza" name="raza" value="<?php echo $datos['raza']; ?>" required>
					</div>
				</div>

				<div class="col-md-3">
					<label for="edad" class="form-label">Edad (aproximada)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="edad" name="edad" value="<?php echo $datos['edad']; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="peso" class="form-label">Peso (kg)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="peso" name="peso" value="<?php echo $datos['peso']; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="racion" class="form-label">Ración diaria (g)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="racion" name="racion" value="<?php echo $datos['racion']; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="turnos" class="form-label">Turnos diarios</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="turnos" name="turnos" value="<?php echo $datos['turnos']; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="cooldown" class="form-label">Tiempo de espera entre turnos (h)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="cooldown" name="cooldown" value="<?php echo $datos['cooldown']; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="veces" class="form-label">Veces que ya comió en el día</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="veces" name="veces" value="<?php echo $datos['veces']; ?>" required>
					</div>
				</div>

				<div class="col-md-6">
					<label for="foto" class="form-label">Foto</label>
					<div class="input-group mb-3">
						<input type="file" class="form-control" id="foto" name="foto" accept="image/*">
					</div>
				</div>
				<div class="d-flex flex-row-reverse">
					<button type="submit" class="btn btn-dark">Actualizar</button>
				</div>
			</form>
		</div>
	</div>


	<?php include 'comp/scripts.php'; ?>
	<script>
		var g = document.getElementById("porDefecto").innerHTML;
		if (g == "Macho") {
			document.getElementById("selSexo").selectedIndex = "1";
		} else {
			document.getElementById("selSexo").selectedIndex = "2";
		}
	</script>
</body>

</html>