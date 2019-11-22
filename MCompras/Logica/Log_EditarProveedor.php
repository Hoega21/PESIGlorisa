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

	if($nombre == '' or $direccion == '' or $telefono == '' or $ciudad == '' or $pais == '' or $correo ==''){
		echo "<script>
			alert('Ingrese los datos completos');
			window.location='../Proveedores/EditarProveedor.php?ruc=".$ruc."';
			</script>";	
	}else{
		// $Consulta1 = "call proc_buscar_Proveedor_Repetido('".$nombre."','".$direccion."','".$ruc."')";
		// $result1 = mysqli_query($Conexion,$Consulta1);
		//if(mysqli_num_rows($result1)==0){
		//require('Conexion.php');
		$Consulta ="call proc_actualizar_proveedor('".$ruc."','".$nombre."','".$direccion."','".$telefono."','".$ciudad."','".$pais."','".$correo."')";
		//mysqli_free_result($Conexion);
		$result=mysqli_query($Conexion,$Consulta);
		if($result){
			echo "<script>
			alert('Los datos del proveedor se actualizaron correctamente');
			window.location='../Proveedores/ListarProveedor.php';
			</script>";
		}else{
			echo "<script>
			alert('Los datos del proveedor no se actualizaron');
			window.location='../Proveedores/EditarProveedor.php?ruc=".$ruc."';
			</script>";
		}
		//}else{
		//	echo "<script>
		//		alert('El proveedor ya se encuentra registrado');
		//		window.location='../Proveedores/EditarProveedor.php?ruc=".$ruc."';
		//		</script>";
		//}		
	}
	mysqli_close($Conexion);
 ?>