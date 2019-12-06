<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');

$sql12="select descripcion from libroM where estado>2";
$query12 = $dbh->prepare($sql12);
$query12->execute();

if(isset($_POST['vers']))
{

$libro=$_POST['libro'];

$id="select lm.idLibroM from libroM lm where lm.descripcion=:des";
$query1 = $dbh->prepare($id);
$query1->bindParam(':des',$libro,PDO::PARAM_STR);
$query1->execute();
$resu=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0){
foreach($resu as $re){
$pasarvalor=$re->idLibroM;
}

$sql="select c.codCuenta,c.resultado from cBalance c where c.idLibroM=:lib";
$query = $dbh->prepare($sql);
$query->bindParam(':lib',$pasarvalor,PDO::PARAM_STR);
$query->execute();
$valorcito=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
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
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800" align="center">Estado de Resultados Integrales por función</h1>
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
              <button type="submit" name="vers" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Ver</button>
            </div>
            </form>
            <?php if($verte==1 || $verte==2) { ?>
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead >
                      <tr>
                        <td colspan="2">Estado de Resultados</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach($valorcito as $valorcito2)
                      {
                        $probar=$valorcito2->codCuenta;
                        if ($probar==69) {
                            $costoVentas=$valorcito2->resultado;
                            }
                        else if($probar==70){
                        $ventasNetas=$valorcito2->resultado;
                            }
                            else if ($probar==94) {
                                $Administrativo=$valorcito2->resultado;
                              }
                          else if ($probar==95) {
                                $ventas1=$valorcito2->resultado;
                              }
                          else{ }
                      }
                    $UtilidadBruta=$costoVentas+$ventasNetas;
                    $utilidadOperativa=$UtilidadBruta+$Administrativo+$ventas1;
                    $sql32="select* from UtlImp u where u.idLibroM=:lib";
                    $query32 = $dbh->prepare($sql32);
                    $query32->bindParam(':lib',$pasarvalor,PDO::PARAM_STR);
                    $query32->execute();
                    $resu32=$query32->fetchAll(PDO::FETCH_OBJ);
                      foreach($resu32 as $resu33)
                      {
                        $impuesto=$resu33->impuesto;
                        $utilidad=$resu33->utilidad;
                      }
                   ?>
                    <tr>
                      <td>Ventas Netas</td>
                      <td><?php echo htmlentities($ventasNetas) ;?></td>
                    </tr>
                    <tr>
                      <td>(-) Costo de Ventas</td>
                      <td><?php echo htmlentities($costoVentas) ;?></td>
                    </tr>
                    <tr>
                      <td>Utilidad Bruta</td>
                      <td><?php echo htmlentities($UtilidadBruta) ;?></td>
                    </tr>
                    <tr>
                      <td>(-)Gastos Administrativos</td>
                      <td><?php echo htmlentities($Administrativo) ;?></td>
                    </tr>
                    <tr>
                      <td>(-)Gastos Ventas</td>
                      <td><?php echo htmlentities($ventas1) ;?></td>
                    </tr>
                    <tr>
                      <td>Utilidad Operativa</td>
                      <td><?php echo htmlentities($utilidadOperativa) ;?></td>
                    </tr>
                    <tr>
                      <td>(-) Impuesto a la Renta()</td>
                      <td>-<?php echo htmlentities($impuesto) ;?></td>
                    </tr>
                    <tr>
                      <td>UTILIDAD DEL EJERCICIO</td>
                      <td><?php echo htmlentities($utilidad) ;?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
                  <?php }
                    else{} ?>
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