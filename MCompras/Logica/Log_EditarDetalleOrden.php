<?php 
	session_start();
	require('Conexion.php');
	$orden = $_POST['orden'];
	//$producto = $_SESSION['idProducto'];
	$cantidad = $_POST['cantidad'];
	$precio = $_POST['precio'];
	
	if($cantidad == '' or $precio ==''){
		echo "<script>
			alert('Ingrese los datos completos');
			window.location='../Ordenes de Compra/EditarDetalleOrdenCompra.php?idorden=".$orden."&idproducto=".$_SESSION['idProducto']."';
			</script>";	
	}else{
		// $Consulta1 = "call proc_buscar_Proveedor_Repetido('".$nombre."','".$direccion."','".$ruc."')";
		// $result1 = mysqli_query($Conexion,$Consulta1);
		//if(mysqli_num_rows($result1)==0){
		//require('Conexion.php');
		$Consulta ="update `detalleingreso` set `cantidad`=".$cantidad.",`precio`=".$precio." where idIngreso =".$orden." AND idProd=".$_SESSION['idProducto']."";
		//mysqli_free_result($Conexion);
		$result=mysqli_query($Conexion,$Consulta);
		if($result){
			echo "<script>
			alert('Los datos del detalle se actualizaron correctamente');
			window.location='../Ordenes de Compra/VerDetalleOrdenCompra.php?idorden=".$orden."&idproducto=".$_SESSION['idProducto']."';
			</script>";
		}else{
			echo "<script>
			alert('Los datos del detalle no se actualizaron');
			window.location='../Ordenes de Compra/EditarDetalleOrdenCompra.php?idorden=".$orden."&idproducto=".$_SESSION['idProducto']."';
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