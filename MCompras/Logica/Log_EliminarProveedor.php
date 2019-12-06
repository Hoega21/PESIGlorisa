<?php 
	session_start();
	require('Conexion.php');
	$ruc = $_GET['ruc'];

	// $Consulta1 = "call proc_buscar_Proveedor_Repetido('".$nombre."','".$direccion."','".$ruc."')";
	// $result1 = mysqli_query($Conexion,$Consulta1);
	//if(mysqli_num_rows($result1)==0){
	//require('Conexion.php');
	$Consulta ="update Proveedor SET estProveedor='deshabilitado' WHERE rucProveedor = _ruc";
	//mysqli_free_result($Conexion);
	$result=mysqli_query($Conexion,$Consulta);
	if($result){
		echo "<script>
			alert('El proveedor se deshabilito');
			window.location='../Proveedores/ListarProveedor.php';
			</script>";
	}else{
		echo "<script>
			alert('No se realizo la consulta correctamente');
			window.location='../Proveedores/ListarProveedor.php';
			</script>";
	}
	//}else{
	//	echo "<script>
	//		alert('El proveedor ya se encuentra registrado');
	//		window.location='../Proveedores/EditarProveedor.php?ruc=".$ruc."';
	//		</script>";
	//}
	mysqli_close($Conexion);
 ?>