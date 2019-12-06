<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');

$sql12="select descripcion from libroM";
$query12 = $dbh->prepare($sql12);
$query12->execute();

if(isset($_POST['ver']))
{
$libro=$_POST['libro'];

$id="select lm.idLibroM,lm.estado from libroM lm where lm.descripcion=:des";
$query1 = $dbh->prepare($id);
$query1->bindParam(':des',$libro,PDO::PARAM_STR);
$query1->execute();
$resu=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0){
foreach($resu as $re){
$pasarvalor=$re->idLibroM;
$libroEstado=$re->estado;
}
$_SESSION["genial"]=$pasarvalor;

$sql1="select a.correlativo,a.descripcion, a.nroAsiento from asiento a where a.idLibroM=:idlib and a.estado=1";
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
            <form  method="post">
            <div class="form-group">
            <label class="control-label">Seleccione libro diario</label>
            <select class="form-control" id="libro" name="libro" >
              <?php $results1=$query12->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query12->rowCount() > 0)
                    {
                    foreach($results1 as $result1)
                  {
               ?>
              <option><?php echo htmlentities($result1->descripcion);?></option><?php $cnt++; }}?>
              </select>
              <button type="submit" name="ver" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Ver</button>
            </div>
            </form>
            <?php 
            if($verte==1 || $verte==2){ ?>
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
                        <td>Ver</td>
                        <?php if($libroEstado==1){ ?>
                        <td>Editar</td>
                      <?php } ?>
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
                        <td><a href="verAsiento.php?id=<?php echo htmlentities($r2->nroAsiento); ?>">Ver</a></td>
                        <?php if($libroEstado==1){ ?>
                        <td><a href="asiento.php?contador=2&nroAs=<?php echo htmlentities($r2->nroAsiento); ?>">Editar</a></td>
                      <?php } ?>
                      </tr>
                      <?php $co++;}}
                      else{}?>
                    </tbody>
                  </table>
            <?php if($libroEstado==1){ ?>
            <form action="asiento.php?contador=1" method="post">
              <p class="text-center">
              <button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar Asiento</button>
              </p>
            </form>
            <?php } ?>
                </div>
            </div>
          </div>
<?php } ?>

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

</body>
</html>