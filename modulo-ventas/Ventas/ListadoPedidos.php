<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5" >
  <?php include("../Clases/Pedido.php"); 
   $pedidos=Pedido::ListarPedidos(); ?>
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Listar Pedidos</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
               <br>

              <div class="table-responsive" id="Tablita">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Empleado</th>
                      <th>Departamento</th>
                      <th>Provincia</th>
                      <th>Distrito</th>
                      <th>Direccion</th>
                      <th>Estado</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Fecha</th>
                      <th>Departamento</th>
                      <th>Provincia</th>
                      <th>Distrito</th>
                      <th>Direccion</th>
                      <th>Fecha Entrega</th>
                      <th>Estado</th>
                      <th>Total</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($pedidos as $pedido){ ?>
                    <tr>
                      <td><?php echo $pedido->FechaPedido; ?></td>
                      <td><?php echo $pedido->Departamento; ?></td>
                      <td><?php echo $pedido->Provincia; ?></td>
                      <td><?php echo $pedido->Distrito; ?></td>
                      <td><?php echo $pedido->Direccion; ?></td>
                      <td><?php echo $pedido->FechaEntrega; ?></td>
                      <td><?php echo $pedido->Estado; ?></td>
                      <td><?php echo $pedido->PrecioVentaTotal; ?></td>
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