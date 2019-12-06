<?php

	$DB_HOSTNAME = '70.38.123.185:3306';
	$DB_USERNAME = 'wssac_prueba';
	$DB_PASSWORD = 'qweasdzxc123';
	$DB_DATABASE = 'wssac_prueba';

	$Conexion = mysqli_connect($DB_HOSTNAME,$DB_USERNAME,$DB_PASSWORD) or die('No se Puede conectar');

	mysqli_select_db($Conexion,$DB_DATABASE) or die('No se puede conectar a la base de datos');

 ?>
