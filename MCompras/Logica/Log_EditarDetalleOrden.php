<?php 
	session_start();
	require('Conexion.php');
	$orden = $_POST['orden'];
	$producto = $_POST['producto'];
	$cantidad = $_POST['cantidad'];
	$precio = $_POST['precio'];
	
	if($cantidad == '' or $precio ==''){
		echo "<script>
			alert('Ingrese los datos completos');
			window.location='../Ordenes de Compra/EditarDetalleOrdenCompra.php?idorden=".$orden."&idproducto=".$producto."';
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