<?php
	include 'db.php';
	$tiempoConsultaUnix = time() - 10800;
	$UIDresultado=$_POST["UIDresultado"];
	$ULTRAresultado=$_POST["ULTRAresultado"];

	$escribirTiempo="<?php $" . "tiempoConsultaUnix='" . $tiempoConsultaUnix . "'?>";
	$escribirUID="<?php $" . "UIDresultado='" . $UIDresultado . "'; " . "echo $" . "UIDresultado;" . " ?>";
	$escribirULTRA="<?php $" . "ULTRAresultado='" . $ULTRAresultado . "'; " . "echo $" . "ULTRAresultado;" . " ?>";
	file_put_contents('uid.php',$escribirUID);
	file_put_contents('tiempo.php',$escribirTiempo);
	file_put_contents('ultrasonido.php',$escribirULTRA);
?>