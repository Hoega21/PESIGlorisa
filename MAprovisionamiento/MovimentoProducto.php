<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../modulo-ventas/lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../modulo-ventas/lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Lista de movimientos</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Fecha registro</th>
                      <th>Tipo de movimiento</th>
                      <th>Nombre del producto</th>
                      
                      <th>Entrada</th>
                      <th>Salida</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Fecha registro</th>
                      <th>Tipo de movimiento</th>
                      <th>Nombre del producto</th>
                      
                      <th>Entrada</th>
                      <th>Salida</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   <?php 
                                
                                    require ("../Conexion.php");
                                    $con=mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                    $con->set_charset("utf8");
                                    $res=$con->query("SELECT movimientoalmacen.idMovimiento,movimientoalmacen.fecha,movimientoalmacen.idTipo,Producto.nomProd,movimientoalmacen.cantidad FROM movimientoalmacen INNER JOIN producto on movimientoalmacen.idProd=Producto.idProd ;");
                                    while ($row1=mysqli_fetch_row($res)) {
                    ?>
                                      <tr align="center">
                                      <th><?php echo $row1[0]; ?></th>
                                      <th><?php echo $row1[1]; ?></th>
                                      <th><?php echo $row1[2]; ?></th>
                                      <th><?php echo $row1[3]; ?></th>
                                     
                       <?php                
                                      if ( $row1[2]=='Entrada') {
                       ?> 
                                        <th><?php echo $row1[4]; ?></th>
                                        <th>0</th>
                        <?php 
                                      }else{
                        ?>
                                        <th>0</th>
                                        <th><?php echo $row1[4]; ?></th>
                                        
                        <?php
                                      }
                        ?> 
                                      </tr>
                    <?php            
                                    }
                                    $con->close();
                                
                    ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

   <!-- Bootstrap core JavaScript-->
  <script src="../modulo-ventas/lib/vendor/jquery/jquery.min.js"></script>
  <script src="../modulo-ventas/lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../modulo-ventas/lib/js/sb-admin-2.min.js"></script>
   <!-- Page level plugins -->
  <script src="../modulo-ventas/lib/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../modulo-ventas/lib/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
  <script src="../modulo-ventas/lib/js/demo/datatables-demo.js"></script>


</body>
</html>