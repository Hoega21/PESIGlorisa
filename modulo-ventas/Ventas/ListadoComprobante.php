<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5" >
  <?php include("../Clases/Comprobante.php"); 
   $comprobantes=Comprobante::ListadoComprobantesCompleto(); ?>
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Listar Comprobantes</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
               <br>

              <div class="table-responsive" id="Tablita">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tipo Comprobante</th>
                      <th>Empleado</th>
                      <th>Nro Comprobante</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th>Moneda</th>
                      <th>Estado</th>
                      <th>Tipo Pago</th>
                      <th>Precio Venta Total</th>
                      <th>Ver Factura</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Tipo Comprobante</th>
                      <th>Empleado</th>
                      <th>Nro Comprobante</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th>Moneda</th>
                      <th>Estado</th>
                      <th>Tipo Pago</th>
                      <th>Precio Venta Total</th>
                      <th>Ver Factura</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($comprobantes as $comprobante){ ?>
                    <tr>
                      <td><?php echo $comprobante->TipoComp; ?></td>
                      <td><?php echo $comprobante->Empleado; ?></td>
                      <td><?php echo $comprobante->NroComp; ?></td>
                      <td><?php echo $comprobante->Fecha; ?></td>
                      <td><?php echo $comprobante->Client; ?></td>
                      <td><?php echo $comprobante->Mone; ?></td>
                      <td style="
                      <?php  if($comprobante->Estado=='Pagado'){ ?>
                        background-color: #dfffe5; 
                        color: #389401;  
                      <?php }else{?> 
                        background-color: #ffd0d2; 
                        color: #9c0007;  
                      <?php } ?> " >
                      <?php echo $comprobante->Estado; ?></td>
                      <td><?php echo $comprobante->Pago; ?></td>
                      <td><?php echo $comprobante->PrecioVent; ?></td>
                      <td><a href="Factura.php?NroComp='<?php echo $comprobante->NroComp; ?>'" class="btn-btn-warning">Ver Factura</a></td>
                    </tr>
                    <?php } ?>
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
   <!-- Page level plugins -->
  <script src="../lib/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../lib/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
  <script src="../lib/js/demo/datatables-demo.js"></script>


</body>
</html>