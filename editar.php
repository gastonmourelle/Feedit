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
?>

<!DOCTYPE html>
<html lang="es">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" href="css/estilos.css"> -->
		<link rel="stylesheet" href="css/temp.css">
		<title>Editar:</title>
	</head>

	<body>
		<div>
			<div>
				<div>
					<h1>Editar datos</h1>
					<p id="porDefecto" hidden><?php echo $datos['sexo'];?></p>
				</div>
		 
				<form action="db_editar.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
					<div>
						<label>Código</label>
						<div>
							<input name="id" type="text"  placeholder="" value="<?php echo $datos['id'];?>" readonly>
						</div>
					</div>
					
					<div>
						<label>Nombre</label>
						<div>
							<input name="nombre" type="text"  placeholder="" value="<?php echo $datos['nombre'];?>" required>
						</div>
					</div>
					
					<div>
						<label>Sexo</label>
						<div>
							<select name="sexo" id="selSexo">
								<option value="Macho">Macho</option>
								<option value="Hembra">Hembra</option>
							</select>
						</div>
					</div>
					
					<div>
						<label>Raza</label>
						<div>
							<input name="raza" type="text" placeholder="" value="<?php echo $datos['raza'];?>" required>
						</div>
					</div>

					<div>
						<label>Edad (aprox)</label>
						<div>
							<input name="edad" type="number" placeholder="" value="<?php echo $datos['edad'];?>" required>
						</div>
					</div>
					
					<div>
						<label>Peso (kg)</label>
						<div>
							<input name="peso" type="number"  placeholder="" value="<?php echo $datos['peso'];?>" required>
						</div>
					</div>

					<div>
						<label>Ración diaria (g)</label>
						<div>
							<input name="racion" type="number"  placeholder="" value="<?php echo $datos['racion'];?>" required>
						</div>
					</div>

					<div>
						<label>Turnos diarios</label>
						<div>
							<input name="turnos" type="number"  placeholder="" value="<?php echo $datos['turnos'];?>" required>
						</div>
					</div>

					<div>
						<label>Tiempo de espera (hs)</label>
						<div>
							<input name="cooldown" type="number"  placeholder="" value="<?php echo $datos['cooldown'];?>" required>
						</div>
					</div>

					<div>
						<label>Veces que ya comió</label>
						<div>
							<input name="veces" type="number"  placeholder="" value="<?php echo $datos['veces'];?>" required>
						</div>
					</div>

					<div>
						<label>Última comida</label>
						<div>
							<input name="ultimaSalida" type="date"  placeholder="" value="<?php echo $datos['ultimaSalida'];?>" required>
						</div>
					</div>

					<div>
						<button type="submit">Actualizar</button>
						<a href="inicio.php">Volver</a>
					</div>
				</form>
			</div>               
		</div>
		
		<script>
			var g = document.getElementById("porDefecto").innerHTML;
			if(g=="Macho") {
				document.getElementById("selSexo").selectedIndex = "0";
			} else {
				document.getElementById("selSexo").selectedIndex = "1";
			}
		</script>
	</body>
</html>
