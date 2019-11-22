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

		public static function AgregarCliente($VTipo,$VDNI,$VNombre,$VCorreo,$VCelular,$VDireccion){
			$VDNI=trim($VDNI);$VNombre=trim($VNombre);$VCorreo=trim($VCorreo);$VCelular=trim($VCelular);$VDireccion=trim($VDireccion);
 			if(is_numeric($VDNI)){
				if(strlen($VDNI)!=8 and $VTipo=='PN'){ echo "<script>alert('El DNI consta de 8 digitos');</script>";
	            }else{
	                if(strlen($VDNI)!=11 and $VTipo=='PJ'){ echo "<script>alert('El RUC consta de 11 digitos');</script>";
	                }else{
	                	$Tip='1'; if($VTipo=='PJ'){$Tip='2';}
	                	require("../../MRecursosHumanos/includes/config.php");
						$sql="call AgregarCliente(?,?,?,?,?,?);";
						$query = $dbh->prepare($sql);
						$query->bindParam(1, $VDNI);
						$query->bindParam(2, $Tip);
						$query->bindParam(3, $VNombre);
						$query->bindParam(4, $VCelular);
						$query->bindParam(5, $VDireccion);
						$query->bindParam(6, $VCorreo);
						$query -> execute();
						echo "<script>alert('Cliente ingresado con exito');</script>";
	                }
	            }
 			}
 			else{echo "<script>alert('Solo se ingresa numeros en el documento del cliente');</script>";
 			}
 		
		}


	}
?>