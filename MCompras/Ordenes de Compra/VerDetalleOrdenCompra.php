<?php 
  session_start();
  $orden = $_GET['idorden'];
  $_SESSION['idorden'] = $orden;
  $nomproveedor = $_GET['proveedor'];
  $_SESSION['proveedor'] = $nomproveedor;
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Detalle de Orden de Compra Nº <?php echo $orden ?></i></h1>
          <br>
          <form action="../Logica/Log_EnviarOrdenCompra.php" method="POST" class="form-horizontal">
            <div class="row form-group">
              <div class="col col-md-3">
                <label for="text-input" class=" form-control-label">Proveedor: </label>
              </div>
              <div class="col col-md-3">
                <label for="text-input" class=" form-control-label"><?php echo $nomproveedor; ?></label>
              </div>              
            </div>

           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Monto</th>
                     
                      <th>Enviar</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                        //if (isset($_POST['BuscarProveedor'])==false){
                        require ("../Logica/Conexion.php");
                        //$con=mysqli_connect($host,$usuario,$clave,$BaseDatos);
                        //$con->set_charset("utf8");
                        $Consulta2 = "select * from detalleingreso where Ingreso_idIngreso='".$orden."'";
                        $result2 = mysqli_query($Conexion,$Consulta2);                        
                        while ($row1=mysqli_fetch_row($result2)) {
                        ?>
                        <tr align="center">
                        <td><?php
                          $Consulta3 = "select nomProd from Producto where idProd=".$row1[2]."";
                          $result3=mysqli_query($Conexion,$Consulta3);
                          $row2=mysqli_fetch_row($result3);
                          echo $row2[0]; 
                        ?></td>
                        <td><?php echo $row1[3]; ?></td>
                        <td><?php echo $row1[4]; ?></td>
                        <td><?php
                          //$total = $row1[3]*$row1[4];
                          $monto = number_format($row1[3]*$row1[4], 2, ',', ' ');
                         echo $monto; 

                        ?></td>

                        <td><a href="EditarDetalleOrdenCompra.php?idorden=<?php echo $orden; ?>&idproducto=<?php echo $row1[2]?>">Editar</a></td>
                        </tr>
                        <?php            
                        }
                        mysqli_close($Conexion);
                      ?>
                  </tbody>                  
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Enviar</button>
          </div>
        </form>
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
