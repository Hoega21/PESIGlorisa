<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
  <?php include("../Clases/Comprobante.php");  
    if (isset($_GET['NroComp'])) {
      $NroComp=$_GET['NroComp'];
       $NroComp=substr($NroComp,1,12);
       echo $NroComp;
      $cabecera=Comprobante::ListarCabecera($NroComp);
      $detalle=Comprobante::ListarDetalles($NroComp);
    }
  ?>

    <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Comprobante</i></h1>
          <br>
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                <?php foreach($cabecera as $cab){ ?>
                      <div class="form-group row">
                      <label for="NameUser" class="col-sm-12 col-form-label" >Nro Comprobante: <?php echo ' '.$NroComp; ?> </label>
                    </div>
                    <div class="form-group row">
                        <label for="CliNom" class="col-sm-12 col-form-label" name="LCliNom" id="LCliNom">NroCliente:  <?php echo ' '.$cab->NroDocCliente; ?> </label>
                    </div>
                    <div class="form-group row" >
                        <label for="CliNom" class="col-sm-12 col-form-label" name="LComFecha" id="LComFecha">Fecha Emision:<?php echo ' '.$cab->FechaEmision; ?> </label>
                    </div>
                     <div class="form-group row" >
                        <label for="CliNom" class="col-sm-12 col-form-label" name="LCliNom" id="LCliNom">Moneda: <?php echo ' '.$cab->idMoneda; ?>  </label>
                    </div>
                     <div class="form-group row" >
                        <label for="CliNom" class="col-sm-12 col-form-label" name="LComFecha" id="LComFecha">Tipo Pago: <?php echo ' '.$cab->TipoPago; ?> </label>
                    </div>
                    <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LComFecha" id="LComFecha">Estado: <?php echo ' '.$cab->Estado; ?> </label>
                    </div>     
                    <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LComFecha" id="LComFecha">Valor Venta Total: <?php echo ' '.$cab->ValorVentaTotal; ?> </label>
                    </div>  
                    <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LComFecha" id="LComFecha">IGV total <?php echo ' '.$cab->FechaEmision; ?> </label>
                    </div>  <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LComFecha" id="LComFecha">Precio Venta Total: <?php echo ' '.$cab->PrecioVentaTotal; ?> </label>
                    </div>      
                <?php } ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                       <th>Nro Item</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Valor Unitario</th>
                      <th>Valor Venta</th>
                      <th>Precio Venta</th>
                      <th>IGV</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                </div>
            </div>
          </div>
        </div>


   <!-- Bootstrap core JavaScript-->
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../lib/js/sb-admin-2.min.js"></script>


</body>
</html>