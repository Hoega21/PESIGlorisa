<?php 
	class Pedido{

		public static function ListarPedidos(){
			include("../../MRecursosHumanos/includes/config.php");
			$sql="	SELECT FechaPedido,Departamento, Provincia,Distrito,Direccion,FechaEntrega,Estado,PrecioVentaTotal	FROM pedidoVenta";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}


	}

?>