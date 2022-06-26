<?php
	include 'db.php';
	$tiempoConsultaUnix = time() - 10800;
	$UIDresultado=$_POST["UIDresultado"];

	$escribirTiempo="<?php $" . "tiempoConsultaUnix='" . $tiempoConsultaUnix . "'?>";
	$escribirUID="<?php $" . "UIDresultado='" . $UIDresultado . "'; " . "echo $" . "UIDresultado;" . " ?>";
	file_put_contents('uid.php',$escribirUID);
	file_put_contents('tiempo.php',$escribirTiempo);
?>