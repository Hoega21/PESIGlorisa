<?php 
	include 'plantilla.php';
	require 'conexion.php';
	$orden = $_GET['idorden'];
	$proveedor = $_GET['proveedor'];
	
	$query = "select * from detalleingreso where idIngreso='".$orden."'";	
	$resultado = $Conexion->query($query);
	$suma = 0;


	
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
	$pdf->Cell(80,6,'ORDEN DE COMPRA NUMERO ',0,0,'L');
	$pdf->Cell(80,6,$orden,0,1,'L');


	$pdf->SetY('70');
	
	$pdf->Cell(70,6,'PRODUCTO',1,0,'C',1);
	$pdf->Cell(30,6,'CANTIDAD',1,0,'C',1);
	$pdf->Cell(30,6,'PRECIO',1,0,'C',1);
	$pdf->Cell(30,6,'MONTO',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$monto = $row['cantidad']*$row['precio'];
		$pdf->Cell(70,6,utf8_decode($row['idProd']),1,0,'C');
		$pdf->Cell(30,6,$row['cantidad'],1,0,'C');
		$pdf->Cell(30,6,$row['precio'],1,0,'C');
		$pdf->Cell(30,6,$monto,1,1,'C');
		$suma = $suma + $monto;
	}
	$pdf->Cell(130,6,'Total',1,0,'C',1);
	$pdf->Cell(30,6,$suma,1,1,'C');

	$pdf->Output();
	$pdf->Output('F','../Reporte de Ordenes de Compra/Reporte Orden de Compra '.$orden.'.pdf');
 ?>