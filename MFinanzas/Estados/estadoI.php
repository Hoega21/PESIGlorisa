<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');
$sql55="select max(idLibroM) as max from libroM";
$query55 = $dbh->prepare($sql55);
$query55->execute();
$resu55=$query55->fetchAll(PDO::FETCH_OBJ);
if($query55->rowCount() > 0){
foreach($resu55 as $re55){
$pasarvalor=$re55->max;
}
$sql56="select estado,mes,año from libroM where idLibroM=:id";
$query56 = $dbh->prepare($sql56);
$query56->bindParam(':id',$pasarvalor,PDO::PARAM_INT);
$query56->execute();
$resu56=$query56->fetchAll(PDO::FETCH_OBJ);
if($query56->rowCount() > 0){
foreach($resu56 as $re56){
$libEstado=$re56->estado;
$libMes=$re56->mes;
$libAnio=$re56->año;
}
}
}
if(isset($_POST['add']))
{
$taa=$_POST['tasa'];
$sql88="select c.codCuenta,c.resultado from cbalance c where c.idLibroM=:lib";
$query88 = $dbh->prepare($sql88);
$query88->bindParam(':lib',$pasarvalor,PDO::PARAM_STR);
$query88->execute();
$valorcito88=$query88->fetchAll(PDO::FETCH_OBJ);
foreach($valorcito88 as $valorcito28)
  {
    $probar=$valorcito28->codCuenta;
    if ($probar==69) {
    $costoVentas=$valorcito28->resultado;
    }
    else if($probar==70){
    $ventasNetas=$valorcito28->resultado;
    }
    else if ($probar==94) {
    $Administrativo=$valorcito28->resultado;
    }
    else if ($probar==95) {
    $ventas1=$valorcito28->resultado;
    }
    else{ }
  }
$UtilidadBruta=$costoVentas+$ventasNetas;
$utilidadOperativa=$UtilidadBruta+$Administrativo+$ventas1;
$impuesto=$taa*$utilidadOperativa/100;
$utilidadEjercicio=$utilidadOperativa-$impuesto;

    $valorx=3;
    $sql98="update libroM set estado=:nu where idLibroM=:idLib";
    $query98 = $dbh->prepare($sql98);
    $query98->bindParam(':nu',$valorx,PDO::PARAM_INT);
    $query98->bindParam(':idLib',$pasarvalor,PDO::PARAM_STR);
    $query98->execute();

$sql23="insert into UtlImp(utilidad,impuesto,idLibroM)values(:utilidad,:impuesto,:idLibroM)";
$query23 = $dbh->prepare($sql23);
$query23->bindParam(':utilidad',$utilidadEjercicio,PDO::PARAM_STR);
$query23->bindParam(':impuesto',$impuesto,PDO::PARAM_STR);
$query23->bindParam(':idLibroM',$pasarvalor,PDO::PARAM_INT);
$query23->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Guardado con exito";
}
else 
{
$error="Error al guardar";
}

}
if(isset($_POST['añadir']))
{
$tasita=$_POST['tasita'];   
$sql23="insert into tasa(valor)values(:tasa)";
$query23 = $dbh->prepare($sql23);
$query23->bindParam(':tasa',$tasita,PDO::PARAM_STR);
$query23->execute();
}
$sql="select valor from tasa";
$query = $dbh->prepare($sql);
$query->execute();
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
  <style type="text/css">
    .contenedor-modal {
  position: absolute;
  width: 100%;
  height: 100%;
  text-align: center;
}

.contenedor-modal button {
  position: relative;
  top: 40%;
}
  </style>
</head>
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800" align="center">Estado de Resultados Integrales</h1>
          <div class="card shadow mb-4">
            <?php if($error){ ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){ ?><div class="succWrap"><strong>ÉXITO</strong>:<?php echo htmlentities($msg); ?> </div>
            <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead >
                      <tr>
                        <td colspan="2">Estado de Resultados</td>
                      </tr>
                    </thead>
                    <tbody>
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
                <?php }
                else{  ?>
              <div class="card-body">
              <p class="text-center">
              <button type="submit"  name="nueva" class="btn btn-info btn-raised btn-sm" data-toggle="modal" data-target="#miModal"><i class="zmdi zmdi-floppy"></i> Nueva tasa </button>
              <form method="post">
            <label class="control-label">Seleccione tasa de impuesto a la renta</label>
            <select class="form-control" id="tasa" name="tasa">
               <?php $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                  {
               ?>
              <option><?php echo htmlentities($result->valor);?></option><?php $cnt++; }} ?>
              </select>
              <?php
               if($libEstado==2){ ?>
              <label class="control-label">Haga click en Generar estado para obtener el estado de resultados del mes de <?php echo htmlentities($libMes); ?> del año <?php echo htmlentities($libAnio); ?> </label>
              <p class="text-center">
              <button type="submit" name="add" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Generar estado</button>
              </p>
            </form>
            </div>
          <?php }} ?>
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
      <h4 class="modal-title" id="myModalLabel" align="center">Registrar Nueva Tasa</h4>
      <div class="modal-body">
        <form method="post">
        <div class="form-group label-floating">
              <label class="control-label">Escribir una tasa de impuesto a la renta</label>
              <input class="form-control" type="number" min="0.01" max="99.99" step="0.01" id="tasita" name="tasita" required="">
            </div>
              <p class="text-center">
              <button type="submit" name="añadir" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> GUARDAR</button>
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