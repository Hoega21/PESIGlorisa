
<?php 
	class Comprobante{

		public static function ListarComprobantes(){
				require("../../MRecursosHumanos/includes/config.php");
			$sql="SELECT TipoComprobante,idSerie,Correlativo FROM comprobante WHERE Estado='Pendiente';";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ListarCabecera($NroComp){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="call ListarCabecera(?);";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $NroComp);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ListarDetalle($NroComp){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="call ListarDetalles(?);";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $NroComp);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}


		public static function ListarSerie(){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="SELECT * FROM serie;";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ListarComprobanteT(){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="SELECT * FROM comprobante c WHERE (c.TipoComprobante ='01' OR c.TipoComprobante ='03') AND c.Estado='Pagado';";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ListadoComprobantesCompleto(){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="call ListarCompCompletos();";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ObtenerCorrelativo($tip,$tipp){
			require("..".$tip."/MRecursosHumanos/includes/config.php");
			$sql="SELECT c.Correlativo as  Corr from comprobante c WHERE c.TipoComprobante=? ORDER BY c.Correlativo DESC LIMIT 1;";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $tipp);
			$query -> execute();
			$listas=$query->fetchAll(PDO::FETCH_OBJ);
			$corr='00000000';
			foreach($listas as $lista){
				$corr=$lista->Corr;
			}
			$corr=(intval($corr)+1);
			$corr=substr('00000000', 0, 8-strlen($corr)).$corr;
			return $corr;

		}

		public static function AgregarDetalle($idProd,$descr,$cant,$ValorVenta,$Total){
			require("../MRecursosHumanos/includes/config.php");
			$sql="call InsertarDetallito(?,?,?,?,?);";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $idProd);
			$query->bindParam(2, $cant);
			$query->bindParam(3, $descr);
			$query->bindParam(4, $ValorVenta);
			$query->bindParam(5, $Total);
			$query -> execute();
		}


		public static function ElimTodoDetalle (){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="DELETE FROM detallitos";
			$query = $dbh->prepare($sql);
			$query -> execute();
		}

		public static function TodosDetalles($tip){
			require("../".$tip."MRecursosHumanos/includes/config.php");
			$sql="SELECT * FROM detallitos;";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function EliminarDetalles($idDetalle){
			require("../MRecursosHumanos/includes/config.php");
			$sql="DELETE FROM detallitos WHERE idDetallitos=?;";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $idDetalle);
			$listas=$query -> execute();
		}

		public static function InsertarComprobante($TipCom,$eid,$Serie,$Cor,$Cli,$Fecha,$Moneda,$Total,$Pago){
			error_reporting(0);
			require("../MRecursosHumanos/includes/config.php");
			$datos=Comprobante::TodosDetalles('');
			$i=0; foreach($datos as $dato){ $i++;}
			if($i==0){ return 'No se ha ingresado ningun producto a comprar';
			}else{
				$sql="call InsertarComprobante(?,?,?,?,?,?,?,?,?);";
				$query = $dbh->prepare($sql);
				$query->bindParam(1, $TipCom);
				$query->bindParam(2, $eid);
				$query->bindParam(3, $Serie);
				$query->bindParam(4, $Cor);
				$query->bindParam(5, $Cli);
				$query->bindParam(6, $Fecha);
				$query->bindParam(7, $Moneda);
				$query->bindParam(8, $Total);
				$query->bindParam(9, $Pago);
				$listas=$query -> execute();
				if($listas==1) return 'Se ingreso el comprobante correctamente';
				else return 'Hubo problemas con el guardado del comprobante';
			}
		}
	}
?>
