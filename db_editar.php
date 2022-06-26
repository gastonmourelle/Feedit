<?php
    include 'db.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
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
        $ultima = $_POST['ultima'];
         
        $pdo = Base::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE perros  set nombre = ?, sexo =?, raza =?, edad =?, peso =?, racion =?, turnos =?, cooldown =?, veces =?, ultima =? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($nombre,$sexo,$raza,$edad,$peso,$racion,$turnos,$cooldown,$veces,$ultima,$id));
		Base::disconnect();
		header("Location: inicio.php");
    }
?>