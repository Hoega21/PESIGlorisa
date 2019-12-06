<!DOCTYPE html>
<html>
<head>
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
  <?php  error_reporting(0); ?>
  <?php include("../Clases/Comprobante.php");  
    if (isset($_GET['NroComp'])) {
      $NroComp=$_GET['NroComp'];
      $NroComp=substr($NroComp,1,15);
      $cabecera=Comprobante::ListarCabecera($NroComp);
      $detalle=Comprobante::ListarDetalle($NroComp);
 
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
                 <?php foreach($cabecera as $cab){  ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: gray; color: white;">
                      <tr> <th>Empresa: Glorisa</th> </tr>
                    </thead>
                    <tbody>
                      <tr><td>Nro Comprobante: <?php echo ' '.$NroComp; ?> </td></tr>
                      <tr><td>Tipo Pago: <?php echo ' '.$cab->Tipo; ?></td></tr>
                      <tr><td>Fecha Emision: <?php echo ' '.$cab->Fecha; ?> </td></tr>
                      <tr><td>Moneda: <?php echo ' '.$cab->monedas; ?> </td></tr>
                    </tbody>
                  </table>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: gray; color: white;">
                      <tr> <th>Cliente: <?php echo ' '.$cab->Namecitos; ?></th> </tr>
                    </thead>
                    <tbody>
                      <tr><td>Nro Documento:  <?php echo ' '.$cab->NroDoc; ?>  </td></tr>
                      <tr><td>Direccion:  <?php echo ' '.$cab->Lugar; ?> </td></tr>
                      <tr><td>Telefono: <?php echo ' '.$cab->Telefonito; ?>  </td></tr>
                    </tbody>
                  </table>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                       <th>Nro Item</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Valor Unitario</th>
                      <th>Valor Venta</th>
                      <th>IGV</th>
                      <th>Precio Venta</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach($detalle as $det){ ?>
                    <tr>
                      <td><?php echo ' '.$i; ?></td>
                      <td><?php echo ' '.$det->productito; ?></td>
                      <td><?php echo ' '.$det->cantidad; ?></td>
                      <td><?php echo ' '.$det->VUni; ?></td>
                      <td><?php echo ' '.$det->VVenta; ?></td>
                      <td><?php echo ' '.$det->IGV; ?></td>
                      <td><?php echo ' '.$det->PrVenta; ?></td>
                    </tr>
                    <?php $i++; }  ?>
                  </tbody>
                </table>
                  <div style="float: right;">
                    <label class="col-sm-12 col-form-label" ><b>Valor Venta Total:</b> <?php echo ' '.$cab->VVenta; ?> </label>
                    <label class="col-sm-12 col-form-label" ><b>IGV total </b><?php echo ' '.$cab->IGV; ?> </label>
                    <label class="col-sm-12 col-form-label" ><b>Precio Venta Total:</b> <?php echo ' '.$cab->VPrecio; ?> </label>
                  </div>
                  
                  <?php } ?>

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