<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" href="css/estilos.css"> -->
		<link rel="stylesheet" href="css/temp.css">
		<script src="jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				 $("#obtenerUID").load("uid.php");
				setInterval(function() {
					$("#obtenerUID").load("uid.php");	
				}, 500);
			});
		</script>
		
		<title>Verificación</title>
	</head>
	
	<body>
		<ul>
			<li><a href="inicio.php">Inicio</a></li>
			<li><a href="registro.php">Registro</a></li>
			<li><a href="verificacion.php">Verificación</a></li>
		</ul>
		<div>
					<h1>Verificación</h1>
				</div>
		<p id="obtenerUID" hidden></p>
		
		<div id="mostrarDatos">
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
									<td>--------</td>
								</tr>
								<tr>
									<td>Nombre</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Código</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Sexo</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Raza</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Edad (aprox)</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Peso</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Ración diaria</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Turnos diarios</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Tiempo de espera</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Veces que ya comió</td>
									<td>--------</td>
								</tr>
								<tr>
									<td>Última comida</td>
									<td>--------</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>

		<script>
			var var1 = setInterval(tiempo1, 1000);
			var var2 = setInterval(tiempo2, 1000);
			var idVieja="";
			clearInterval(var2);

			function tiempo1() {
				var idNueva=document.getElementById("obtenerUID").innerHTML;
				idVieja=idNueva;
				if(idNueva!="") {
					var2 = setInterval(tiempo2, 500);
					mostrarUsuario(idNueva);
					clearInterval(var1);
				}
			}
			
			function tiempo2() {
				var idNueva=document.getElementById("obtenerUID").innerHTML;
				if(idVieja!=idNueva) {
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
					xmlhttp.open("GET","verificado.php?id="+str,true);
					xmlhttp.send();
				}
			}
		</script>
	</body>
</html>