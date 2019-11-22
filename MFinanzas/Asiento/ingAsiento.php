<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');

$sql="select max(idLibroM) as max from libroM";
$query = $dbh->prepare($sql);
$query->execute();
$resu=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
foreach($resu as $re){
$pasarvalor=$re->max;
}
$sql56="select estado from libroM where idLibroM=:id";
$query56 = $dbh->prepare($sql56);
$query56->bindParam(':id',$pasarvalor,PDO::PARAM_INT);
$query56->execute();
$resu56=$query56->fetchAll(PDO::FETCH_OBJ);
if($query56->rowCount() > 0){
foreach($resu56 as $re56){
$libEstado=$re56->estado;
}
}
$_SESSION["genial"]=$pasarvalor;
$sql1="select a.correlativo,a.descripcion from asiento a where a.idLibroM=:idlib";
$query2 = $dbh->prepare($sql1);
$query2->bindParam(':idlib',$pasarvalor,PDO::PARAM_INT);
$query2->execute();
$r=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0){
  $verte=1;
}
else{
  $verte=2;
}
}
else{
  $verte=3;
}
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
<body style="background-color: #e5e5e5">          <!-- Page Heading -->
          <h3 class="h3 mb-2 text-gray-800" align="center">Ingresar Asiento</h3>
          <?php if($verte==3){
            ?> <h6>Necesita aperturar un libro</h6><?php
          }
          else{
            if($verte==1 || $verte==2){?>
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead >
                      <tr>
                        <td colspan="2"> ASIENTOS</td>
                      </tr>
                      <tr>
                        <td>N°</td>
                        <td>Descripción</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($verte==1){
                      $co=1;
                      foreach($r as $r2)
                      {
                      ?>
                      <tr>
                        <td><?php echo htmlentities($r2->correlativo);?></td>
                        <td><?php echo htmlentities($r2->descripcion);?></td>
                      </tr>
                      <?php $co++;}}
                      else{}?>
                    </tbody>
                  </table>
            <?php if($libEstado==1){ ?>
            <form action="asiento.php" >
              <p class="text-center">
              <button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar Asiento</button>
              </p>
            </form>
            <?php } ?>
                </div>
            </div>
          </div>
<?php }} ?>
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