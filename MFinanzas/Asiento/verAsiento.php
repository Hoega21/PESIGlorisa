<?php
session_start();
error_reporting(0);
$id=intval($_GET['id']);
include('../../MRecursosHumanos/includes/config.php');

$sql4="select t.id, t.codSubCuenta,c.descripcion,t.debe,t.haber from tMovimiento t INNER join subcuenta c on c.codSubCuenta=t.codSubCuenta where nroAsiento=:numas";
$query5 = $dbh->prepare($sql4);
$query5->bindParam(':numas',$id,PDO::PARAM_INT);
$query5->execute();
$r21=$query5->fetchAll(PDO::FETCH_OBJ);
$c=1;


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
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800" align="center">Asiento</h1>
          <br>
          
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead >
                      <tr>
                        <td colspan="2"> CUENTA CONTABLE</td>
                        <td colspan="2"> MOVIMIENTO</td>
                      </tr>
                      <tr>
                        <td>Codigo</td>
                        <td>Cuenta-Subcuenta</td>
                        <td>Debe</td>
                        <td>Haber</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($r21 as $r22)
                            { 
                              $id1=$r22->id;
                            	$codSubCuenta1=$r22->codSubCuenta;
                            	$descripcion1=$r22->descripcion;
                            	$debe1=$r22->debe;
                            	$haber1=$r22->haber;
                            	$datos=$id1."||".$codSubCuenta1."||".$descripcion1."||".$debe1."||".$haber1;
                            	?>
                                <tr>
                                  <td><?php echo htmlentities($r22->codSubCuenta);?></td>
                                  <td><?php echo htmlentities($r22->descripcion);?></td>
                                  <td><?php echo htmlentities($r22->debe);?></td>
                                  <td><?php echo htmlentities($r22->haber);?></td>
                                </tr><?php $c++;} ?>
                    </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>



  <!-- MODAL -->
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <h4 class="modal-title" id="myModalLabel" align="center">Actualizar Datos</h4>
      <div class="modal-body">
        <form method="post">
          <input type="tex" name="idi" id="idi" readonly="" style="border: none;color: white;" >
        <div class="form-group label-floating">
              <label>Cuenta:</label>
              <input class="form-control" type="text" id="cuentita" name="cuentita" readonly="readonly">
        </div>
        <div class="form-group label-floating">
              <label>Descripción:</label>
              <input class="form-control" type="text" id="descrip" name="descrip" readonly="readonly">
        </div>
        <div class="form-group label-floating">
              <label>Debe:</label>
              <input class="form-control" type="number" step="any" id="debi" name="debi" required="">
        </div>
        <div class="form-group label-floating">
              <label>Haber:</label>
              <input class="form-control" type="number" step="any" id="habi" name="habi" required="">
        </div>
              <p class="text-center">
              <button type="submit" name="actualiza" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Actualizar</button>
              </p>
            </form>
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