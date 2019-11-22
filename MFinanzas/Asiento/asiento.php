<?php
session_start();
error_reporting(0);
$contadorcito=1;
$idLibro = $_SESSION["genial"];
include('../../MRecursosHumanos/includes/config.php');
$sql="select codSubCuenta from subcuenta";
$query = $dbh->prepare($sql);
$query->execute();
if(isset($_POST['add']))
{
$monto=$_POST['monto'];
$movimiento=$_POST['movimiento'];
$cuenta=$_POST['cuenta'];
$descripcion=$_POST['descripcion'];
$anio = date("Y");
$mes=date("m");
$dia=date("d");
$fecha=$anio.$mes.$dia;
if($movimiento=="Debe"){
$debe=$monto;
$haber="";
}
else{
$debe="";
$haber=$monto;
}
$sqll="select max(correlativo) as max from asiento where idLibroM=:idLib";
$query1 = $dbh->prepare($sqll);
$query1->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query1->execute();
$resu=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0){
foreach($resu as $re){
$re->max;
}
$correlativo=$re->max +1;
}
else{
$correlativo=1;
}
$sql1="INSERT INTO asiento(correlativo,descripcion,fecha,idLibroM) VALUES(:correlativo,:descripcion,:fecha,:idLibroM) ";
$query2 = $dbh->prepare($sql1);
$query2->bindParam(':correlativo',$correlativo,PDO::PARAM_INT);
$query2->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
$query2->bindParam(':fecha',$fecha,PDO::PARAM_STR);
$query2->bindParam(':idLibroM',$idLibro,PDO::PARAM_INT);
$query2->execute();
$sql3="select max(nroAsiento) as maxi from asiento where idLibroM=:idLib";
$query4 = $dbh->prepare($sql3);
$query4->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query4->execute();
$rest=$query4->fetchAll(PDO::FETCH_OBJ);
foreach($rest as $resa){
$resa->maxi;
}
$numb=$resa->maxi;
$sql2="INSERT INTO tMovimiento (debe,haber,nroAsiento,codSubCuenta) VALUES(:debe,:haber,:numero,:codi)";
$query3 = $dbh->prepare($sql2);
$query3->bindParam(':debe',$debe,PDO::PARAM_STR);
$query3->bindParam(':haber',$haber,PDO::PARAM_STR);
$query3->bindParam(':numero',$numb,PDO::PARAM_INT);
$query3->bindParam(':codi',$cuenta,PDO::PARAM_INT);
$query3->execute();

$sql7="select c.codCuenta from cuenta c INNER join subcuenta s on s.codCuenta=c.codCuenta where s.codSubCuenta=:codi";
$query7 = $dbh->prepare($sql7);
$query7->bindParam(':codi',$cuenta,PDO::PARAM_INT);
$query7->execute();
$resu7=$query7->fetchAll(PDO::FETCH_OBJ);
foreach($resu7 as $re10){
$codigoC=$re10->codCuenta;
}

$sql8="select s.debe, s.haber from sumaMovimientos s where s.idLibroM=:idLib and s.codCuenta=:codi";
$query8 = $dbh->prepare($sql8);
$query8->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query8->bindParam(':codi',$codigoC,PDO::PARAM_INT);
$query8->execute();
$resu8=$query8->fetchAll(PDO::FETCH_OBJ);
if($query8->rowCount() > 0){
foreach($resu8 as $re12){
$debe12=$re12->debe;
$haber12=$re12->haber;
}
$debe13=$debe12+$debe;
$haber13=$haber12+$haber;
$sql9="update sumaMovimientos set debe=:debe,haber=:haber where codCuenta=:codi and idLibroM=:idLib";
$query9 = $dbh->prepare($sql9);
$query9->bindParam(':debe',$debe13,PDO::PARAM_STR);
$query9->bindParam(':haber',$haber13,PDO::PARAM_STR);
$query9->bindParam(':codi',$codigoC,PDO::PARAM_INT);
$query9->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query9->execute();
}
else{
$sql9="insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(:idLib,:codi,:debe,:haber)";
$query9 = $dbh->prepare($sql9);
$query9->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query9->bindParam(':codi',$codigoC,PDO::PARAM_INT);
$query9->bindParam(':debe',$debe,PDO::PARAM_STR);
$query9->bindParam(':haber',$haber,PDO::PARAM_STR);
$query9->execute();
}
$contadorcito++;
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
          <br><br>
          <h1 class="h3 mb-2 text-gray-800" align="center">Asiento</h1>
          <br>
          
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="table-responsive">
                <?php if($contadorcito>1){ ?>
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
                      <?php $sql4="select t.codSubCuenta,c.descripcion,t.debe,t.haber from tMovimiento t INNER join subcuenta c on c.codSubCuenta=t.codSubCuenta where nroAsiento=:numas";
                            $query5 = $dbh->prepare($sql4);
                            $query5->bindParam(':numas',$numb,PDO::PARAM_INT);
                            $query5->execute();
                            $r21=$query5->fetchAll(PDO::FETCH_OBJ);
                            $c=1;
                            foreach($r21 as $r22)
                              {?>
                                <tr>
                                  <td><?php echo htmlentities($r22->codSubCuenta);?></td>
                                  <td><?php echo htmlentities($r22->descripcion);?></td>
                                  <td><?php echo htmlentities($r22->debe);?></td>
                                  <td><?php echo htmlentities($r22->haber);?></td>
                                </tr><?php $c++;} ?>
                    </tbody>
                  </table>
                  <?php }?>
            <form action="" method="post">
              <?php
              if($contadorcito==1){ ?>
              <div class="form-group label-floating">
              <label class="control-label">Escribir descripcion del asiento</label>
              <input class="form-control" type="text"  id="descripcion" name="descripcion" required="">
            </div>
              <?php }?>
            <div class="form-group">
            <label class="control-label">Seleccione Cuenta-Subcuenta</label>
            <select class="form-control" id="cuenta" name="cuenta">
              <?php $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                  {
               ?>
              <option><?php echo htmlentities($result->codSubCuenta);?></option><?php $cnt++; }}?>
              </select>
            </div>
            <div class="form-group">
            <label class="control-label">Seleccione movimiento</label>
            <select class="form-control" id="movimiento" name="movimiento">
            <option>Debe</option>
            <option>Haber</option>
            </select>
            </div>
            <div class="form-group label-floating">
              <label class="control-label">Escribir monto</label>
              <input class="form-control" type="number" step="any" id="monto" name="monto" required="">
            </div>
              <p class="text-center">
              <button type="submit" name="add" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> AGREGAR</button>
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