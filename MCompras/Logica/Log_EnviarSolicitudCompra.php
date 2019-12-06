<?php
	session_start();
	include 'plantilla.php';
	require 'Conexion.php';
	$solicitud = $_SESSION['idsolicitud'];
	$proveedor = $_POST['proveedor'];
	$correo = $_SESSION['corproveedor'];
	
	$query = "select p.nomProd,ps.cantidad from producto_has_solicitud ps, Producto p where ps.idSolicitud=".$solicitud." AND ps.idProd = p.idProd";	
	$resultado = $Conexion->query($query);

	
	$pdf = new PDF('P','mm','A4');
	$pdf->SetMargins(25, 20 , 30);

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);

	$pdf->Cell(30,6,'PROVEEDOR: ',0,0,'L');
	$pdf->MultiCell(100,6,$proveedor,0,'L',0);
	$y=$pdf->gety();
	$pdf->SetY($y+5);
	$pdf->Cell(100,6,'SOLICITUD DE COMPRA NUMERO ',0,0,'L');
	$pdf->Cell(80,6,$solicitud,0,1,'L');


	$pdf->SetY('70');
	
	$pdf->Cell(100,6,'PRODUCTO',1,0,'C',1);
	$pdf->Cell(60,6,'CANTIDAD',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(100,6,$row['nomProd'],1,0,'C');
		$pdf->Cell(60,6,$row['cantidad'],1,1,'C');
		//$pdf->Cell(60,6,$correo,1,1,'C');
	}

	$pdf->Output();
	$pdf->Output('F','../Reporte de Solicitud de Compra/Solicitud de Compra '.$solicitud.'.pdf');

	/*use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../lib/phpmailer/src/Exception.php';
	require '../lib/phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer();
	$mail->From = 'javier_40_2@hotmail.com';
	$mail->FromName = 'Javier Beltrán';
	$mail->Subject = 'Allegato in PDF';
	$mail->Body = 'Se adjunta el reporte en pdf';
	$mail->AddAddress($correo);
	 
	// definiendo el adjunto 
	$mail->AddStringAttachment($doc, '../Reporte de Solicitud de Compra/Solicitud de Compra '.$solicitud.'.pdf', 'base64', 'application/pdf');
	// enviando
	$mail->Send(); */

?>