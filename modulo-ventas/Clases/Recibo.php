<?php 
	class Recibo{

		public static function ListarRecibos(){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="call ListarRecibos();";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ListarReciboID(){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="SELECT TipoComprobante,idSerie,Correlativo FROM comprobante WHERE Estado='Pendiente';";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ObtenerDatos($NroDocumento,$tip){
			require("../".$tip."MRecursosHumanos/includes/config.php");
			$sql="call ObtenerDatosDeuda(?)";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $NroDocumento);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ObtenerDatosDevolucion($NroDocumento,$tip){
			require("../".$tip."MRecursosHumanos/includes/config.php");
			$sql="call ObtenerDatosDeuda(?)";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $NroDocumento);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ObtenerCliente($NroDocumento,$tip){
			require("../".$tip."MRecursosHumanos/includes/config.php");
			$sql="SELECT cl.NroDocumento as nro,cl.NombreCliente as cli FROM comprobante c INNER JOIN cliente cl ON c.NroDocCliente=cl.NroDocumento  WHERE (CONCAT(c.TipoComprobante,'-',c.idSerie,'-',c.Correlativo)) =?;";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $NroDocumento);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function AgregarDetalle($idProd,$Obsv,$NroComp,$VProd){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="call InsertarDetallito2(?,?,?,?);";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $idProd);
			$query->bindParam(2, $Obsv);
			$query->bindParam(3, $NroComp);
			$query->bindParam(4, $VProd);
			$list=$query -> execute();
			if(!$list){
				return 'Error al grabar observacion';	
			}
		}

		public static function ElimTodoDetalle (){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="DELETE FROM detallitos";
			$query = $dbh->prepare($sql);
			$query -> execute();
		}

		public static function EliminarDetalle($idDet){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="DELETE FROM detallitos WHERE idDetallitos=?;";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $idDet);
			$list=$query -> execute();
			if(!$list){
				return 'Error al eliminar observacion';	
			}
		}

		public static function InsertarDevolucion($NroComp){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="call InsertarDevolucion(?)";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $NroComp,PDO::PARAM_STR,20);
			$query -> execute();
			if(!$list){
				return 'Error al grabar la devolucion';	
			}else{
				return 'Se realizo con exito la operacion';	
			}
		}

		public static function TodosDetalles($tip){
			require("../".$tip."MRecursosHumanos/includes/config.php");
			$sql="SELECT * FROM detallitos;";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ObtenerDetalle($NroDocumento,$tip){
			require("../".$tip."MRecursosHumanos/includes/config.php");
			$sql="SELECT p.nomProd AS nomPro, d.Cantidad AS VCant, d.PrecioVenta AS VPre
					FROM detalleComprobante d INNER JOIN Producto p
					ON d.idProd=p.idProd
					WHERE (CONCAT(d.TipoComprobante,'-',d.idSerie,'-',d.Correlativo)) = ?;";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $NroDocumento);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}


		public static function InsertarRecibo($Compb,$Fechoto,$Pagado,$Totalo){
			
	       	require("../MRecursosHumanos/includes/config.php");
			$sql="call InsertarRecibo(?,?,?,?);";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $Compb);
			$query->bindParam(2, $Fechoto);
			$query->bindParam(3, $Pagado);
			$query->bindParam(4, $Totalo);
			$listas=$query -> execute();
			if($listas==1) return 'Se ingreso el recibo correctamente';
			else return 'Hubo problemas con el guardado del recibo';
		}


	}
?>

