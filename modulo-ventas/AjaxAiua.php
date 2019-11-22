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
		echo 'yap';
	}
 ?>