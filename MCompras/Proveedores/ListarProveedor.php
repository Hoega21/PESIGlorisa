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
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Listar Proveedores</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>RUC</th>
                      <th>Proveedor</th>
                      <th>Dirección</th>
                      <th>Teléfono</th>
                      <th>Ciudad</th>
                      <th>País</th>
                      <th>Correo</th>
                      <th>Estado</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                        //if (isset($_POST['BuscarProveedor'])==false){
                        require ("../Logica/Conexion.php");
                        //$con=mysqli_connect($host,$usuario,$clave,$BaseDatos);
                        //$con->set_charset("utf8");
                        $Consulta2 = "select * from Proveedor where estProveedor='habilitado'";
                        $result2 = mysqli_query($Conexion,$Consulta2);                        
                        while ($row1=mysqli_fetch_row($result2)) {
                        ?>
                        <tr align="center">
                        <td><?php echo $row1[1]; ?></td>
                        <td><?php echo $row1[2]; ?></td>
                        <td><?php echo $row1[3]; ?></td>
                        <td><?php echo $row1[4]; ?></td>
                        <td><?php echo $row1[5]; ?></td>
                        <td><?php echo $row1[6]; ?></td>
                        <td><?php echo $row1[7]; ?></td>
                        <td><?php echo $row1[8]; ?></td>
                        <td><a href="EditarProveedor.php?ruc=<?php echo $row1[1]; ?>">Editar</a></td>
                        <td><a href="../Logica/Log_EliminarProveedor.php?ruc=<?php echo $row1[1]; ?>">Eliminar</a></td>
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