<?php 
	class Moneda{

		public static function ListarMonedas(){
			include("../../MRecursosHumanos/includes/config.php");
			$sql="select * from moneda;";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}


	}

?>