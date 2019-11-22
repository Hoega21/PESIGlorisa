<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');
$idDevoluciones = $_SESSION["idDevoluciones"];
$sql12="select d.TipoComprobante,d.idEmp, d.idSerie, d.Correlativo,d.TotalDevolver,dd.idProd,dd.Cantidad,dd.Observaciones,dd.ValorUnitario,dd.PrecioVenta,dd.IGV from devoluciones d INNER join detalledevoluciones dd on dd.idDevoluciones=d.idDevoluciones where d.idDevoluciones=:idDev";
$query12 = $dbh->prepare($sql12);
$query12->bindParam(':idDev',$idDevoluciones,PDO::PARAM_INT);
$query12->execute();
$resu12=$query12->fetchAll(PDO::FETCH_OBJ);
foreach($resu12 as $re12){
$tipoCom=$re12->TipoComprobante;
$idEmple=$re12->idEmp;
$Correlativo=$re12->Correlativo;
$idSerie=$re12->idSerie;
$TotalDevolver=$re12->TotalDevolver;
}
$sql13="select concat(e.FirstName,' ',e.LastName) as Nombres from tblemployees e where e.id=:idi";
$query13 = $dbh->prepare($sql13);
$query13->bindParam(':idi',$idEmple,PDO::PARAM_INT);
$query13->execute();
$resu13=$query13->fetchAll(PDO::FETCH_OBJ);
foreach($resu13 as $re13){
  $nomEmpleado=$re13->Nombres;
  }

if(isset($_POST['Aprobar'])){

$sql18="select max(c.Correlativo) as max from comprobante c WHERE c.TipoComprobante='07' and c.idSerie=:serie";
$query18 = $dbh->prepare($sql18);
$query18->bindParam(':serie',$idSerie,PDO::PARAM_STR);
$query18->execute();
$resu18=$query18->fetchAll(PDO::FETCH_OBJ);
foreach($resu18 as $re18){
$maxCo=$re18->max;
}
$maxCo1=$maxCo+1;

$sql17="select c.idMoneda,c.NroDocCliente from comprobante c where c.TipoComprobante=:tipoc and c.idSerie=:serie and c.Correlativo=:corre";
$query17 = $dbh->prepare($sql17);
$query17->bindParam(':tipoc',$tipoCom,PDO::PARAM_STR);
$query17->bindParam(':serie',$idSerie,PDO::PARAM_STR);
$query17->bindParam(':corre',$Correlativo,PDO::PARAM_STR);
$query17->execute();
$resu17=$query17->fetchAll(PDO::FETCH_OBJ);
foreach($resu17 as $re17){
$moneda=$re17->idMoneda;
$cliente=$re17->NroDocCliente;
}
$anio = date("Y");
$mes=date("m");
$dia=date("d");
$fecha=$anio.$mes.$dia;

$horas = date("H:i:s");
$tasa1=1.18;
$tas2=0.18;
$precioV=$TotalDevolver/$tasa1;
$igv1=$precioV*$tas2;

$tipoHack1="07";
$estadoHack="Pagado";
$tipoPa="Contado";



$sql15="insert into comprobante VALUES (:tipo,:idEmpleado, :idSerie,:Correlativo,:NroDocCliente,:fecha,:hora,:moneda,:valoVentaTotal,:PrecioVenta,:IGV,:Estado,:TipoPago)";
$query15 = $dbh->prepare($sql15);
$query15->bindParam(':tipo',$tipoHack1,PDO::PARAM_STR);
$query15->bindParam(':idEmpleado',$idEmple,PDO::PARAM_INT);
$query15->bindParam(':idSerie',$idSerie,PDO::PARAM_STR);
$query15->bindParam(':Correlativo',$maxCo1,PDO::PARAM_STR);
$query15->bindParam(':NroDocCliente',$cliente,PDO::PARAM_STR);
$query15->bindParam(':fecha',$fecha,PDO::PARAM_STR);
$query15->bindParam(':hora',$horas,PDO::PARAM_STR);
$query15->bindParam(':moneda',$moneda,PDO::PARAM_INT);
$query15->bindParam(':valoVentaTotal',$precioV,PDO::PARAM_STR);
$query15->bindParam(':PrecioVenta',$TotalDevolver,PDO::PARAM_STR);
$query15->bindParam(':IGV',$igv1,PDO::PARAM_STR);
$query15->bindParam(':Estado',$estadoHack,PDO::PARAM_STR);
$query15->bindParam(':TipoPago',$tipoPa,PDO::PARAM_STR);
$query15->execute();

$contador=1;
foreach($resu12 as $re12){
  $precioo=$re12->PrecioVenta;
  $igv2=$re12->IGV;
  $valorr=$precioo-$igv2;
  $idiPro=$re12->idProd;
  $cc=$re12->Cantidad;
  $vu=$re12->ValorUnitario;
$sql16="insert into detallecomprobante values (:TipoComprobante, :idSerie, :Correlativo, :NroItem, :idProd, :Cantidad, :ValorUnitario, :ValorVenta, :PrecioVenta, :IGV)";
$query16 = $dbh->prepare($sql16);
$query16->bindParam(':TipoComprobante',$tipoHack1,PDO::PARAM_STR);
$query16->bindParam(':idSerie',$idSerie,PDO::PARAM_STR);
$query16->bindParam(':Correlativo',$maxCo1,PDO::PARAM_STR);
$query16->bindParam(':NroItem',$contador,PDO::PARAM_INT);
$query16->bindParam(':idProd',$idiPro,PDO::PARAM_INT);
$query16->bindParam(':Cantidad',$cc,PDO::PARAM_STR);
$query16->bindParam(':ValorUnitario',$vu,PDO::PARAM_STR);
$query16->bindParam(':ValorVenta',$valorr,PDO::PARAM_STR);
$query16->bindParam(':PrecioVenta',$precioo,PDO::PARAM_STR);
$query16->bindParam(':IGV',$igv2,PDO::PARAM_STR);
$query16->execute();
$contador++;
}
    $vala=3;
  $sql98="update Devoluciones set estado=:nu where TipoComprobante=:tipito and idserie=:serie and Correlativo=:Correlativo";
  $query98 = $dbh->prepare($sql98);
  $query98->bindParam(':nu',$vala,PDO::PARAM_INT);
  $query98->bindParam(':tipito',$tipoCom,PDO::PARAM_STR);
    $query98->bindParam(':serie',$idSerie,PDO::PARAM_STR);
  $query98->bindParam(':Correlativo',$Correlativo,PDO::PARAM_STR);
  $query98->execute();
  echo "<script>alert('Datos guardados correctamente');</script>";
  $termina=1;


}

if(isset($_POST['Desaprobar'])){
  $vala=2;
  $sql98="update Devoluciones set estado=:nu where TipoComprobante=:tipito and idserie=:serie and Correlativo=:Correlativo";
  $query98 = $dbh->prepare($sql98);
  $query98->bindParam(':nu',$vala,PDO::PARAM_INT);
  $query98->bindParam(':tipito',$tipoCom,PDO::PARAM_STR);
    $query98->bindParam(':serie',$idSerie,PDO::PARAM_STR);
  $query98->bindParam(':Correlativo',$Correlativo,PDO::PARAM_STR);
  $query98->execute();
  echo "<script>alert('Se guardo su respueta');</script>";
  $termina=1;
}
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/main.css">
  <!-- Custom styles for this page -->
  <link href="../../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="../../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
</head>
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800" align="center">Solicitud de Devolución</h1>
           <div class="card shadow mb-4">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover text-center">
                      <tr>
                        <td>Tipo de Comprobante:</td>
                        <td><?php if($tipoCom==1){echo htmlentities('Factura');} elseif ($tipoCom==3) {
                          echo htmlentities('Boleta');} else{echo htmlentities($tipoCom);} ?></td>
                        <td>Serie:</td>
                        <td><?php echo htmlentities($idSerie); ?></td>
                        <td>Correlativo:</td>
                        <td><?php echo htmlentities($Correlativo); ?></td>
                      </tr>
                      <tr>
                        <td colspan="2">Personal que realizo la solicitud:</td>
                        <td colspan="4"><?php echo htmlentities($nomEmpleado); ?></td>
                      </tr>
                      <tr>
                        <td>Observaciones:</td>
                        <?php
                        foreach($resu12 as $re12){
                         ?>
                        <td colspan="5"><?php echo htmlentities($re12->Observaciones); ?></td>
                      </tr>
                      <tr><td></td>
                      <?php } ?>
                      </tr>
                      <tr>
                        <td colspan="6"> Detalle de la Solicitud</td>
                      </tr>
                      <tr>
                        <td colspan="3">Producto</td>
                        <td>Cantidad</td>
                        <td>Precio</td>
                        <td>Total+IGV</td>
                      </tr>
                      <?php foreach($resu12 as $re12){  ?> 
                      <tr>
                        <td colspan="3"><?php 
                          $sql14="select p.nomProd from producto p where p.idProd=:idipro";
                          $query14 = $dbh->prepare($sql14);
                          $query14->bindParam(':idipro',$re12->idProd,PDO::PARAM_INT);
                          $query14->execute();
                          $resu14=$query14->fetchAll(PDO::FETCH_OBJ);
                          foreach($resu14 as $re14){
                          $nomProd=$re14->nomProd;
                          }
                          echo htmlentities($nomProd);  ?></td>
                        <td><?php echo htmlentities($re12->Cantidad); ?></td>
                        <td><?php echo htmlentities($re12->ValorUnitario); ?></td>
                        <td><?php echo htmlentities($re12->PrecioVenta); ?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="4"></td>
                        <td>Total devolver</td>
                        <td><?php echo htmlentities($TotalDevolver); ?></td>
                      </tr>
                   </table>
                   <?php if($termina==1){ }
                   else{ ?>
                   <form method="post">
                   <table class="table table-hover text-center">
                    <tr>
                      <td>
                   <p class="text-center">
                  <button type="submit" name="Aprobar" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Aprobar Solicitud</button>
                  </p>
                </td>
                  <td>
                  <p class="text-center">
                  <button type="submit" name="Desaprobar" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Desaprobar Solicitud</button>
                  </p>
                </td>
                </tr>
                </table>
              </form>
            <?php } ?>
               </div>
              </div>
          </div>
      </div>
     <!-- Bootstrap core JavaScript-->
  <script src="../../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../lib/js/sb-admin-2.min.js"></script>
      <!-- Jquery JS-->
    <script src="../../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../../vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <!--====== Scripts -->
  <script src="../js/jquery-3.1.1.min.js"></script>
  <script src="../js/sweetalert2.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/material.min.js"></script>
  <script src="../js/ripples.min.js"></script>
  <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    $.material.init();
  </script>

</body>
</html>