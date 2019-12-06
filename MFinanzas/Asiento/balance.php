<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');

$sql12="select descripcion from libroM";
$query12 = $dbh->prepare($sql12);
$query12->execute();

if(isset($_POST['vers']))
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
$_SESSION["respeto"]=$pasarvalor;
$sql="select s.codCuenta,c.descripcion,s.debe,s.haber,s.haber-s.debe as Saldo from sumaMovimientos s INNER JOIN cuenta c on c.codCuenta=s.codCuenta where idLibroM=:lib";
$query = $dbh->prepare($sql);
$query->bindParam(':lib',$pasarvalor,PDO::PARAM_STR);
$query->execute();
if($query->rowCount() > 0){
  $verte=1;
}
else{
  $verte=2;
}
}
}
if(isset($_POST['add']))
{
  $pasarvalor11=$_SESSION["respeto"];
      $sql11="select s.codCuenta,c.descripcion,s.debe,s.haber,s.haber-s.debe as Saldo from sumaMovimientos s INNER JOIN cuenta c on c.codCuenta=s.codCuenta where idLibroM=:lib";
      $query11 = $dbh->prepare($sql11);
      $query11->bindParam(':lib',$pasarvalor11,PDO::PARAM_STR);
      $query11->execute();
      $results11=$query11->fetchAll(PDO::FETCH_OBJ);
      if($query11->rowCount() > 0)
    {
      foreach($results11 as $result11)
      {        
        $sql22="insert into cBalance(codCuenta,resultado,idLibroM) values(:codiCli,:resulta,:librito)";
        $query22 = $dbh->prepare($sql22);
        $query22->bindParam(':codiCli',$result11->codCuenta,PDO::PARAM_INT);
        $query22->bindParam(':resulta',$result11->Saldo,PDO::PARAM_STR);
        $query22->bindParam(':librito',$pasarvalor11,PDO::PARAM_INT);
        $query22->execute();
    }
    $valorx=2;
    $sql98="update libroM set estado=:nu where idLibroM=:idLib";
    $query98 = $dbh->prepare($sql98);
    $query98->bindParam(':nu',$valorx,PDO::PARAM_INT);
    $query98->bindParam(':idLib',$pasarvalor11,PDO::PARAM_STR);
    $query98->execute();
    echo "<script>alert('Datos guardados correctamente');</script>";
  }
  else{
  echo "<script>alert('Error al guardar datos');</script>";
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
          <h1 class="h3 mb-2 text-gray-800" align="center">Balance de Comprobación</h1>
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
                        <td colspan="10"> Balance de Comprobación</td>
                      </tr>
                      <tr>
                        <td rowspan="2">CTA</td>
                        <td rowspan="2">Denominación</td>
                        <td colspan="2">Sumas del mayor</td>
                        <td colspan="2">Saldos del mayor</td>
                        <td colspan="2">Inventario</td>
                        <td colspan="2">Estado de resultado</td>
                      </tr>
                      <tr>
                        <td>Debe</td>
                        <td>Haber</td>
                        <td>Deudor</td>
                        <td>Acreedor</td>
                        <td>Activo</td>
                        <td>Pasivo</td>
                        <td>Perdidas</td>
                        <td>Ganancias</td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                    {
                      ?>
                      <tr>
                        <td><?php echo htmlentities($result->codCuenta);?></td>
                        <td><?php echo htmlentities($result->descripcion);?></td>
                        <td><?php echo htmlentities($result->debe); $suma1+=$result->debe; ?></td>
                        <td><?php echo htmlentities($result->haber);$suma2+=$result->haber; ?></td>
                        <?php 
                        $comp=$result->Saldo;
                        if($comp<0){ ?>
                        <td><?php echo htmlentities(substr($comp, 1)); $suma3+=substr($comp, 1); ?></td>
                        <td></td>
                        <?php }
                        else {
                          if($comp>0){?>
                            <td></td>
                            <td><?php echo htmlentities($result->Saldo);$suma4+=$result->Saldo; ?></td>
                          <?php }
                          else{ ?>
                            <td>-</td>
                            <td>-</td>
                            <?php }
                        } 
                        $numCuenta=$result->codCuenta;
                        if($numCuenta<60){
                          if($comp<0){ ?>
                        <td><?php echo htmlentities(substr($comp, 1));$suma5+=substr($comp, 1); ?></td>
                        <td></td>
                        <?php }
                        else {
                          if($comp>0){?>
                            <td></td>
                            <td><?php echo htmlentities($result->Saldo);$suma6+=$result->Saldo; ?></td>
                          <?php }
                          else{ ?>
                            <td>-</td>
                            <td>-</td>
                            <?php }
                            }
                         }
                        else{
                        ?>
                        <td></td>
                        <td></td>
                        <?php } 
                        if($numCuenta>68){
                          if($numCuenta==79){
                            ?> <td></td>
                                <td></td><?php
                          }
                          else{ 
                            if($comp<0){ ?>
                        <td><?php echo htmlentities(substr($comp, 1));$suma7+=substr($comp, 1); ?></td>
                        <td></td>
                        <?php }
                        else {
                          if($comp>0){ ?>
                            <td></td>
                            <td><?php echo htmlentities($result->Saldo);$suma8+=$result->Saldo; ?></td>
                          <?php }
                          else{ ?>
                            <td>-</td>
                            <td>-</td>
                            <?php }
                        }  }
                        } ?>
                        </tr>
                      <?php
                    }
                    } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th colspan="2">SUMAS:</th>
                      <th><?php echo htmlentities("$suma1"); ?></th>
                      <th><?php echo htmlentities("$suma2"); ?></th>
                      <th><?php echo htmlentities("$suma3"); ?></th>
                      <th><?php echo htmlentities("$suma4"); ?></th>
                      <th><?php echo htmlentities("$suma5"); ?></th>
                      <th><?php echo htmlentities("$suma6"); ?></th>
                      <th><?php echo htmlentities("$suma7"); ?></th>
                      <th><?php echo htmlentities("$suma8"); ?></th>
                    </tr>
                    <tr>
                      <th colspan="2">RESULTADOS DEL EJERCICIO:</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th><?php $suma9=$suma8-$suma7; echo htmlentities("$suma9"); ?></th>
                      <th><?php echo htmlentities("$suma9"); ?></th>
                      <th></th>
                    </tr>
                    <tr>
                      <th colspan="2">TOTALES:</th>
                      <th><?php echo htmlentities("$suma1"); ?></th>
                      <th><?php echo htmlentities("$suma2"); ?></th>
                      <th><?php echo htmlentities("$suma3"); ?></th>
                      <th><?php echo htmlentities("$suma4"); ?></th>
                      <th><?php echo htmlentities("$suma5"); ?></th>
                      <th><?php $suma10=$suma6+$suma9; echo htmlentities("$suma10"); ?></th>
                      <th><?php $suma11=$suma7+$suma9; echo htmlentities("$suma11"); ?></th>
                      <th><?php echo htmlentities("$suma8"); ?></th>
                    </tr>
                  </tfoot>
                  </table>
            <?php  
            if($libroEstado==1){
            if($suma1==0){
              ?>
              <label>Debe ingresar asientos</label>
              <?php
            } 
            else if($suma10==0||$suma11==0||$suma8==0){
              ?>
              <label>Para que puede guardar el balance le falta agregar algunos asientos</label>
              <?php 
              }
              else if($suma5!=$suma10 || $suma11!=$suma8){
                ?>
                <label>Aun no esta balanceado el libro</label>
                <?php
              }
              else{
              ?>
            <form method="post">
              <p class="text-center">
              <button name="add" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar Balance</button>
              </p>
            </form>
            <?php } }
                    else{}  ?>
                </div>
            </div>
          </div>
        <?php } ?>
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