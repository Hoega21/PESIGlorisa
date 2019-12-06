<?php 
	if(isset($_POST['idProducto'])){
		include("Clases/Producto.php");
		$resultado =Producto::ObtenerPrecio($_POST['idProducto']);
		echo $resultado; //haciendo este echo estas respondiendo la solicitud ajax

	}

	if(isset($_POST['CliDni'])){
		include("Clases/Clientes.php");
		$resultado =Clientes::ObtenerCliente($_POST['CliDni']);
		echo $resultado; //haciendo este echo estas respondiendo la solicitud ajax

	}

	if(isset($_POST['TipoCom'])){
		include("Clases/Comprobante.php");
		$resultado =Comprobante::ObtenerCorrelativo("",$_POST['TipoCom']);
		echo $resultado; //haciendo este echo estas respondiendo la solicitud ajax

	}

	if(isset($_POST['LProducto'])){
		include("Clases/Comprobante.php");
		$resultado =Comprobante::AgregarDetalle($_POST['LProducto'],$_POST['ProdDescr'],$_POST['ProCant'],$_POST['ProPre'],$_POST['ProTo']);
		echo 'yap';
	}

	if(isset($_POST['idDetallitos'])){
		include("Clases/Comprobante.php");
		$resultado =Comprobante::EliminarDetalles($_POST['idDetallitos']);
		echo $resultado;
	}

	if(isset($_POST['Totalsito'])){
		include("Clases/Comprobante.php");
        $resultado =Comprobante::InsertarComprobante($_POST['Tipito'],1,$_POST['Serita'],$_POST['Corrito'],$_POST['Dnito'],$_POST['Fechita'],$_POST['Monedita'],$_POST['Totalsito'],$_POST['Paguito']);
		echo $resultado;
	}
	if(isset($_POST['Depati'])){
		include("Clases/Pedido.php");
        $resultado =Pedido::InsertarPedido($_POST['Depati'],$_POST['Provati'],$_POST['Distrati'],$_POST['Dniti'],$_POST['Directi'],$_POST['Fechiti'],$_POST['Totiti']);
		echo $resultado;
	}


	if(isset($_POST['NroComprobantito'])){
		echo "<script>alert('".$_POST['NroComprobantito']."');</script>";		
		include("Clases/Recibo.php");
		$resultado =Recibo::ObtenerDatos($_POST['NroComprobantito'],'');
		echo json_encode($resultado);
	}

	if(isset($_POST['Fechoto'])){
		include("Clases/Recibo.php");
		$resultado =Recibo::InsertarRecibo($_POST['Compb'],$_POST['Fechoto'],$_POST['Pagado'],$_POST['Totalo']);
		echo $resultado;
	}
 ?>
