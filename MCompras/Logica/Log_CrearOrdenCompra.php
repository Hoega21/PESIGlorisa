<?php 
	session_start();
	require('Conexion.php');
	$fecha_pedido = $_POST['fecha_pedido'];
	$fecha_ingreso = $_POST['fecha_ingreso'];
	$proveedor = $_POST['proveedor'];
	$idempleado = $_SESSION['MUsuarioid'];

	if($fecha_pedido == '' or $fecha_ingreso == '' or $proveedor == ''){
		echo "<script>
				alert('Ingrese los datos completos');
				window.location='../Ordenes de Compra/CrearOrdenCompra.php';
				</script>";		
	}else{
		//mysqli_free_result($Conexion);
		//require('Conexion.php');
		$Consulta ="call proc_registrar_ingreso('".$fecha_pedido."','".$fecha_ingreso."','orden',0.0,'pendiente',".$idempleado.",".$proveedor.")";
		$result=mysqli_query($Conexion,$Consulta);
		if($result){
		echo "<script>
			alert('Los datos de la orden de compra se registraron correctamente');
			window.location='../Ordenes de Compra/CrearOrdenCompra.php';
			</script>";
		}else{
			echo "<script>
			alert('Los datos de la orden de compra no se registraron');
			window.location='../Ordenes de Compra/CrearOrdenCompra.php';
			</script>";
		}	
	}
	mysqli_close($Conexion);
 ?>