<?php 
	session_start();
	require('Conexion.php');
	$ordencompra = $_POST['ordencompra'];
	$producto = $_POST['producto'];
	$cantidad = $_POST['cantidad'];
	$precio = $_POST['precio'];
	$totaldetalle = $cantidad*$precio;




	if($producto == '' or $cantidad == '' or $precio == ''){
		echo "<script>
				alert('Ingrese los datos completos');
				window.location='../Ordenes de Compra/AgregarProductos.php?idcodigo=".$ordencompra."';
				</script>";		
	}else{
		$Consulta1 = "call proc_buscar_Producto_Repetido(".$ordencompra.",".$producto.")";
		$result1 = mysqli_query($Conexion,$Consulta1);
		if(mysqli_num_rows($result1)==0){
			//mysqli_free_result($Conexion);
			require('Conexion.php');
			$Consulta ="call proc_agregar_producto(".$ordencompra.",".$producto.",".$cantidad.",".$precio.")";			
			$result=mysqli_query($Conexion,$Consulta);
			if($result){				
				// $Consulta2="call proc_actualizar_total_ordencompra(".$ordencompra.",".$totaldetalle.")";
				// $result=mysqli_query($Conexion,$Consulta2);
				echo "<script>
				alert('Los datos del producto se agregaron correctamente');
				window.location='../Ordenes de Compra/AgregarProductos.php?idcodigo=".$ordencompra."';
				</script>";
			}else{
				echo "<script>
				alert('Los datos del producto no se agregaron');
				window.location='../Ordenes de Compra/AgregarProductos.php?idcodigo=".$ordencompra."';
				</script>";
			}
		}else{
			echo "<script>
				alert('El producto ya se encuentra agregado a la orden de compra');
				window.location='../Ordenes de Compra/AgregarProductos.php?idcodigo=".$ordencompra."';
				</script>";
		}		
	}
	mysqli_close($Conexion);
 ?>