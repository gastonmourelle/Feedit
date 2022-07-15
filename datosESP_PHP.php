<?php
	include 'db.php';
	$tiempoConsultaUnix = time() - 10800;
	$UIDresultado=$_POST["UIDresultado"];
	$ingreso=$_POST["ingreso"];

	$escribirTiempo="<?php $" . "tiempoConsultaUnix='" . $tiempoConsultaUnix . "'?>";
	$escribirUID="<?php $" . "UIDresultado='" . $UIDresultado . "'; " . "echo $" . "UIDresultado;" . " ?>";
	$escribiringreso="<?php $" . "ingreso='" . $ingreso . "'; " . "echo $" . "ingreso;" . " ?>";
	
	file_put_contents('tiempo.php',$escribirTiempo);
	file_put_contents('uid.php',$escribirUID);
	file_put_contents('ingreso.php',$escribiringreso);
?>