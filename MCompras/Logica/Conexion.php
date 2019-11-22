<?php
	// define('DB_HOSTNAME', 'localhost:3307');
	// define('DB_USERNAME', 'root');
	// define('DB_PASSWORD', '');
	// define('DB_DATABASE', 'compras');
	$DB_HOSTNAME = 'localhost:3306';
	$DB_USERNAME = 'root';
	$DB_PASSWORD = '';
	$DB_DATABASE = 'elms';

	$Conexion = mysqli_connect($DB_HOSTNAME,$DB_USERNAME,$DB_PASSWORD) or die('No se Puede conectar');

	//echo 'Conexion Correcta al servidor<br/>' ;

	mysqli_select_db($Conexion,$DB_DATABASE) or die('No se puede conectar a la base de datos');

	//echo(DB_DATABASE);
 ?>
