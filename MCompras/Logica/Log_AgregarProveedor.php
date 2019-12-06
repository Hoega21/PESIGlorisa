<?php 
	session_start();
	require('Conexion.php');
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$ruc = $_POST['ruc'];
	$telefono = $_POST['telefono'];
	$ciudad = $_POST['ciudad'];
	$pais = $_POST['pais'];
	$correo = $_POST['correo'];

	if($nombre == '' or $direccion == '' or $ruc == '' or $telefono == '' or $ciudad == '' or $pais == '' or $correo ==''){
		echo "<script>
				alert('Ingrese los datos completos');
				window.location='../Proveedores/AgregarProveedor.php';
				</script>";		
	}else{
		$Consulta1 = "select * Proveedor where (nomProveedor ='".$nombre."' or dirProveedor= '".$direccion."' or rucProveedor ='".$ruc."')";
		$result1 = mysqli_query($Conexion,$Consulta1);
		if(mysqli_num_rows($result1)==0){
			//mysqli_free_result($Conexion);
			require('Conexion.php');
			$Consulta ="insert into Proveedor(rucProveedor, nomProveedor, dirProveedor, telProveedor, ciuProveedor, paiProveedor, corProveedor,estProveedor) values ('".$ruc."','".$nombre."','".$direccion."','".$telefono."','".$ciudad."','".$pais."','".$correo."','habilitado')";			
			$result=mysqli_query($Conexion,$Consulta);
			if($result){
				echo "<script>
				alert('Los datos del proveedor se registraron correctamente');
				window.location='../Proveedores/AgregarProveedor.php';
				</script>";
			}else{
				echo "<script>
				alert('Los datos del proveedor no se registraron');
				window.location='../Proveedores/AgregarProveedor.php';
				</script>";
			}
		}else{
			echo "<script>
				alert('El proveedor ya se encuentra registrado');
				window.location='../Proveedores/AgregarProveedor.php';
				</script>";
		}		
	}
	mysqli_close($Conexion);
 ?>