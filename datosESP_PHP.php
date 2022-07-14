<?php
	include 'db.php';
	$tiempoConsultaUnix = time() - 10800;
	$UIDresultado=$_POST["UIDresultado"];
	$ULTRAresultado=$_POST["ULTRAresultado"];
	$PESOresultado=$_POST["PESOresultado"];

	$escribirTiempo="<?php $" . "tiempoConsultaUnix='" . $tiempoConsultaUnix . "'?>";
	$escribirUID="<?php $" . "UIDresultado='" . $UIDresultado . "'; " . "echo $" . "UIDresultado;" . " ?>";
	$escribirULTRA="<?php $" . "ULTRAresultado='" . $ULTRAresultado . "'; " . "echo $" . "ULTRAresultado;" . " ?>";
	$escribirPESO="<?php $" . "PESOresultado='" . $PESOresultado . "'; " . "echo $" . "PESOresultado;" . " ?>";
	
	file_put_contents('tiempo.php',$escribirTiempo);
	file_put_contents('uid.php',$escribirUID);
	file_put_contents('ultrasonido.php',$escribirULTRA);
	file_put_contents('peso.php',$escribirPESO);
?>