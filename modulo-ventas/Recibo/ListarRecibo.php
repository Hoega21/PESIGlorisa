<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
<?php include("../Clases/Recibo.php");  $recibos=Recibo::ListarRecibos(); ?>
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Listar Recibos</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Fecha Pagado</th>
                      <th>Nro Comprobante</th>
                      <th>Cliente</th>
                      <th>Cantidad Pagada</th>
                      <th>Saldo Pendiente</th>
                                          </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>Fecha Pagado</th>
                      <th>Nro Comprobante</th>
                      <th>Cliente</th>
                      <th>Cantidad Pagada</th>
                      <th>Saldo Pendiente</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($recibos as $recibo){ 
                       $NroComprobante=$recibo->Tipo.'-'.$recibo->Serie.'-'.$recibo->Corr;
                      ?>
                    <tr>
                      <td><?php echo $recibo->Fecha ?></td>
                      <td><?php echo $NroComprobante ?></td>
                      <td><?php echo $recibo->Cliente ?></td>
                      <td><?php echo $recibo->Pagado ?></td>
                      <td><?php echo $recibo->Saldo ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                <br>
                 <a  class="btn btn-danger btn-block" href="Recibo.php" >Nuevo Recibo</a>
    
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