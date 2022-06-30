<?php
    include 'db.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        $id = $_POST['id'];
         
        $pdo = Base::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM perros  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Base::disconnect();
        header("Location: listado.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->
    <link rel="stylesheet" href="css/temp.css">
	<title>Eliminar</title>
</head>
 
<body>
    <div>
     
		<div>
			<form action="db_borrar.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<p>¿Está seguro que desea eliminar este registro?</p>
				<div>
					<button type="submit">Si</button>
					<a href="listado.php">No</a>
				</div>
			</form>
		</div>
                 
    </div>
  </body>
</html>
