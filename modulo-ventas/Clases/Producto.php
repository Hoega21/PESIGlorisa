<?php 
	class Producto{
		public static function ListarProductos(){
			include("../../MRecursosHumanos/includes/config.php");
			$sql="select * from Producto;";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ObtenerPrecio($idProducto){
			include("../MRecursosHumanos/includes/config.php");
			$sql="select precio from Producto where idProd= ?;";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $idProducto);
			$query -> execute();
			$listas=$query->fetchAll(PDO::FETCH_OBJ);
			foreach($listas as $lista){
				return $lista->precio;
			}
			return 0;
		}
	}

?>	
