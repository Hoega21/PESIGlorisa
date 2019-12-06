<?php 
	if(isset($_POST['Obser'])){
		include("../Clases/Recibo.php");
		$resultado =Recibo::AgregarDetalle($_POST['idDescrip'],$_POST['Obser'],$_POST['idComp'],$_POST['VProd']);
		echo $resultado; 

	}
	

	if(isset($_POST['idDetallitos'])){
		include("../Clases/Recibo.php");
		$resultado =Recibo::EliminarDetalle($_POST['idDetallitos']);
		echo $resultado; 
    }
?>

