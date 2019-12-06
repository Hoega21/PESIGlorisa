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
          <h1 class="h3 mb-2 text-gray-800" align="center">Estado de Situación Financiera</h1>
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
                        <td colspan="4">Estado de Situacion Financiera</td>
                      </tr>
                      <tr>
                        <td colspan="2">Activo</td>
                        <td colspan="2">Pasivo y Patrimonio</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach($valorcito as $valorcito2)
                      {
                        $probar=$valorcito2->codCuenta;
                        if ($probar==10) {
                            $c10=$valorcito2->resultado;
                            }
                         else if ($probar==12) {
                            $c12=$valorcito2->resultado;
                            }
                          else if ($probar==14) {
                            $c14=$valorcito2->resultado;
                            }
                          else if ($probar==20) {
                            $c20=$valorcito2->resultado;
                            }
                          else if ($probar==33) {
                            $c33=$valorcito2->resultado;
                            }
                          else if ($probar==39) {
                            $c39=$valorcito2->resultado;
                            }
                        else if($probar==40){
                        $c40=$valorcito2->resultado;
                            }
                            else if ($probar==41) {
                                $c41=$valorcito2->resultado;
                              }
                          else if ($probar==42) {
                                $c42=$valorcito2->resultado;
                              }
                        else if($probar==45){
                        $c45=$valorcito2->resultado;
                            }
                            else if ($probar==46) {
                                $c46=$valorcito2->resultado;
                              }
                          else if($probar==50){
                        $c50=$valorcito2->resultado;
                            }
                            else if ($probar==59) {
                                $c59=$valorcito2->resultado;
                              }
                          else{ }
                      }
                    $tActCo=-$c10-$c12-$c14-$c20;
                    $tActNoCo=$c33+$c39;

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
                    $tPasCo=$c40+$c41+$c42+$impuesto+$c46;
                    $tPasNoCo=$c45;
                    $patri=$c50+$c59+$utilidad;

                   ?>
                    <tr>
                      <td colspan="2">Activo Corriente</td>
                      <td colspan="2">Pasivo Corriente</td>
                    </tr>
                    <tr>
                      <td>Efectivo y equivalente de efectivo</td>
                      <td><?php echo htmlentities(substr($c10,1)) ;?></td>
                      <td>Tributos por pagar</td>
                      <td><?php echo htmlentities($c40) ;?></td>
                    </tr>
                    <tr>
                      <td>cuentas por cobrar comerciales</td>
                      <td><?php echo htmlentities(substr($c12,1)) ;?></td>
                      <td>Remuneraciones por pagar</td>
                      <td><?php echo htmlentities($c41) ;?></td>
                    </tr>
                    <tr>
                      <td>Cuentas por cobrar al per,acc,etc</td>
                      <td><?php echo htmlentities(substr($c14, 1)) ;?></td>
                      <td>Cuentas por pagar comerciales</td>
                      <td><?php echo htmlentities($c42) ;?></td>
                    </tr>
                    <tr>
                      <td>Existencias</td>
                      <td><?php echo htmlentities(substr($c20, 1)) ;?></td>
                      <td>Impuesto a la renta y participio</td>
                      <td><?php echo htmlentities($impuesto) ;?></td>
                    </tr>
                    <tr>
                      <td>Total Activo Corriente</td>
                      <td><?php echo htmlentities($tActCo) ;?></td>
                      <td>Otras cuentas por pagar diversas</td>
                      <td><?php echo htmlentities($c46) ;?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>Total Pasivo Corriente</td>
                      <td><?php echo htmlentities($tPasCo) ;?></td>
                    </tr>
                    <tr>
                      <td colspan="2">Activo No Corriente</td>
                      <td colspan="2">Pasivo No Corriente</td>
                    </tr>
                    <tr>
                      <td>Inmuebles,maquinaria y equipo</td>
                      <td><?php echo htmlentities(substr($c33,1)) ;?></td>
                      <td>Obligaciones financieras</td>
                      <td><?php echo htmlentities($c45) ;?></td>
                    </tr>
                    <tr>
                      <td>(Depreciación acumulada)</td>
                      <td>-<?php echo htmlentities($c39) ;?></td>
                      <td>Total Pasivo No Corriente</td>
                      <td><?php echo htmlentities($tPasNoCo) ;?></td>
                    </tr>
                    <tr>
                      <td>Total Activo no Corriente</td>
                      <td><?php echo htmlentities(substr($tActNoCo, 1)) ;?></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td colspan="2">Patrimonio Neto</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>Capital</td>
                      <td><?php echo htmlentities($c50) ;?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>Resultados Acumulados</td>
                      <td><?php echo htmlentities($c59) ;?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>Resultados del ejercicio</td>
                      <td><?php echo htmlentities($utilidad) ;?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>Total Patrimonio</td>
                      <td><?php echo htmlentities($patri) ;?></td>
                    </tr>
                    <tr>
                      <td>Total Activo</td>
                      <td><?php echo htmlentities(substr($tActNoCo-$tActCo,1)) ;?></td>
                      <td>Total Pasivo y Patrimonio</td>
                      <td><?php echo htmlentities($patri+$tPasCo+$tPasNoCo) ;?></td>
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