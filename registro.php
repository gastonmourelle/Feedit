<?php
include 'autenticacion.php';
$escribir = "<?php $" . "UIDresultado=''; " . "echo $" . "UIDresultado;" . " ?>";
file_put_contents('uid.php', $escribir);
?>

<!DOCTYPE html>
<html lang="es">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" href="css/estilos.css"> -->
	<title>Registro</title>
	<?php include 'comp/head.php';
	include 'comp/estilos.php' ?>
</head>

<body>
	<?php
	include 'comp/menu.php'; ?>

	<h1 class="display-6">Registro</h1>
	</div>

	<div class="row" style="padding:40px">
		<div class="col-md-6">

			<form class="row g-3" action="db_insertar.php" method="POST" enctype="multipart/form-data">

				<?php
				include 'comp/alerts.php';
				?>

				<input id="identificador" name="identificador" type="hidden" placeholder="">

				<div class="textarea input-group flex-nowrap">
					<span class="input-group-text" id="addon-wrapping">Código UID</span>
					<textarea class="form-control" name="id" id="obtenerUID" placeholder="Pase el collar por el lector para detectar el código" required></textarea>
				</div>

				<div class="col-md-6">
					<label for="div_refresh" class="form-label">Nombre</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="div_refresh" name="nombre" placeholder="Introduzca el nombre del perro" required>
					</div>
				</div>

				<div class="col-md-6">
					<label class="form-label">Sexo</label>
					<select name="sexo" class="form-select">
						<option selected disabled></option>
						<option value="Macho">Macho</option>
						<option value="Hembra">Hembra</option>
					</select>
				</div>

				<div class="col-md-7">
					<label for="raza" class="form-label">Raza</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="raza" name="raza" placeholder="Introduzca la raza del perro" required>
					</div>
				</div>

				<div class="col-md-5">
					<label for="edad" class="form-label">Edad (aproximada)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="edad" name="edad" placeholder="" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="peso" class="form-label">Peso (kg)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="peso" name="peso" placeholder="" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="racion" class="form-label">Ración diaria (g)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="racion" name="racion" placeholder="" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="turnos" class="form-label">Turnos diarios</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="turnos" name="turnos" placeholder="" required>
					</div>
				</div>

				<div class="col-md-4">
					<label for="cooldown" class="form-label">Tiempo de espera entre turnos (h)</label>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="cooldown" name="cooldown" placeholder="" required>
					</div>
				</div>

				<div class="col-md-5">
					<label for="ultimaSalida" class="form-label">Fecha de su última comida</label>
					<div class="input-group mb-3">
						<input type="date" class="form-control" id="ultimaSalida" name="ultimaSalida" placeholder="" required>
					</div>
				</div>

				<div class="col-md-6">
					<label for="foto" class="form-label">Foto</label>
					<div class="input-group mb-3">
						<input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
					</div>
				</div>
					<div class="d-flex flex-row-reverse">
						<button type="submit" class="btn btn-dark">Agregar</button>
					</div>
			</form>

		</div>
	</div>



	<?php include 'comp/scripts.php'; ?>
	<script>
		$(document).ready(function() {

			setTimeout(function() {
				$(".alert").alert('close');
			}, 4000);

			$("#obtenerUID").load("uid.php");
			setInterval(function() {
				$("#obtenerUID").load("uid.php");
			}, 500);
		});
	</script>
</body>

</html>