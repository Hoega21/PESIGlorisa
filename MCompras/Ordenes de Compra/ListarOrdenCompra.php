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
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Listar Ordenes de Compra</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Fecha de Pedido</th>
                      <th>Fecha de Ingreso</th>
                      <th>Estado</th>
                      <th>Total</th>
                      <th>Proveedor</th>
                      <th>Agregar productos</th>
                      <th>Ver Detalle</th>
                      <th>Enviar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                        //if (isset($_POST['BuscarProveedor'])==false){
                        require ("../Logica/Conexion.php");
                        //$con=mysqli_connect($host,$usuario,$clave,$BaseDatos);
                        //$con->set_charset("utf8");
                        $Consulta = "select * from ingreso where estado='orden'";
                        $result = mysqli_query($Conexion,$Consulta);
                        if($result)  {                    
                          while ($row=mysqli_fetch_row($result)) {
                        ?>
                        <tr align="center">
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php
                          $Consulta2 = "select sum(cantidad*precio) from detalleingreso where Ingreso_idIngreso=".$row[0]."";
                          $result2=mysqli_query($Conexion,$Consulta2);                          
                          $row2=mysqli_fetch_row($result2);
                          $Consulta4 = "update `ingreso` SET `totalIngreso`= ".$row2[0]." WHERE idIngreso =".$row[0]."";
                          $result4=mysqli_query($Conexion,$Consulta4);
                          echo $row2[0];                          
                          ?></td>
                        <td><?php 
                            $Consulta3 = "select nomProveedor from Proveedor where idProveedor=".$row[6]."";
                            $result3=mysqli_query($Conexion,$Consulta3);
                            $row3=mysqli_fetch_row($result3);
                            echo $row3[0]; ?>                            
                        </td>
                        <td><a href="AgregarProductos.php?idcodigo=<?php echo $row[0]; ?>">Agregar</a></td>
                        <td><a href="VerDetalleOrdenCompra.php?idorden=<?php echo $row[0]; ?>">Ver Detalle</a></td>
                        <td><a href="../Logica/Log_EnviarOrden.php?ruc=<?php echo $row[1]; ?>">Enviar</a></td>
                        </tr>
                        <?php            
                        }
                        }
                        mysqli_close($Conexion);
                      ?>
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
   <!-- Page level plugins -->
  <script src="../lib/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../lib/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
  <script src="../lib/js/demo/datatables-demo.js"></script>


</body>
</html>
