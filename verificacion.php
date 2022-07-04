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
	<title>Verificación</title>
	<?php
	include 'comp/head.php';
	include 'comp/estilos.php';
	?>
</head>

<body>
	<?php
	include 'comp/menu.php';
	include 'config.php';
	?>
	<h1 class="display-6">Verificación</h1>
	<p id="obtenerUID" hidden></p>

	<div class="btn-toolbar mb-2 mb-md-0">
		<a class="nuevo btn btn-dark btn-sm me-md-2" href="registro.php"><span data-feather="plus"></span> Nuevo</a>
	</div>
	</div>
	<div class="row d-flex justify-content-center">
		<div class="col-md-6">
			<div id="mostrarDatos" class="btn-toolbar mb-2 mb-md-0 table-responsive">
				<table class="table tabla" id="datos-tabla" data-sorting="true">
					<tr>
						<td><b>#</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Nombre</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Código</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Sexo</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Raza</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Edad (aprox)</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Peso</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Ración diaria</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Turnos diarios</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Tiempo de espera</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Veces que ya comió</b></td>
						<td>______________________</td>
					</tr>
					<tr>
						<td><b>Última comida</b></td>
						<td>______________________</td>
					</tr>
					</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<?php
	include 'comp/scripts.php';
	?>
	<script>
		$(document).ready(function() {

			$("#obtenerUID").load("uid.php");
			setInterval(function() {
				$("#obtenerUID").load("uid.php");
			}, 500);
		});
	</script>
	<script>
		var var1 = setInterval(tiempo1, 1000);
		var var2 = setInterval(tiempo2, 1000);
		var idVieja = "";
		clearInterval(var2);

		function tiempo1() {
			var idNueva = document.getElementById("obtenerUID").innerHTML;
			idVieja = idNueva;
			if (idNueva != "") {
				var2 = setInterval(tiempo2, 500);
				mostrarUsuario(idNueva);
				clearInterval(var1);
			}
		}

		function tiempo2() {
			var idNueva = document.getElementById("obtenerUID").innerHTML;
			if (idVieja != idNueva) {
				var1 = setInterval(tiempo1, 500);
				clearInterval(var2);
			}
		}

		function mostrarUsuario(str) {
			if (str == "") {
				document.getElementById("mostrarDatos").innerHTML = "";
				return;
			} else {
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("mostrarDatos").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "verificado.php?id=" + str, true);
				xmlhttp.send();
			}
		}
	</script>
</body>

</html>