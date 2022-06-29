<?php
     
    include 'db.php';
 
	if (!empty($_POST)) {
		
        $identificador = $_POST['identificador'];
        $nombre = $_POST['nombre'];
		$id = $_POST['id'];
		$sexo = $_POST['sexo'];
        $raza = $_POST['raza'];
        $edad = $_POST['edad'];
        $peso = $_POST['peso'];
		$racion = $_POST['racion'];
        $turnos = $_POST['turnos'];
        $cooldown = $_POST['cooldown'];
        $veces = $_POST['veces'];
        $ultimaSalida = $_POST['ultimaSalida'];
        
        $pdo = Base::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO perros (identificador,nombre,id,sexo,raza,edad,peso,racion,turnos,cooldown,veces,ultimaSalida) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE id=id;";
		$q = $pdo->prepare($sql);
		$q->execute(array($identificador,$nombre,$id,$sexo,$raza,$edad,$peso,$racion,$turnos,$cooldown,$veces,$ultimaSalida));
		Base::disconnect();
		header("Location: inicio.php");
    }
?>
