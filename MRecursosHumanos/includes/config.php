<?php

define('DB_HOST','70.38.123.185:3306');
define('DB_USER','wssac_prueba');
define('DB_PASS','qweasdzxc123');
define('DB_NAME','wssac_prueba');

try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
