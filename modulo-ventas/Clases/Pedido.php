<?php 
	class Pedido{

		public static function ListarPedidos(){
			include("../../MRecursosHumanos/includes/config.php");
			$sql="	SELECT FechaPedido,Departamento, Provincia,Distrito,Direccion,FechaEntrega,Estado,PrecioVentaTotal	FROM pedidoVenta";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		public static function InsertarPedido($Depati,$Provati,$Distrati,$Dniti,$Directi,$Fechiti,$Totiti){
			error_reporting(0);
			require("../MRecursosHumanos/includes/config.php");
			require("Comprobante.php");
			$datos=Comprobante::TodosDetalles('');
			$i=0; foreach($datos as $dato){ $i++;}
			if($i==0){ return 'No se ha ingresado ningun producto a comprar';
			}else{
				$sql="call InsertarPedido(?,?,?,?,?,?,?);";
				$query = $dbh->prepare($sql);
				$query->bindParam(1, $Dniti);
				$query->bindParam(2, $Depati);
				$query->bindParam(3, $Provati);
				$query->bindParam(4, $Distrati);
				$query->bindParam(5, $Directi);
				$query->bindParam(6, $Fechiti);
				$query->bindParam(7, $Totiti);
				$listas=$query -> execute();
				if($listas==1) return 'Se ingreso el pedido correctamente';
				else return 'Hubo problemas con el guardado del pedido';
			}
		}

	}

?>

