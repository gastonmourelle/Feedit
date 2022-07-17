<?php
	include 'db.php';
	$tiempoConsultaUnix = time() - 10800;
	$UIDresultado=$_POST["UIDresultado"];
	$situacion=$_POST["situacion"];

	$escribirTiempo="<?php $" . "tiempoConsultaUnix='" . $tiempoConsultaUnix . "'?>";
	$escribirUID="<?php $" . "UIDresultado='" . $UIDresultado . "'; " . "echo $" . "UIDresultado;" . " ?>";
	$escribirsituacion="<?php $" . "situacion='" . $situacion . "'; " . "echo $" . "situacion;" . " ?>";
	
	file_put_contents('tiempo.php',$escribirTiempo);
	file_put_contents('uid.php',$escribirUID);
	file_put_contents('situacion.php',$escribirsituacion);
?>