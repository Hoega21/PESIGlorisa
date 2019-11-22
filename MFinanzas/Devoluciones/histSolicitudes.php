<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');

$sql12="select* from Devoluciones";
$query12 = $dbh->prepare($sql12);
$query12->execute();
$resu12=$query12->fetchAll(PDO::FETCH_OBJ);

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
<body style="background-color: #e5e5e5" >
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Historial de Solicitudes de Devoluciones</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
               <br>

              <div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th>Numero</th>
                      <th>TipoComprobante</th>
                      <th>TotalDevolver</th>
                      <th>Ver solicitud</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Numero</th>
                      <th>TipoComprobante</th>
                      <th>TotalDevolver</th>
                      <th>Estado</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    if($query12->rowCount() > 0){
                       foreach($resu12 as $re12){
                    ?>
                    <tr>
                      <td><?php echo htmlentities($re12->idDevoluciones);?></td>
                      <td><?php echo htmlentities($re12->TipoComprobante);?></td>
                      <td><?php echo htmlentities($re12->TotalDevolver);?></td>
                      <td><?php 
                      $varci=$re12->Estado;
                      if($varci==1){
                       echo htmlentities("pendiente"); }
                       else if($varci==2){
                        echo htmlentities("desaprobada");
                       }
                       else{
                        echo htmlentities("aprobada");
                       } ?></td>
                    </tr>
                  <?php  }  } ?>
                  </tbody>
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
