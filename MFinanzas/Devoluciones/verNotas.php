<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');
$corre = $_SESSION["notita"];
$seriesita=$_SESSION["seriesita"];
$sql12="select c.TipoComprobante, c.idEmp,c.idSerie,c.Correlativo,c.NroDocCliente,c.FechaEmision,c.ValorVentaTotal,c.PrecioVentaTotal,c.IGVTotal,c.Estado,c.TipoPago,dc.NroItem,dc.idProd,dc.Cantidad,dc.ValorUnitario,dc.PrecioVenta,dc.PrecioVenta,dc.IGV from comprobante c inner join detalleComprobante dc on dc.TipoComprobante=c.TipoComprobante and dc.idSerie=c.idSerie and dc.Correlativo=c.Correlativo where c.idSerie=:serius and c.Correlativo=:corree and c.TipoComprobante=07";
$query12 = $dbh->prepare($sql12);
$query12->bindParam(':serius',$seriesita,PDO::PARAM_STR);
$query12->bindParam(':corree',$corre,PDO::PARAM_STR);
$query12->execute();

$resu12=$query12->fetchAll(PDO::FETCH_OBJ);
foreach($resu12 as $re12){
$docCliente=$re12->NroDocCliente;
$idEmple=$re12->idEmp;
$fecha=$re12->FechaEmision;
$ValorVT=$re12->ValorVentaTotal;
$PrecioVT=$re12->PrecioVentaTotal;
$igvT=$re12->IGVTotal;
$estadoo=$re12->Estado;
$tipoP=$re12->TipoPago;
}

$sql13="select concat(e.FirstName,' ',e.LastName) as Nombres from tblemployees e where e.id=:idi";
$query13 = $dbh->prepare($sql13);
$query13->bindParam(':idi',$idEmple,PDO::PARAM_INT);
$query13->execute();
$resu13=$query13->fetchAll(PDO::FETCH_OBJ);
foreach($resu13 as $re13){
  $nomEmpleado=$re13->Nombres;
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
          <h1 class="h3 mb-2 text-gray-800" align="center">Nota de Credito</h1>
           <div class="card shadow mb-4">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover text-center">
                      <tr>
                        <td>Tipo de Comprobante:</td>
                        <td>Nota de Credito</td>
                        <td>Serie:</td>
                        <td><?php echo htmlentities($seriesita); ?></td>
                        <td>Correlativo:</td>
                        <td><?php echo htmlentities($corre); ?></td>
                        <td>Fecha</td>
                      </tr>
                      <tr>
                        <td colspan="2">Personal que creo la nota de credito:</td>
                        <td colspan="4"><?php echo htmlentities($nomEmpleado); ?></td>
                        <td><?php echo htmlentities($fecha); ?></td>
                      </tr>
                      <tr>
                        <td colspan="2">Numero de documento del cliente:</td>
                        <td colspan="5"><?php echo htmlentities($docCliente); ?></td>
                      </tr>
                      <tr>
                        <td colspan="7"> Detalle de la Nota de Credito</td>
                      </tr>
                      <tr>
                        <td>N°</td>
                        <td colspan="3">Producto</td>
                        <td>Cantidad</td>
                        <td>Precio</td>
                        <td>Total +igv</td>
                      </tr>
                      <?php foreach($resu12 as $re12){  ?>
                      <tr>
                        <td><?php echo htmlentities($re12->NroItem); ?></td>
                        <td colspan="3"><?php 
                          $sql14="select p.nomProd from Producto p where p.idProd=:idipro";
                          $query14 = $dbh->prepare($sql14);
                          $query14->bindParam(':idipro',$re12->idProd,PDO::PARAM_INT);
                          $query14->execute();
                          $resu14=$query14->fetchAll(PDO::FETCH_OBJ);
                          foreach($resu14 as $re14){
                          $nomProd=$re14->nomProd;
                          }
                         echo htmlentities($nomProd); ?></td>
                        <td><?php echo htmlentities($re12->Cantidad); ?></td>
                        <td><?php echo htmlentities($re12->ValorUnitario); ?></td>
                        <td><?php echo htmlentities($re12->PrecioVenta); ?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="5"></td>
                        <td>Valor de Venta Total</td>
                        <td><?php echo htmlentities($ValorVT); ?></td>
                      </tr>
                      <tr>
                        <td colspan="5"></td>
                        <td>IGV total</td>
                        <td><?php echo htmlentities($igvT); ?></td>
                      </tr>
                      <tr>
                        <td colspan="5"></td>
                        <td>Precio de venta total</td>
                        <td><?php echo htmlentities($PrecioVT); ?></td>
                      </tr>
                   </table>
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