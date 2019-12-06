<?php 
	class Clientes{

		public static function ActualizarCliente($Nombre,$Direccion,$Correo,$NroDocumento){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="update cliente set NombreCliente=?, Direccion= ?, Correo=? where 	NroDocumento = ?";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $Nombre);
			$query->bindParam(2, $Direccion);
			$query->bindParam(3, $Correo);
			$query->bindParam(4, $NroDocumento);
			$listas=$query -> execute();
			if($listas==1) echo "<script>alert('Se actualizo los datos  del cliente correctamente');</script>";
						else echo "<script>alert('Hubo problemas con la actualizacion de datos');</script>";
		}

		public static function ListarClientes(){
			require("../../MRecursosHumanos/includes/config.php");
			$sql="call ListarClientes();";
			$query = $dbh->prepare($sql);
			$query -> execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public static function ObtenerCliente($Nro){
			require("../MRecursosHumanos/includes/config.php");
			$sql="select NroDocumento,NombreCliente from cliente where NroDocumento=?;";
			$query = $dbh->prepare($sql);
			$query->bindParam(1, $Nro);
			$query -> execute();
			$listas=$query->fetchAll(PDO::FETCH_OBJ);
			foreach($listas as $lista){
				return $lista->NombreCliente;
			}
			return 'No se encontro cliente';
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
						$listas=$query -> execute();
						if($listas==1) echo "<script>alert('Se ingreso el cliente correctamente');</script>";
						else echo "<script>alert('Hubo problemas con el guardado del cliente');</script>";
	                }
	            }
 			}
 			else{echo "<script>alert('Solo se ingresa numeros en el documento del cliente');</script>";
 			}
 		
		}


	}
?>