<?php 

define('DB_HOST','sql10.freesqldatabase.com');
define('DB_USER','sql10313127');
define('DB_PASS','ruVDugdGr1');
define('DB_NAME','sql10313127');

try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>